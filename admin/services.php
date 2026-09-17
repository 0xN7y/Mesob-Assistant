<?php
session_start(); if(($_SESSION['role']??'')!=='admin'){header("Location: ../login.php");exit;}
require_once "../config/database.php"; $pageTitle="Manage Services | MISA"; include "../includes/header.php"; include "../includes/navbar.php";
$result=$conn->query("SELECT * FROM services ORDER BY id DESC");
?>
<div class="container content-area"><div class="admin-head"><div><div class="eyebrow">ADMIN</div><h1>Manage services</h1></div><a class="btn btn-primary" href="add-service.php">+ Add service</a></div>
<div class="table-wrap"><table><tr><th>Service</th><th>Fee</th><th>Processing</th><th>Actions</th></tr>
<?php while($s=$result->fetch_assoc()): ?><tr><td><?=htmlspecialchars($s['service_name'])?></td><td><?=htmlspecialchars($s['fee'])?></td><td><?=htmlspecialchars($s['processing_time'])?></td><td><a href="edit-service.php?id=<?=$s['id']?>">Edit</a> · <a onclick="return confirm('Delete this service?')" href="delete-service.php?id=<?=$s['id']?>">Delete</a></td></tr><?php endwhile;?>
</table></div></div>
<?php include "../includes/footer.php"; ?>