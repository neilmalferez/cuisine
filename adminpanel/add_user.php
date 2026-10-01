<?php
session_start();
include("../php/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);


    $insertQuery = "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($con, $insertQuery)) {
        header("Location: user_manage.php");
        exit();
    } else {
        $error = "Error adding user: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <header>
        <h1>FILIPINO CUISINE ADMIN PANEL</h1>
    </header>

    <nav class="sidebar">
        <div class="menu">
            <a href="adminpanel.php">
                <h2>ADMIN DASHBOARD</h2>
            </a>
            <ul>
                <li><a class="btn" href="user_manage.php">Users Management</a></li>
                <li><a class="btn" href="adminpanel.php">Recipe Management</a></li>
                <li><a class="btn" href="user_archive.php">Archives</a></li>
                <li><a class="btn" href="../login.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="page-header">
            <h2 class="page-title">Add New User</h2>
        </div>

        <section class="form-container">
            <?php if (isset($error)) {
                echo "<p style='color: red;'>$error</p>";
            } ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="add_user" class="btn-primary">Add User</button>
                    <a href="user_manage.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>