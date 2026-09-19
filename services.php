<?php
$pageTitle = "Services | MISA";
require_once "config/database.php";
include "includes/header.php";
include "includes/navbar.php";

$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $stmt = $conn->prepare("SELECT * FROM services WHERE service_name LIKE ? OR description LIKE ? ORDER BY service_name");
    $like = "%".$q."%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM services ORDER BY service_name");
}
?>
<section class="page-hero">
<div class="container"><div class="eyebrow">SERVICE DIRECTORY</div><h1>Explore services</h1><p>Search for a service and view its documents, procedure, fee, processing time and source.</p></div>
</section>
<div class="container content-area">
<form class="search-box" method="get">
    <input name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Search services, e.g. passport renewal">
    <button class="btn btn-primary">Search</button>
</form>
<div class="service-grid">
<?php while ($service = $result->fetch_assoc()): ?>
    <article class="service-card">
        <div class="service-icon">▣</div>
        <h3><?= htmlspecialchars($service['service_name']) ?></h3>
        <p><?= htmlspecialchars($service['description']) ?></p>
        <div class="mini-meta"><span>⏱ <?= htmlspecialchars($service['processing_time']) ?></span><span>Fee: <?= htmlspecialchars($service['fee']) ?></span></div>
        <a class="text-link" href="service-details.php?id=<?= (int)$service['id'] ?>">View details →</a>
    </article>
<?php endwhile; ?>
</div>
</div>
<?php include "includes/footer.php"; ?>