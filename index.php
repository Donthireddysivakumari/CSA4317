<?php
$conn = mysqli_connect("localhost", "root", "", "reservation");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role'];
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered. Please login.');</script>";
    } else {
        $sql = "INSERT INTO users (name, email, password, role)
                VALUES ('$name', '$email', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful!go to login page'); window.location.href='LOGIN.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Role:
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Register</button><br><br>
<a href="welcome.php"><button type="button">Back to Home</button></a>
    </form>
</body>
</html>
