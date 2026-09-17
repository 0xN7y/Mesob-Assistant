<?php
session_start(); if(($_SESSION['role']??'')!=='admin'){header("Location: ../login.php");exit;}
require_once "../config/database.php"; $id=(int)($_GET['id']??0);
$stmt=$conn->prepare("DELETE FROM services WHERE id=?");$stmt->bind_param("i",$id);$stmt->execute();
header("Location: services.php"); exit;
?>