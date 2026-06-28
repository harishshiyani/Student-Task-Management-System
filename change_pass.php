<?php
include 'db.php';

if(isset($_POST['change'])){
    $email = trim($_POST['email']);
    $new = trim($_POST['new']);
    $confirm = trim($_POST['confirm']);

    if($email=='' || $new=='' || $confirm==''){
        $msg = "All fields are required";
    }
    elseif(strlen($new) < 4){
        $msg = "Password must be at least 4 characters";
    }
    elseif($new !== $confirm){
        $msg = "Passwords do not match";
    }
    else{
        $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($check)==1){
            mysqli_query($conn,"UPDATE users SET password='$new' WHERE email='$email'");
            $msg = "Password changed successfully";
        } else {
            $msg = "Email not registered";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
function togglePass(){
    let p1 = document.getElementById("new");
    let p2 = document.getElementById("confirm");
    p1.type = p1.type === "password" ? "text" : "password";
    p2.type = p2.type === "password" ? "text" : "password";
}

function passValidate(){
    let ok = true;

    let p1 = document.getElementById("new").value.trim();
    let p2 = document.getElementById("confirm").value.trim();

    document.getElementById("newErr").innerHTML = "";
    document.getElementById("conErr").innerHTML = "";

    if(p1.length < 4){
        document.getElementById("newErr").innerHTML = "Minimum 4 characters";
        ok = false;
    }

    if(p1 !== p2){
        document.getElementById("conErr").innerHTML = "Passwords do not match";
        ok = false;
    }

    return ok;
}
</script>
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card shadow p-4" style="max-width:420px;margin:auto">

<h4 class="text-center mb-3">Change Pass</h4>

<?php if(isset($msg)) echo "<div class='alert alert-info'>$msg</div>"; ?>

<form method="post" onsubmit="return passValidate()">

<input type="email" name="email" class="form-control mb-2"
placeholder="Registered Email" required>

<input type="password" id="new" name="new" class="form-control"
placeholder="New Password">
<small id="newErr" class="text-danger"></small>

<input type="password" id="confirm" name="confirm" class="form-control mt-2"
placeholder="Confirm Password">
<small id="conErr" class="text-danger"></small>

<div class="mt-2">
<input type="checkbox" onclick="togglePass()"> Show Password
</div>

<button name="change" class="btn btn-primary w-100 mt-3">
Change Password
</button>

<a href="login.php" class="btn btn-secondary w-100 mt-2">
Back to Dashboard
</a>

</form>

</div>
</div>
</body>
</html>
