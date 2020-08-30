<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="login_include/message.css" />
</head>
<body>
      <div id="msg1" class="popup">
         <div class="popup-content">
            <div class="popup-header">
               <span class="end">×</span>
               <h2>Warning !</h2>
            </div>
            <div class="popup-body">
               <p>Please enter both your username and password...</p>
            </div>
         </div>
      </div>
      
      <div id="msg2" class="popup">
         <div class="popup-content">
            <div class="popup-header">
               <span class="end2">×</span>
               <h2>Warning !</h2>
            </div>
            <div class="popup-body">
               <p>Wrong username or password...</p>
            </div>
         </div>
      </div>
    
    <?php
    
        $servername = "localhost";
        $usernamephp = "id8863927_root";
        $passwordphp = "testing";
        $dbname = "id8863927_student";
        
                    
        $username = null;
        $password = null;
        $flag=99;
    
    	if(isset($_POST['username'])) 
    		$username=$_POST['username'];
    	
    	if(isset($_POST['password'])) 
    		$password=$_POST['password'];
    		
    	if($username==null && $password==null){
    	    echo "<script type='text/javascript'>
    	             alert('Please Enter Both Your Username and Password...');
    	             location.href='index.php';
    	          </script>";
    	          
    	    header("Location: index.php");
    	}
    	else if($username==null || $password==null) {
    	    echo "<script type='text/javascript'>
                    alert('All fields are required...');
    	            location.href='index.php';
        	        </script>";
    	}
    	else{
    		
        	$conn = new PDO("mysql:host=$servername;dbname=$dbname;", $usernamephp, $passwordphp);
        
        	$query = "SELECT * FROM user_profile";
        	$result = $conn->query($query);
        	
        	foreach($result as $row){
        	    if($row[0] == $username && $row[1] == md5($password) ){
        	        $flag=1;
        	        session_start();
        	        $_SESSION["t1"] = $row[7];
        	        echo "<script type='text/javascript'>location.href='feeds.php?t1=".$_SESSION['t1']."';</script>";
        	    }
        	}
        	if(flag==99){
        	    echo "<script type='text/javascript'>
                    alert('Please Enter Both Your Username and Password...');
    	            location.href='index.php';
        	          </script>";
        	}
        				
        	$result = null;
        	$conn = null;
    	}
    ?>
</body>
</html>