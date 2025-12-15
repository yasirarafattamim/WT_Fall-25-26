<!DOCTYPE html>
<html>
<head>
    <title>Student & Course Registration</title>

    <style>
        body { font-family: Arial; background: #eef2ff; }
        .box {
            width: 350px; background: #fff; padding: 20px;
            margin: 20px auto; border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input, button { width: 100%; padding: 8px; margin: 6px 0; }
        button { background: #007bff; color: #fff; border: none; border-radius: 5px; }
        .success { background: #d8ffcf; padding: 10px; border-radius: 5px; margin-top: 10px; }
        .del { background: red; color: white; width: auto; margin-left: 10px; }
    </style>
</head>

<body>

    <!-- Student Registration -->
    <div class="box">
        <h2>Student Registration</h2>

        <input id="name" type="text" placeholder="Full Name">
        <input id="email" type="text" placeholder="Email">
        <input id="pass" type="password" placeholder="Password">
        <input id="cpass" type="password" placeholder="Confirm Password">

        <button onclick="register()">Register</button>

        <div id="result"></div>
    </div>

    <!-- Course Registration -->
    <div class="box">
        <h2>Course Registration</h2>

        <input id="course" type="text" placeholder="Course Name">
        <button onclick="addCourse()">Add Course</button>

        <ul id="courseList"></ul>
    </div>


<script>
    // Student Registration Function
    function register() {
        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let pass = document.getElementById("pass").value;
        let cpass = document.getElementById("cpass").value;

        if (!name || !email || !pass || !cpass) {
            alert("All fields are required!");
            return;
        }

        if (!email.includes("@")) {
            alert("Invalid Email!");
            return;
        }

        if (pass !== cpass) {
            alert("Passwords do not match!");
            return;
        }

        document.getElementById("result").innerHTML =
            `<div class='success'>
                <b>Registration Successful!</b><br><br>
                Name: ${name} <br>
                Email: ${email}
            </div>`;
    }

    // Add Course Function
    function addCourse() {
        let course = document.getElementById("course").value;

        if (course === "") {
            alert("Enter a course name!");
            return;
        }

        let li = document.createElement("li");
        li.textContent = course;

        let delBtn = document.createElement("button");
        delBtn.textContent = "Delete";
        delBtn.className = "del";

        delBtn.onclick = function () {
            li.remove();
        };

        li.appendChild(delBtn);

        document.getElementById("courseList").appendChild(li);
        document.getElementById("course").value = "";
    }
</script>

</body>
</html>