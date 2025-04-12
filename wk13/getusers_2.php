<?php
$host = 'localhost';
$db = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstname = isset($_GET['firstname']) ? $_GET['firstname'] : '';
$stmt = $conn->prepare("SELECT * FROM users WHERE firstname = ? AND active = 1");
$stmt->bind_param("s", $firstname);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head><title>Get Users (Secure)</title></head>
<body>
    <form method="get">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname">
        <button type="submit">Search</button>
    </form>

    <table border="1">
        <tr><th>ID</th><th>Username</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Active</th></tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['lastname']}</td>
                        <td>{$row['active']}</td>
                      </tr>";
            }
        }
        ?>
    </table>
</body>
</html>

<?php $stmt->close(); $conn->close(); ?>
