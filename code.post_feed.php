<?php
    session_start();
    if($_SESSION == ''){
        header('Location: index.php');
    }
?>

<?php
    include("config.php");
    
    $t8 =  $_GET['t5']; 
    
    $host = "localhost";
    $username = "id8863927_root";
    $password = "testing";
    $dbname = "id8863927_student";
    $id;
    $conn = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
	$query = "select * 
	          from user_profile
	          where id_account = '$t8'";
	$result = $conn->query($query);

	foreach ($result as $row) {
		$id = $row[0];
	}


    if(isset($_POST['but_upload1'])){
     
      $desc1 = $_POST['desc1'];
      
      $tz = 'Asia/Bangkok';
      $timestamp = time();
      $dt = new DateTime("now", new DateTimeZone($tz)); 
      $dt->setTimestamp($timestamp);
      $date1 = $dt->format('Y-m-d H:i:s');
   
      $name = $_FILES['file']['name'];
      $target_dir = "uploads_feed/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
      // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
      // Valid file extensions
      $extensions_arr = array("jpg","jpeg","png","gif");
    
      // Check extension
      if( in_array($imageFileType,$extensions_arr) ){
     
         // Insert record
         $query = "insert into images_posts(username,descPost,picProfile,date_created) values('$id','$desc1','".$name."','$date1')";
         mysqli_query($con,$query);
      
         // Upload file
         move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
    
      }
      
    }
    echo "<script>location.href= 'feeds.php?t1=".$_GET['t5']."'</script>";
?>