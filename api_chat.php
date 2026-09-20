<?php

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "ok" => false,
        "message" => "Only POST requests are allowed."
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$question = trim($_POST["question"] ?? "");

if ($question === "") {
    echo json_encode([
        "ok" => false,
        "message" => "Please enter a question."
    ], JSON_UNESCAPED_UNICODE);
    exit;
}


/*
|--------------------------------------------------------------------------
| Normalize text
|--------------------------------------------------------------------------
*/

function normalizeText($text)
{
    $text = strtolower(trim($text));

    $text = preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $text);

    $text = preg_replace('/\s+/', ' ', $text);

    return trim($text);
}

$query = normalizeText($question);


/*
|--------------------------------------------------------------------------
| Get services
|--------------------------------------------------------------------------
*/

$sql = "SELECT * FROM services ORDER BY id ASC";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        "ok" => false,
        "message" => "Could not load services from the database."
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$services = [];

while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}


/*
|--------------------------------------------------------------------------
| Detect phrases and intents
|--------------------------------------------------------------------------
*/

$hasTin =
    preg_match('/\btin\b/i', $query) ||
    strpos($query, "tax identification number") !== false ||
    strpos($query, "taxpayer identification number") !== false ||
    strpos($query, "tax identification") !== false ||
    strpos($query, "taxpayer identification") !== false;

$isTinCancellation =
    strpos($query, "cancel") !== false ||
    strpos($query, "cancellation") !== false ||
    strpos($query, "close my tin") !== false ||
    strpos($query, "close tin") !== false;

$isDriverLicense =
    strpos($query, "driver license") !== false ||
    strpos($query, "drivers license") !== false ||
    strpos($query, "driving license") !== false ||
    strpos($query, "driver s license") !== false;

$isBusinessRegistration =
    strpos($query, "business registration") !== false ||
    strpos($query, "register a business") !== false ||
    strpos($query, "register business") !== false;

$isBusinessLicense =
    strpos($query, "business license") !== false ||
    strpos($query, "business licence") !== false;

$isVAT =
    preg_match('/\bvat\b/i', $query) ||
    strpos($query, "value added tax") !== false;

$isProfessionalLicense =
    strpos($query, "professional license") !== false ||
    strpos($query, "professional licence") !== false ||
    strpos($query, "professional permit") !== false;

$isJobSeeker =
    strpos($query, "job seeker") !== false ||
    strpos($query, "jobseeker") !== false;

$isRenewal =
    strpos($query, "renew") !== false ||
    strpos($query, "renewal") !== false;


/*
|--------------------------------------------------------------------------
| Determine intent
|--------------------------------------------------------------------------
*/

$intent = null;


/* TIN */

if ($hasTin) {

    if ($isTinCancellation) {
        $intent = "cancel_tin";
    } else {
        $intent = "new_tin";
    }
}


/* Driver license */

if ($isDriverLicense) {
    $intent = "unsupported_driver_license";
}


/* VAT */

if ($isVAT) {
    $intent = "vat";
}


/* Professional license */

if ($isProfessionalLicense) {

    if ($isRenewal) {
        $intent = "renew_professional_license";
    } else {
        $intent = "new_professional_license";
    }
}


/* Job seeker */

if ($isJobSeeker) {
    $intent = "job_seeker";
}


/* Business registration */

if ($isBusinessRegistration) {
    $intent = "business_registration";
}


/* Business license */

if ($isBusinessLicense && !$isDriverLicense) {

    if ($isRenewal) {
        $intent = "renew_business_license";
    } else {
        $intent = "new_business_license";
    }
}


/*
|--------------------------------------------------------------------------
| Driver license is not currently provided
|--------------------------------------------------------------------------
*/

if ($intent === "unsupported_driver_license") {

    echo json_encode([
        "ok" => true,
        "found" => false,
        "message" => "I couldn't find a matching service in the BG Mesob service catalogue."
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


/*
|--------------------------------------------------------------------------
| Score services
|--------------------------------------------------------------------------
*/

$bestService = null;
$bestScore = 0;

foreach ($services as $service) {

    $serviceName = normalizeText($service["service_name"] ?? "");
    $description = normalizeText($service["description"] ?? "");
    $procedure = normalizeText($service["procedure"] ?? "");
    $requirements = normalizeText($service["requirements"] ?? "");
    $organization = normalizeText($service["organization"] ?? "");

    $score = 0;


/*
|--------------------------------------------------------------------------
| Exact intent matches
|--------------------------------------------------------------------------
*/

    if ($intent === "new_tin") {

        if (strpos($serviceName, "issuance of a new tin") !== false) {
            $score += 1000;
        }

        if (
            strpos($serviceName, "cancel") !== false ||
            strpos($serviceName, "cancellation") !== false
        ) {
            $score -= 1000;
        }
    }


    if ($intent === "cancel_tin") {

        if (
            strpos($serviceName, "cancel") !== false ||
            strpos($serviceName, "cancellation") !== false
        ) {
            $score += 1000;
        }
    }


    if ($intent === "vat") {

        if (strpos($serviceName, "vat registration") !== false) {
            $score += 1000;
        }

        if (strpos($serviceName, "vat cancellation") !== false) {
            $score -= 1000;
        }
    }


    if ($intent === "new_professional_license") {

        if (
            strpos($serviceName, "issuance of new professional license") !== false
        ) {
            $score += 1000;
        }

        if (
            strpos($serviceName, "renewal professional license") !== false
        ) {
            $score -= 1000;
        }
    }


    if ($intent === "renew_professional_license") {

        if (
            strpos($serviceName, "renewal professional license") !== false
        ) {
            $score += 1000;
        }
    }


    if ($intent === "job_seeker") {

        if (
            strpos($serviceName, "job seekers registration") !== false
        ) {
            $score += 1000;
        }
    }


    if ($intent === "business_registration") {

        if ($serviceName === "business registration") {
            $score += 1000;
        }
    }


    if ($intent === "new_business_license") {

        if (
            strpos($serviceName, "issuance of new business license") !== false
        ) {
            $score += 1000;
        }

        if (
            strpos($serviceName, "business license renewal") !== false
        ) {
            $score -= 1000;
        }
    }


    if ($intent === "renew_business_license") {

        if (
            strpos($serviceName, "business license renewal") !== false
        ) {
            $score += 1000;
        }

        if (
            strpos($serviceName, "issuance of new business license") !== false
        ) {
            $score -= 1000;
        }
    }


/*
|--------------------------------------------------------------------------
| General keyword matching
|--------------------------------------------------------------------------
*/

    $words = preg_split('/\s+/', $query);

    $stopWords = [
        "the",
        "and",
        "for",
        "how",
        "can",
        "what",
        "where",
        "when",
        "does",
        "need",
        "want",
        "get",
        "give",
        "tell",
        "about",
        "from",
        "with",
        "this",
        "that",
        "please",
        "number",
        "my",
        "i",
        "me",
        "to",
        "a",
        "an"
    ];

    foreach ($words as $word) {

        if (strlen($word) < 3) {
            continue;
        }

        if (in_array($word, $stopWords, true)) {
            continue;
        }

        if (strpos($serviceName, $word) !== false) {
            $score += 20;
        }

        if (strpos($description, $word) !== false) {
            $score += 8;
        }

        if (strpos($procedure, $word) !== false) {
            $score += 5;
        }

        if (strpos($requirements, $word) !== false) {
            $score += 5;
        }

        if (strpos($organization, $word) !== false) {
            $score += 3;
        }
    }


/*
|--------------------------------------------------------------------------
| Prevent driver's license from matching business license
|--------------------------------------------------------------------------
*/

    if ($isDriverLicense) {

        if (strpos($serviceName, "business license") !== false) {
            $score = -10000;
        }
    }


/*
|--------------------------------------------------------------------------
| TIN protection
|--------------------------------------------------------------------------
*/

    if ($intent === "new_tin") {

        if (
            strpos($serviceName, "issuance of a new tin") === false
        ) {
            $score -= 300;
        }
    }


/*
|--------------------------------------------------------------------------
| Keep best result
|--------------------------------------------------------------------------
*/

    if ($score > $bestScore) {

        $bestScore = $score;
        $bestService = $service;
    }
}


/*
|--------------------------------------------------------------------------
| No match
|--------------------------------------------------------------------------
*/

if ($bestService === null || $bestScore < 10) {

    echo json_encode([
        "ok" => true,
        "found" => false,
        "message" => "I couldn't find a matching service in the BG Mesob service catalogue. Try using the service name or a few keywords."
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


/*
|--------------------------------------------------------------------------
| Return service
|--------------------------------------------------------------------------
*/

$serviceId = $bestService["id"];

echo json_encode([
    "ok" => true,
    "found" => true,

    "service" => [
        "id" => $serviceId,
        "service_name" => $bestService["service_name"],
        "organization" => $bestService["organization"],
        "requirements" => $bestService["requirements"],
        "procedure" => $bestService["procedure"],
        "processing_time" => $bestService["processing_time"],
        "government_fee" => $bestService["government_fee"],
        "mesob_fee" => $bestService["mesob_fee"],
        "source" => $bestService["source"],
        "link" => "service-details.php?id=" . $serviceId
    ]

], JSON_UNESCAPED_UNICODE);

?>