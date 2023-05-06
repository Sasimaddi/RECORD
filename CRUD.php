<!DOCTYPE html>
<html>
<head>
    <title>CRUD Operations in PHP with MySQL</title>
</head>
<body>
    <h1>CRUD Operations in PHP with MySQL</h1>

    <?php
    // Create a connection to MySQL
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'sasi';
    $conn = mysqli_connect($host, $user, $password, $database);

    // Check if the connection was successful
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['create'])) {
            // Handle create operation
            $name = $_POST['name'];
            $email = $_POST['email'];
            $sql = "INSERT INTO login (name, email) VALUES ('$name', '$email')";
            mysqli_query($conn, $sql);
        } elseif (isset($_POST['update'])) {
            // Handle update operation
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $sql = "UPDATE login SET name='$name', email='$email' WHERE id=$id";
            mysqli_query($conn, $sql);
        } elseif (isset($_POST['delete'])) {
            // Handle delete operation
            $id = $_POST['id'];
            $sql = "DELETE FROM login WHERE id=$id";
            mysqli_query($conn, $sql);
        }
    }

    // Display the form
    ?>
    <h2>Create User</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="create">Create</button>
    </form>

    <h2>Update User</h2>
    <form method="post">
        <input type="number" name="id" placeholder="ID" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="update">Update</button>
    </form>

    <h2>Delete User</h2>
    <form method="post">
        <input type="number" name="id" placeholder="ID" required>
        <button type="submit" name="delete">Delete</button>
    </form>

    <h2>View Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php
        // Display all users
        $sql = "SELECT * FROM login";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>