function taskValidate(){

    let title = document.getElementById("title");
    let desc = document.getElementById("task_desc");
    let date = document.getElementById("due_date");

    let titleErr = document.getElementById("titleErr");
    let descErr = document.getElementById("descErr");
    let dueDateErr = document.getElementById("dueDateErr");

    let ok = true;

    if(title.value.trim() === ""){
        titleErr.innerHTML = "Task title required";
        ok = false;
    } else {
        titleErr.innerHTML = "";
    }

    if(date.value === ""){
        dueDateErr.innerHTML = "Due date required";
        ok = false;
    } else {
        dueDateErr.innerHTML = "";
    }

    if(desc.value.trim() !== "" && desc.value.trim().length < 5){
        descErr.innerHTML = "Minimum 5 characters required";
        ok = false;
    } else {
        descErr.innerHTML = "";
    }

    return ok;
}
