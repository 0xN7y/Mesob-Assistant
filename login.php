<?php
session_start(); require_once "config/database.php";
$error="";
if($_SERVER['REQUEST_METHOD']==='POST'){
    $email=trim($_POST['email']??''); $password=$_POST['password']??'';
    $stmt=$conn->prepare("SELECT id,name,email,password,role FROM users WHERE email=?");
    $stmt->bind_param("s",$email); $stmt->execute(); $u=$stmt->get_result()->fetch_assoc();
    if($u && password_verify($password,$u['password'])){
        $_SESSION['user_id']=$u['id']; $_SESSION['name']=$u['name']; $_SESSION['role']=$u['role'];
        header("Location: dashboard.php"); exit;
    } else $error="Invalid email or password.";
}
$pageTitle="Login | MISA"; include "includes/header.php"; include "includes/navbar.php";
?>
<div class="auth-wrap"><div class="auth-card"><div class="eyebrow">WELCOME BACK</div><h1>Sign in</h1>
<?php if($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post"><label>Email</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button class="btn btn-primary full">Login</button></form>
<p class="muted">No account? <a href="register.php">Create one</a></p>
</div></div>
<?php include "includes/footer.php"; ?>