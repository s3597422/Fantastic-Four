<html>
	<body>

	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDBPDO";

		error_reporting( E_ALL&~E_NOTICE );
	
		if(isset($_POST['username']) == FALSE){
			header('Location: ../pp/register.html');
		}
	
	
		//Receive username from clint side
		$entered_username = $_POST['username'];
		//Receive password from client side
		$entered_password = $_POST['password'];
		//Receive confirm password from client side
		$entered_cpassword = $_POST['cpassword'];
		//Receive email from client side
		$entered_email = $_POST['email'];
		//Connection to DB
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT id, username, password,email FROM userinfo WHERE username='$entered_username'";
		$result = $conn->query($sql);
	if($entered_username!="" & $entered_password != "" & $entered_cpassword != "" & $entered_email!= ""){
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$id1 = $row["id"];
				$U1 = $row["username"];
				$P = $row["password"];
				$E = $row["email"];
			}
			echo "Username ".$row["username"]." has exsit";
			echo "<br/>Go <a href='../pp/register.html'>back</a> to register or <a href='../pp/login.html'>login</a>";
		}			
		else
		{
			if($entered_password==$entered_cpassword){
			$register = 0;
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO userinfo (username, password, email)
				VALUES ('$entered_username', '$entered_password', '$entered_email')";
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
			echo "<br/>Go <a href='../pp/register.html'>back</a> to register or <a href='../pp/login.html'>login</a>";
			}
			else {
				echo "Password and Confirm Password must be the same";
				echo "<br/>Go <a href='../pp/register.html'>back</a> to register or <a href='../pp/login.html'>login</a>";
			}
		}
	}
	else{
		echo "Username and Password cannot be empty!";
		echo "<br/>Go <a href='../pp/register.html'>back</a> to register or <a href='../pp/login.html'>login</a>";
	}
	?>

	</body>
</html>

