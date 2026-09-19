<?php
$pageTitle = "Service Details | MISA";
require_once "config/database.php";
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM services WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$service = $stmt->get_result()->fetch_assoc();
if (!$service) { http_response_code(404); die("Service not found."); }

$docStmt = $conn->prepare("SELECT d.name FROM documents d JOIN service_documents sd ON d.id=sd.document_id WHERE sd.service_id=? ORDER BY d.name");
$docStmt->bind_param("i", $id);
$docStmt->execute();
$docs = $docStmt->get_result();

include "includes/header.php";
include "includes/navbar.php";
?>
<div class="container content-area">
<a class="back-link" href="services.php">← Back to services</a>
<div class="details-grid">
<main class="details-main">
    <div class="eyebrow">SERVICE INFORMATION</div>
    <h1><?= htmlspecialchars($service['service_name']) ?></h1>
    <p class="lead"><?= htmlspecialchars($service['description']) ?></p>
    <div class="info-panel"><h2>Procedure</h2><p><?= nl2br(htmlspecialchars($service['procedure'])) ?></p></div>
    <div class="info-panel"><h2>Required documents</h2><ul class="check-list">
    <?php while ($d=$docs->fetch_assoc()): ?><li>✓ <?= htmlspecialchars($d['name']) ?></li><?php endwhile; ?>
    </ul></div>
    <div class="source-box"><strong>Source</strong><p><?= htmlspecialchars($service['source']) ?></p><small>Demo data — replace with verified official information before deployment.</small></div>
</main>
<aside class="details-side">
    <div class="stat-card"><span>Processing time</span><strong><?= htmlspecialchars($service['processing_time']) ?></strong></div>
    <div class="stat-card"><span>Fee</span><strong><?= htmlspecialchars($service['fee']) ?></strong></div>
    <a class="btn btn-primary full" href="chat.php?q=<?= urlencode($service['service_name']) ?>">Ask MISA about this →</a>
</aside>
</div>
</div>
<?php include "includes/footer.php"; ?>