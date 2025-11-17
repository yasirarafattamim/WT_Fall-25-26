<!DOCTYPE html>
<head>
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration</h2>
    <from>
        Full Name:<br><br>
        <input type="text"><br><br><br>
        Email:<br>
        <input type="email"><br><br>
        password:<br>
        <input type="password"><br><br>
        Confirm Password: <br>
        <input type="password"><br><br>
    </form>
 
    <div class="success"></div>
 
    <h2>Course Registration</h2>
    Course Name:<br>
    <input type="checkbox"> Data Structures<br>
 
</body>
<script>
    funcation register(){
        let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let pass = document.getElementById("pass").value;
    let cpass = document.getElementById("cpass").value;
if (!name || !email || !pass || !cpass){
    alert("all fields are required");
    return;
     if (!email.includes("@")) {
        alert("Invalid Email!");
        return;
    }

    if (pass !== cpass) {
        alert("Passwords do not match!");
        return;
    }
document.getElementById("success").innerHTML = 
        `<div style="background:#ccffcc; padding:10px; margin-top:10px;">
            <b>Registration Successful!</b><br>
            Name: ${name} <br>
            Email: ${email}
        </div>`;
}function addCourse() {
    let course = document.getElementById("courseName").value;

    if (!course) {
        alert("Please enter a course name!");
        return;
    }

    let li = document.createElement("li");
    li.textContent = course;

    let btn = document.createElement("button");
    btn.textContent = "Delete";
    btn.style.marginLeft = "10px";

    btn.onclick = function () {
        li.remove();
    };



