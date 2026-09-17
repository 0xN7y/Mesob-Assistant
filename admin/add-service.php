<?php
session_start(); if(($_SESSION['role']??'')!=='admin'){header("Location: ../login.php");exit;}
require_once "../config/database.php";
if($_SERVER['REQUEST_METHOD']==='POST'){
    $stmt=$conn->prepare("INSERT INTO services(service_name,description,procedure,fee,processing_time,source) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$_POST['service_name'],$_POST['description'],$_POST['procedure'],$_POST['fee'],$_POST['processing_time'],$_POST['source']);
    $stmt->execute(); header("Location: services.php"); exit;
}
$pageTitle="Add Service | MISA"; include "../includes/header.php"; include "../includes/navbar.php";
?>
<div class="container content-area"><div class="auth-card wide"><div class="eyebrow">ADMIN</div><h1>Add service</h1>
<form method="post" class="form-grid"><label>Service name<input name="service_name" required></label><label>Fee<input name="fee" required></label><label>Processing time<input name="processing_time" required></label><label>Source<input name="source" required></label><label class="span-2">Description<textarea name="description" required></textarea></label><label class="span-2">Procedure<textarea name="procedure" required></textarea></label><div class="span-2"><button class="btn btn-primary">Save service</button></div></form></div></div>
<?php include "../includes/footer.php"; ?>