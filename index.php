<?php
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$formErr = '';
$saved = false;

if(isset($_POST['save'])){
    $task_title = trim($_POST['task_title']);
    $task_desc  = trim($_POST['task_desc']);
    $due_date   = trim($_POST['due_date']);
    $status     = $_POST['status'];

    if($task_title === '' || $due_date === ''){
        $formErr = 'Please enter Task Title and Due Date.';
    } elseif(strlen($task_title) < 3){
        $formErr = 'Task title must be at least 3 characters.';
    } elseif($due_date < date('Y-m-d')){
        $formErr = 'Due date cannot be in the past.';
    } else {
        $task_title = mysqli_real_escape_string($conn,$task_title);
        $task_desc  = mysqli_real_escape_string($conn,$task_desc);
        $due_date   = mysqli_real_escape_string($conn,$due_date);
        $status     = mysqli_real_escape_string($conn,$status);

        mysqli_query($conn,"INSERT INTO tasks(user_id,task_title,task_desc,due_date,status)
        VALUES('$_SESSION[user_id]','$task_title','$task_desc','$due_date','$status')");

        header("Location: index.php?success=1");
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Add Task</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="script.js"></script>

<style>
body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    font-family: 'Segoe UI', sans-serif;
}

.dashboard-card{
    border-radius: 18px;
    overflow: hidden;
}

.dashboard-header{
    background: rgba(0,0,0,0.25);
    color: black;
    padding: 20px 25px;
}

.dashboard-header h5{
    margin: 0;
}

.form-control, textarea, select{
    border-radius: 10px;
}

.btn-add{
    background: linear-gradient(135deg,#22c55e,#16a34a);
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 500;
}

.btn-view{
    background: #111827;
    border-radius: 10px;
    padding: 10px 18px;
}

.btn-add:hover, .btn-view:hover{
    opacity: 0.9;
}

small{
    font-size: 13px;
}
</style>
</head>

<body>

<div class="container mt-5">
    <div class="card shadow dashboard-card">

        <div class="dashboard-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Welcome, <?php echo $_SESSION['name']; ?></h5>

    <div class="d-flex gap-2">
        <a href="change_pass.php" class="btn btn-dark btn-sm">
            Change Password
        </a>
        <a href="logout.php" class="btn btn-danger btn-sm">
            Logout
        </a>
    </div>
</div>



        <div class="card-body p-4">

           <?php if($formErr!=''){ ?>
    <div class="alert alert-danger"><?= $formErr ?></div>
<?php } ?>

<?php if(isset($_GET['success'])){ ?>
<div class="alert alert-success">Task added successfully</div>
<?php } ?>

            <form method="post" id="taskForm" onsubmit="return taskValidate()">

                <div class="mb-3">
                    <label class="form-label">Task Title</label>
                    <input type="text" id="title" name="task_title" class="form-control" placeholder="Enter task title">
                    <small id="titleErr" class="text-danger"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="task_desc" name="task_desc" class="form-control" rows="3" placeholder="Task description"></textarea>
                    <small id="descErr" class="text-danger"></small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control">
                        <small id="dueDateErr" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option>Pending</option>
                            <option>Completed</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="save" class="btn btn-success mt-3">
                    Add Task
                </button>

                <a href="dashboard.php" class="btn btn-view text-white mt-2">
                    View Tasks
                </a>

            </form>

        </div>
    </div>
</div>

</body>
</html>