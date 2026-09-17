<?php
session_start(); if(($_SESSION['role']??'')!=='admin'){header("Location: ../login.php");exit;}
require_once "../config/database.php"; $id=(int)($_GET['id']??0);
if($_SERVER['REQUEST_METHOD']==='POST'){
$stmt=$conn->prepare("UPDATE services SET service_name=?,description=?,procedure=?,fee=?,processing_time=?,source=? WHERE id=?");
$stmt->bind_param("ssssssi",$_POST['service_name'],$_POST['description'],$_POST['procedure'],$_POST['fee'],$_POST['processing_time'],$_POST['source'],$id); $stmt->execute(); header("Location: services.php"); exit;}
$stmt=$conn->prepare("SELECT * FROM services WHERE id=?");$stmt->bind_param("i",$id);$stmt->execute();$s=$stmt->get_result()->fetch_assoc();
$pageTitle="Edit Service | MISA"; include "../includes/header.php"; include "../includes/navbar.php";
?>
<div class="container content-area"><div class="auth-card wide"><div class="eyebrow">ADMIN</div><h1>Edit service</h1>
<form method="post" class="form-grid"><label>Service name<input name="service_name" value="<?=htmlspecialchars($s['service_name'])?>" required></label><label>Fee<input name="fee" value="<?=htmlspecialchars($s['fee'])?>" required></label><label>Processing time<input name="processing_time" value="<?=htmlspecialchars($s['processing_time'])?>" required></label><label>Source<input name="source" value="<?=htmlspecialchars($s['source'])?>" required></label><label class="span-2">Description<textarea name="description" required><?=htmlspecialchars($s['description'])?></textarea></label><label class="span-2">Procedure<textarea name="procedure" required><?=htmlspecialchars($s['procedure'])?></textarea></label><div class="span-2"><button class="btn btn-primary">Update service</button></div></form></div></div>
<?php include "../includes/footer.php"; ?>