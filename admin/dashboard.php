<?php
session_start(); if(($_SESSION['role']??'')!=='admin'){header("Location: ../login.php");exit;}
require_once "../config/database.php"; $pageTitle="Admin | MISA"; include "../includes/header.php"; include "../includes/navbar.php";
$count=$conn->query("SELECT COUNT(*) c FROM services")->fetch_assoc()['c'];
?>
<div class="container content-area"><div class="eyebrow">ADMINISTRATION</div><h1>Management dashboard</h1>
<div class="dashboard-grid"><a class="dashboard-card" href="services.php"><span>🗂</span><h3>Manage services</h3><p><?= $count ?> services in the demo database.</p></a><a class="dashboard-card" href="users.php"><span>👥</span><h3>Users</h3><p>View registered users.</p></a></div></div>
<?php include "../includes/footer.php"; ?>