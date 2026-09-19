<?php
header('Content-Type: application/json; charset=utf-8');
require_once "config/database.php";

$q = trim($_POST['question'] ?? '');
if ($q === '') { echo json_encode(['ok'=>false,'message'=>'Please enter a question.']); exit; }

$stmt = $conn->prepare("SELECT * FROM services WHERE service_name LIKE ? OR description LIKE ? OR procedure LIKE ? ORDER BY service_name LIMIT 3");
$like = "%".$q."%";
$stmt->bind_param("sss", $like, $like, $like);
$stmt->execute();
$res = $stmt->get_result();

$keywords = preg_split('/\s+/', strtolower(preg_replace('/[^a-zA-Z0-9 ]/', '', $q)));
$matches=[];
while ($row=$res->fetch_assoc()) $matches[]=$row;

if (!$matches) {
    $all=$conn->query("SELECT * FROM services");
    while ($row=$all->fetch_assoc()) {
        $hay=strtolower($row['service_name']." ".$row['description']." ".$row['procedure']);
        $score=0;
        foreach($keywords as $word) if(strlen($word)>3 && strpos($hay,$word)!==false) $score++;
        if($score>0){$row['_score']=$score;$matches[]=$row;}
    }
    usort($matches, fn($a,$b)=>($b['_score']??0)<=>($a['_score']??0));
    $matches=array_slice($matches,0,3);
}
if (!$matches) {
    echo json_encode(['ok'=>true,'answer'=>"I couldn't find a matching service in the demo knowledge base. Try searching by the service name.",'services'=>[]]);
    exit;
}
$best=$matches[0];
$answer="<strong>".htmlspecialchars($best['service_name'])."</strong><br>"
."Procedure: ".nl2br(htmlspecialchars($best['procedure']))."<br>"
."Fee: ".htmlspecialchars($best['fee'])."<br>"
."Processing time: ".htmlspecialchars($best['processing_time'])
."<br><br><a href='service-details.php?id=".(int)$best['id']."'>View full service details →</a>"
."<br><small>Source: ".htmlspecialchars($best['source'])."</small>";
echo json_encode(['ok'=>true,'answer'=>$answer,'services'=>array_map(fn($x)=>['id'=>$x['id'],'name'=>$x['service_name']],$matches)]);
?>