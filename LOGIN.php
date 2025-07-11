<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "reservation");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 // or change to 'db_connect.php' if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($res);

    if ($user && $password == $user['password']) { // If you did not use password_hash
        $_SESSION['user'] = $user;

        // Role-based redirection
        if ($user['role'] === 'admin') {
            header("Location: admindashboard.php");
        } else if ($user['role'] === 'user') {
            header("Location:dashboard.php");
        } else {
            echo "Invalid role.";
        }
    } else {
        echo "Invalid login";
    }
}
?>

<form method="POST">
    <h2>Login</h2>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button><br><br>
<a href="welcome.php"><button type="button">Back to Home</button></a>

</form>
