 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO userinfo (username, password, email)
    VALUES ('Username2', 'password2', 'email2@email.com')";
    // use exec() because no results are returned
    $conn->exec($sql);
    //$conn->exec("INSERT INTO userinfo (Username, password, email)
    //VALUES ('Username', 'password', 'email@email.com')");
	//$conn->commit();
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?> 