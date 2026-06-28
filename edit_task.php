<?php
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit();
}

$id = (int)$_GET['id'];

$q = mysqli_query($conn,"SELECT * FROM tasks 
    WHERE id=$id AND user_id='$_SESSION[user_id]'");

if(mysqli_num_rows($q)==0){
    echo "Task not found";
    exit();
}

$row = mysqli_fetch_assoc($q);

if(isset($_POST['update'])){
    $title = trim($_POST['task_title']);
    $desc  = trim($_POST['task_desc']);
    $date  = trim($_POST['due_date']);
    $status = $_POST['status'];

    if($title!='' && $date!=''){
        mysqli_query($conn,"UPDATE tasks SET
            task_title='$title',
            task_desc='$desc',
            due_date='$date',
            status='$status'
            WHERE id=$id AND user_id='$_SESSION[user_id]'
        ");
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Task</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card shadow p-4" style="max-width:500px;margin:auto">

<h4 class="mb-3">Edit Task</h4>

<form method="post">

<label>Task Title</label>
<input type="text" name="task_title" class="form-control mb-2"
value="<?php echo htmlspecialchars($row['task_title']); ?>">

<label>Description</label>
<textarea name="task_desc" class="form-control mb-2"><?php
echo htmlspecialchars($row['task_desc']);
?></textarea>

<label>Due Date</label>
<input type="date" name="due_date" class="form-control mb-2"
value="<?php echo $row['due_date']; ?>">

<label>Status</label>
<select name="status" class="form-control mb-3">
<option <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
<option <?php if($row['status']=='Completed') echo 'selected'; ?>>Completed</option>
</select>

<button name="update" class="btn btn-success">Update Task</button>
<a href="dashboard.php" class="btn btn-secondary">Back</a>

</form>

</div>
</div>
</body>
</html>
