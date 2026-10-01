<?php
session_start();
include("../php/config.php");



if (isset($_POST['recover'])) {
    $id = $_POST['id'];
    $query = "INSERT INTO users SELECT * FROM archives WHERE Id='$id'";
    mysqli_query($con, $query);
    $query = "DELETE FROM archives WHERE Id='$id'";
    mysqli_query($con, $query);
}


if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM archives WHERE Id='$id'";
    mysqli_query($con, $query);
}


$query = "SELECT * FROM archives";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
            <h2 class="page-title">User Archives</h2>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['Id']; ?></td>
                        <td><?php echo $row['Username']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Password']; ?></td>
                        <td class="action-buttons">
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                                <button type="submit" name="recover" class="btn-success">Recover</button>
                            </form>
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                                <button type="submit" name="delete" class="btn-danger" onclick="return confirm('Are you sure you want to permanently delete this user?')">Delete Permanently</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>
</body>

</html>