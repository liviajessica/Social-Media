<?php 
    session_start();
    if($_SESSION == ''){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="profile_include/message2.css" />
</head>
<body>
      <div id="msg1" class="popup">
         <div class="popup-content">
            <div class="popup-header">
               <span class="end">×</span>
               <h2>Warning !</h2>
            </div>
            <div class="popup-body">
               <p>Failed to update password...</p>
            </div>
         </div>
      </div>
      
        <?php
            $servername = "localhost";
            $username = "id8863927_root";
            $password = "testing";
            $dbname = "id8863927_student";
            
            $id = $_GET['t3'];
            $passold;
            $passnew1;
            $passnew2;
            $passnew3;
            $flag = 99;
        
    		if(isset($_POST['pass1'])) 
    			$passold=$_POST['pass1'];
    		
    		if(isset($_POST['pass2']))
    			$passnew1=$_POST['pass2'];
    			
    		if(isset($_POST['pass3'])) 
    			$passnew2=$_POST['pass3'];
    			
    		$conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
        
        	$query = "SELECT * FROM user_profile";
        	$result = $conn->query($query);
        	
        	foreach($result as $row){
        	    if($row[1] == md5($passold) ){
        	        $flag=1;
        	        $passnew3 = md5($passnew1);
            		try{
            			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                        $stmt = $conn->prepare("UPDATE user_profile 
                                                SET pwd=:pw1
                                                WHERE id_account=:id1");
                        $stmt->bindParam(':pw1', $passnew3);
                        $stmt->bindParam(':id1', $id);
                        $stmt->execute();
            		}
            
            		catch(PDOException $e){
            			echo $e->getMessage();
            		}
            
            		$conn = null;
            		$tmp11 = $_GET['t3'];
            		echo "<script type='text/javascript'>alert('Password Updated!');</script>";
            		echo "<script type='text/javascript'>location.href='profile.php?t2=".$tmp11."'</script>";
        	    }
        	}
        				
        	$result = null;
        	$conn = null;
    			
    		if(($passold==null || $passnew1==null || $passnew2==null)
    		   || $passnew1 != $passnew2 || $flag=99){
    		    $tmp12 = $_GET['t3'];
        	    echo "<script type='text/javascript'>
        	             var popup1 = document.getElementById('msg1');
                         var span = document.getElementsByClassName('end')[0];
                         
                         popup1.style.display = 'block';
                         span.onclick = function() {
                            popup1.style.display = 'none';
                            location.href= 'profile.php?t2=".$tmp11."';
                         }
                         window.onclick = function(event) {
                            if (event.target == popup) {
                               popup1.style.display = 'none';
                               location.href= 'profile.php?t2=".$tmp11."';
                            }
                         }
        	          </script>";
        	}
        ?>
    </body>
</html>