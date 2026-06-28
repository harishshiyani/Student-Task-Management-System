<?php 
include 'db.php';

if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="script.js"></script>

<style>
body{
    background: linear-gradient(135deg,#1d2671,#c33764);
    font-family: 'Segoe UI', sans-serif;
}

.login-box{
    width: 380px;
    border-radius: 18px;
    overflow: hidden;
}

.login-header{
    background: rgba(0,0,0,0.2);
    color: black;
    padding: 25px;
    text-align: center;
}

.login-header h4{
    margin-bottom: 5px;
}

.login-header p{
    font-size: 14px;
    opacity: 0.9;
}

.form-control{
    border-radius: 10px;
    padding: 10px;
}

.btn-login{
    background: linear-gradient(135deg,#667eea,#764ba2);
    border: none;
    border-radius: 10px;
    padding: 10px;
    font-weight: 500;
}

.btn-login:hover{
    opacity: 0.9;
}

.card-body{
    background: #fff;
}

small{
    font-size: 13px;
}
</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow login-box">

        <div class="login-header">
            <h4>Student Login</h4>
            <p>Access your task dashboard</p>
        </div>

        <div class="card-body p-4">

            <form method="post" onsubmit="return loginValidate()">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                    <small id="emailLErr" class="text-danger"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                    <small id="passLErr" class="text-danger"></small>
                </div>

                <button name="login" class="btn btn-login text-white w-100 mt-2">
                    Login
                </button>

                <p class="text-center mt-3 mb-0">
                    New student?
                    <a href="register.php" class="fw-semibold text-decoration-none">
                        Register
                    </a>
                </p>

            </form>

        </div>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['login'])){
    $q = mysqli_query($conn,"SELECT * FROM users WHERE email='$_POST[email]' AND password='$_POST[password]'");
    if(mysqli_num_rows($q)==1){
        $row = mysqli_fetch_assoc($q);
        $_SESSION['user_id']=$row['id'];
        $_SESSION['name']=$row['name'];
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Invalid login');</script>";
    }
}
?>
