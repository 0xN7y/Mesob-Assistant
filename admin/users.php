<?php
session_start(); if(($_SESSION['role']??'')!=='admin'){header("Location: ../login.php");exit;}
require_once "../config/database.php"; $pageTitle="Users | MISA"; include "../includes/header.php"; include "../includes/navbar.php";
$r=$conn->query("SELECT id,name,email,role,created_at FROM users ORDER BY id DESC");
?>
<div class="container content-area"><div class="eyebrow">ADMIN</div><h1>Users</h1><div class="table-wrap"><table><tr><th>Name</th><th>Email</th><th>Role</th><th>Created</th></tr><?php while($u=$r->fetch_assoc()): ?><tr><td><?=htmlspecialchars($u['name'])?></td><td><?=htmlspecialchars($u['email'])?></td><td><?=htmlspecialchars($u['role'])?></td><td><?=htmlspecialchars($u['created_at'])?></td></tr><?php endwhile;?></table></div></div>
<?php include "../includes/footer.php"; ?>