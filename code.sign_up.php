<?php
    $servername = "localhost";
    $usernamephp = "id8863927_root";
    $passwordphp = "testing";
    $dbname = "id8863927_student";
    
                
    $username;
    $password;
    $firstname;
	$lastname;
	$birthday;
	$nationality;
	$gender;
	$password1;

		if(isset($_POST['username'])) 
			$username=$_POST['username'];
		
		if(isset($_POST['password'])) {
			$password=$_POST['password'];
			$password1=md5($password);
		}
			
		if(isset($_POST['firstname'])) 
			$firstname=$_POST['firstname'];
			
		if(isset($_POST['lastname'])) 
			$lastname=$_POST['lastname'];
			
		if(isset($_POST['nationality'])) 
			$nationality=$_POST['nationality'];
			
		if(isset($_POST['birthday'])) 
			$birthday=$_POST['birthday'];
	    
	    if(isset($_POST['gender'])) 
			$gender=$_POST['gender'];
			
		try{
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $usernamephp, $passwordphp);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO user_profile(username, pwd, first_name, last_name, birthdate, gender, nationality) VALUES ('$username', '$password1', '$firstname', '$lastname', '$birthday', '$gender',            '$nationality')";
			$conn->exec($sql);
			echo "<script type='text/javascript'>location.href='index.php';</script>";
		}

		catch(PDOException $e){
			echo $e->getMessage();
		}

		$conn = null;
?>