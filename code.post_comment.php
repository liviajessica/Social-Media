<?php 
    session_start();
    if($_SESSION == ''){
        header('Location: index.php');
    }
?>

<?php
    $t10 =  $_GET['t10']; 
    
    $host = "localhost";
    $username = "id8863927_root";
    $password = "testing";
    $dbname = "id8863927_student";
    $nama;
    $conn = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
	$query = "select * 
	          from user_profile
	          where id_account = '$t10'";
	$result = $conn->query($query);

	foreach ($result as $row) {
		$nama = $row[0];
	}
	$conn = null;
?>

<?php
    $servername = "localhost";
    $usernamephp = "id8863927_root";
    $passwordphp = "testing";
    $dbname = "id8863927_student";
                
    $id;
    $descc;
    $tz = 'Asia/Bangkok';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); 
    $dt->setTimestamp($timestamp);
    $datee = $dt->format('Y-m-d H:i:s');

	if(isset($_POST['idcmnt'])) 
		$id = $_POST['idcmnt'];
	
	if(isset($_POST['cmnt'])) {
		$descc = $_POST['cmnt'];
	}
		
	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $usernamephp, $passwordphp);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO comment_posts(comment_id, username, comment_txt, date_cmnt) 
		        VALUES ('$id', '$nama', '$descc', '$datee')";
		$conn->exec($sql);
	}

	catch(PDOException $e){
		echo $e->getMessage();
	}

	$conn = null;
	echo "<script>location.href= 'feeds.php?t1=".$_GET['t10']."'</script>";
?>