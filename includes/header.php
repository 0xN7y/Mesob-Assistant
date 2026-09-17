<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$assetPrefix = (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) ? '../' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle ?? "MISA") ?></title>
<link rel="stylesheet" href="<?= $assetPrefix ?>assets/css/style.css">
</head>
<body>