<?php 
    session_start();
    if($_SESSION == ''){
        header('Location: index.php');
    }
?>

<?php
	$servername = "localhost";
    $username = "id8863927_root";
    $password = "testing";
    $dbname = "id8863927_student";

	$conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
    $usrnm;
    $t19 =  $_GET['t4']; 
	$query = "SELECT * FROM user_profile WHERE id_account='$t19'";
	$result = $conn->query($query);

	foreach ($result as $row) {
		$usrnm = $row[0];
	}
	
	$result = null;
    $conn = null;
?>

<?php
    include("config.php");
    
    if(isset($_POST['but_upload'])){
     
      $id = $usrnm;
      $name = $_FILES['file']['name'];
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
      // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
      // Valid file extensions
      $extensions_arr = array("jpg","jpeg","png","gif");
    
      // Check extension
      if( in_array($imageFileType,$extensions_arr) ){
     
         // Insert record
         $query = "insert into images_profile(username,img) values('$id','".$name."')";
         mysqli_query($con,$query);
      
         // Upload file
         move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
    
      }
      
    }
    $t22 =  $_GET['t4']; 
    echo "<script>location.href= 'profile.php?t2=".$t22."'</script>";
?>