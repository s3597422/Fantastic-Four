 <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDBPDO";
$username1= "username";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, password,email FROM userinfo WHERE username='$username1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$id1 = $row["id"];
		echo $id1."<br>";
		$U1 = $row["username"];
		echo $U1."<br>";
		$P = $row["password"];
		echo $P."<br>";
		$E = $row["email"];
        echo $E."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 