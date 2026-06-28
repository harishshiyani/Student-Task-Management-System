<?php include 'db.php';
if(!isset($_SESSION['user_id'])) header("Location: login.php");

if(isset($_GET['del'])){
    mysqli_query($conn,"DELETE FROM tasks WHERE id=$_GET[del]");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    #summaryCards .card{
    border-radius: 15px;
    background: linear-gradient(135deg,#f9fafb,#eef2ff);
}

body{
    background: linear-gradient(135deg,#1f2937,#4f46e5);
    font-family: 'Segoe UI', sans-serif;
}

.dashboard-container{
    background: #fff;
    border-radius: 18px;
    padding: 25px;
}

.table thead{
    background: #111827;
    color: #fff;
}

.table tbody tr:hover{
    background: #f9fafb;
}

.badge{
    padding: 6px 10px;
    font-size: 13px;
}

.btn-add{
    background: linear-gradient(135deg,#667eea,#764ba2);
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
}

.btn-add:hover{
    opacity: 0.9;
}
</style>
</head>

<body>

<div class="container mt-5">
    <div class="dashboard-container shadow">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">My Tasks</h4>
            <div class="row mb-4" id="summaryCards">
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h6 class="text-muted">Total Tasks</h6>
            <h3 id="totalTasks">0</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow text-center p-3 border-warning">
            <h6 class="text-muted">Pending Tasks</h6>
            <h3 id="pendingTasks" class="text-warning">0</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow text-center p-3 border-success">
            <h6 class="text-muted">Completed Tasks</h6>
            <h3 id="completedTasks" class="text-success">0</h3>
        </div>
    </div>
</div>

            <a href="index.php" class="btn btn-add text-white">
                + Add New Task
            </a>
        </div>

        <table class="table table-bordered table-hover align-middle mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $q=mysqli_query($conn,"SELECT * FROM tasks WHERE user_id='$_SESSION[user_id]'");
            while($row=mysqli_fetch_assoc($q)){
            ?>
            <tr>
                <td><?= $row['task_title']?></td>
                <td><?= $row['task_desc']?></td>
                <td><?= $row['due_date']?></td>
                <td>
                    <span class="badge <?= $row['status']=='Completed'?'bg-success':'bg-warning' ?>">
                        <?= $row['status'] ?>
                    </span>
                </td>
                <td class="text-center">
                <a href="edit_task.php?id=<?= $row['id'] ?>" 
                class="btn btn-warning btn-sm">Edit</a>
                </td>


                <td class="text-center">
                    <a onclick="return confirm('Delete task?')" 
                       href="?del=<?=$row['id']?>" 
                       class="btn btn-danger btn-sm">
                        Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let total = 0, pending = 0, completed = 0;

    document.querySelectorAll("table tbody tr").forEach(row => {
        total++;
        let status = row.querySelector(".badge").innerText.trim();
        if (status === "Completed") completed++;
        else pending++;
    });

    document.getElementById("totalTasks").innerText = total;
    document.getElementById("pendingTasks").innerText = pending;
    document.getElementById("completedTasks").innerText = completed;
});
</script>
