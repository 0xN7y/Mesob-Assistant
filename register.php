<?php
session_start(); require_once "config/database.php";
$error="";
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
    if($name && filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($password)>=6){
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $stmt=$conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,'employee')");
        $stmt->bind_param("sss",$name,$email,$hash);
        if($stmt->execute()){ header("Location: login.php"); exit; }
        $error="Email may already be registered.";
    } else $error="Enter valid information. Password must be at least 6 characters.";
}
$pageTitle="Register | MISA"; include "includes/header.php"; include "includes/navbar.php";
?>
<div class="auth-wrap"><div class="auth-card"><div class="eyebrow">CREATE ACCOUNT</div><h1>Register</h1>
<?php if($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post"><label>Full name</label><input name="name" required><label>Email</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" minlength="6" required><button class="btn btn-primary full">Create account</button></form>
</div></div>
<?php include "includes/footer.php"; ?>