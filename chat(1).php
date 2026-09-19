<?php
$pageTitle = "Ask MISA | Assistant";
require_once "config/database.php";
include "includes/header.php";
include "includes/navbar.php";
?>
<section class="chat-page">
<div class="container chat-wrap">
    <div class="chat-header"><div class="bot-avatar">M</div><div><div class="eyebrow">MISA ASSISTANT</div><h1>How can I help?</h1><p>Ask about a service, documents, procedures, fees or processing time.</p></div></div>
    <div id="chatMessages" class="chat-messages">
        <div class="message assistant"><strong>MISA</strong><p>Hello! Ask me about a service. For example: “What documents are required for passport renewal?”</p></div>
    </div>
    <form id="chatForm" class="chat-input">
        <input id="question" autocomplete="off" placeholder="Type your question..." required>
        <button class="btn btn-primary">Send</button>
    </form>
    <div class="suggestions">
        <button type="button" data-q="What documents are required for passport renewal?">Passport documents</button>
        <button type="button" data-q="How do I renew my driver's license?">Driver's license</button>
        <button type="button" data-q="How long does business registration take?">Business registration</button>
    </div>
</div>
</section>
<?php include "includes/footer.php"; ?>