<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "navitha";
$dbname = "AUEC";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
</head>
<body>
    <h1>Registered Users</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['created_at']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
