<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$pageTitle="Dashboard | MISA";
include "includes/header.php"; include "includes/navbar.php";
?>
<div class="container content-area">
<div class="eyebrow">USER DASHBOARD</div><h1>Welcome, <?= htmlspecialchars($_SESSION['name']) ?>.</h1>
<div class="dashboard-grid">
<a class="dashboard-card" href="chat.php"><span>🤖</span><h3>Ask MISA</h3><p>Ask questions about MESOB services.</p></a>
<a class="dashboard-card" href="services.php"><span>📚</span><h3>Service Directory</h3><p>Browse available service information.</p></a>
</div></div>
<?php include "includes/footer.php"; ?>