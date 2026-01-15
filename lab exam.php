<!DOCTYPE html>
<html>
<body>
<form method="post">
<table>
<tr>
<td>Name</td>
<td><input type="text" name="name"></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" name="email"></td>
</tr>
<tr>
<td>Date of Birth</td>
<td>
<input type="number" name="dd" placeholder="DD">
<input type="number" name="mm" placeholder="MM">
<input type="number" name="yy" placeholder="YYYY">
</td>
</tr>
<tr>
<td>Gender</td>
<td>
<input type="radio" name="gender" value="Male">Male
<input type="radio" name="gender" value="Female">Female
<input type="radio" name="gender" value="Other">Other
</td>
</tr>
<tr>
<td>Degree</td>
<td>
<input type="checkbox" name="degree[]" value="SSC">SSC
<input type="checkbox" name="degree[]" value="HSC">HSC
<input type="checkbox" name="degree[]" value="BSc">BSc
<input type="checkbox" name="degree[]" value="MSc">MSc
</td>
</tr>
<tr>
<td></td>
<td><button type="submit">Submit</button></td>
</tr>
</table>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_POST["name"];
$email = $_POST["email"];
$dd = $_POST["dd"];
$mm = $_POST["mm"];
$yy = $_POST["yy"];
if (empty($name)) {
echo "Name can't be empty";
}
else if (str_word_count($name) < 2) {
echo "Name must contain two words";
}
else if (!preg_match("/^[A-Za-z]/", $name)) {
echo "Name must start with letter";
}
else if (!preg_match("/^[A-Za-z .-]+$/", $name)) {
echo "Invalid name format";
}
else if (empty($email)) {
echo "Email can't be empty";
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo "Invalid email";
}
else if (empty($dd) || empty($mm) || empty($yy)) {
echo "DOB required";
}
else if ($dd < 1 || $dd > 31 || $mm < 1 || $mm > 12 || $yy < 1953 || $yy > 1998) {
echo "Invalid DOB";
}
else if (!isset($_POST["gender"])) {
echo "Select gender";
}
else if (!isset($_POST["degree"]) || count($_POST["degree"]) < 2) {
echo "Select at least two degrees";
}
else {
echo "All Data Valid";}
}
?>
</body>
</html>