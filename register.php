<?php include 'db.php';

if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="script.js"></script>

<style>
body{
    background: linear-gradient(135deg,#11998e,#38ef7d);
    font-family: 'Segoe UI', sans-serif;
}

.register-box{
    width: 400px;
    border-radius: 18px;
    overflow: hidden;
}

.register-header{
    background: rgba(0,0,0,0.25);
    color: #fff;
    padding: 25px;
    text-align: center;
}

.register-header h4{
    margin-bottom: 5px;
}

.register-header p{
    font-size: 14px;
    opacity: 0.9;
}

.card-body{
    background: #fff;
}

.form-control{
    border-radius: 10px;
    padding: 10px;
}

.btn-register{
    background: linear-gradient(135deg,#16a34a,#22c55e);
    border: none;
    border-radius: 10px;
    padding: 10px;
    font-weight: 500;
}

.btn-register:hover{
    opacity: 0.9;
}

small{
    font-size: 13px;
}
</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow register-box">

        <div class="register-header">
            <h4>Student Registration</h4>
            <p>Create your account</p>
        </div>

        <div class="card-body p-4">

            <form method="post" onsubmit="return registerValidate()">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" id="rname" name="name" class="form-control" placeholder="Enter full name">
                    <small id="nameErr" class="text-danger"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" id="remail" name="email" class="form-control" placeholder="Enter email">
                    <small id="emailErr" class="text-danger"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" id="rpass" name="password" class="form-control" placeholder="Create password">
                    <small id="passErr" class="text-danger"></small>
                </div>

                <button name="register" class="btn btn-register text-white w-100 mt-2">
                    Register
                </button>

                <p class="text-center mt-3 mb-0">
                    Already have an account?
                    <a href="login.php" class="fw-semibold text-decoration-none">
                        Login
                    </a>
                </p>

            </form>

        </div>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['register'])){
    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$_POST[email]'");
    if(mysqli_num_rows($check)>0){
        echo "<script>alert('Email already registered');</script>";
    } else {
        mysqli_query($conn,"INSERT INTO users(name,email,password)
        VALUES('$_POST[name]','$_POST[email]','$_POST[password]')");
        echo "<script>alert('Registration Successful'); window.location='login.php';</script>";
    }
}
?>
