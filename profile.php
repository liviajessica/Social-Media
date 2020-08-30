<?php 
    session_start();
    if($_SESSION == ''){
        header('Location: index.php');
    }
    $tes = 'f';
    $t50 = $_GET['t2'];
    if (strstr($t50, $tes)){
	    $t55 = trim($t50,'f');
    }
    else{
        $t55 = $t50;
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Postigram</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="profile_include/main.css" />
		<link rel="stylesheet" href="profile_include/form_edit.css" />
		<link rel="shortcut icon" type="image/x-icon" href="/profile_images/Logo.png"/>
	</head>
	<body class="is-preload">
	    <?php 
            $t3 =  $t55; 
            $image_src='uploads/default.png';
            $host = "localhost";
            $username = "id8863927_root";
            $password = "testing";
            $dbname = "id8863927_student";
		    $conn = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
			$query = "select img 
			          from images_profile a, user_profile b
			          where a.username = b.username and b.id_account = '$t3'
			          ORDER BY image_id DESC LIMIT 1";
			$result = $conn->query($query);
            
            if (is_array($result) || is_object($result)){
    			foreach ($result as $row) {
    				$image = $row[0];
                    $image_src = "uploads/".$image;
    			}
            }
            else{
                $image_src='uploads/default.png';
            }

			$result = null;
			$conn = null;
		?>
		<!-- Header -->
			<header id="header">
				<div class="inner" style="text-align:left;">
				    <h1><b>My Profile</b></h1><hr/>
					<a class="image avatar"><img id="btn2" 
					src="<?php echo $image_src; ?>" title="Change Image" /></a>
					<br><br>
					<?php
        	            $t4 = $t55; 
        				$servername = "localhost";
                        $username = "id8863927_root";
                        $password = "testing";
                        $dbname = "id8863927_student";
        
        				$conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
        
        				$query = "SELECT * FROM user_profile WHERE id_account='$t4'";
        				$result = $conn->query($query);
        
        				foreach ($result as $row) {
        					echo "Username: ". $row[0] . "<br>";
        					echo "First Name: ". $row[2] . "<br>";
        					echo "Last Name: ". $row[3] . "<br>";
        					echo "Birthdate: ". $row[4] . "<br>";
        					echo "Gender: ". $row[5] . "<br>";
        					echo "Nationality: ". $row[6] . "<br>";
        				}
        
        				$result = null;
        				$conn = null;
        			?>
        			<br>
        			<?php
            			$tes2 = 'f';
                        if (!strstr($_GET['t2'], $tes2)){
                            echo "<input id='myBtn' type='button' value='Change Password' style='width: 45%;'/>";
                        }
                    ?>
        			<input type="button" value="Back to Home" style="width: 45%;" 
        			 onclick="location.href='feeds.php?t1=<?php echo $_GET['t99']; ?>';"/>
				</div>
			</header>

		<!-- Main -->
			<div id="main">
			    <h2><b>My Feeds</b></h2><hr/>
			    <?php
        			$tes3 = 'f';
                    if (!strstr($_GET['t2'], $tes3)){
                        echo "<p style='text-align:center;'>What's on your mind? Share it right now !<br>
			                  <input id ='myBtn2' type='button' value='POST FEEDS'></p> <hr/>";
                    }
                ?>

				<article class="post">
				    <?php
        				$servername = "localhost";
                        $username = "id8863927_root";
                        $password = "testing";
                        $dbname = "id8863927_student";
        
        				$conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
        
        				$query = "SELECT id, username, descPost, picProfile, 
        				                 CONCAT(SUBSTRING(date_created,12,2), ':', SUBSTRING(date_created,15,2)),
        				                 CONCAT(SUBSTRING(date_created,9,2), '/', SUBSTRING(date_created,6,2), '/', SUBSTRING(date_created,1,4)) 
        				          FROM images_posts 
        				          WHERE username = '$row[0]'
        				          ORDER BY date_created DESC";
        				$result = $conn->query($query);
        
        				foreach ($result as $row) {
        				    $conn2 = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
        				    $flagg = 99;
            				$query2 = "SELECT comment_id, username, comment_txt,
            				                  CONCAT(SUBSTRING(date_cmnt,12,2), ':', SUBSTRING(date_cmnt,15,2)),
            				                  CONCAT(SUBSTRING(date_cmnt,9,2), '/', SUBSTRING(date_cmnt,6,2), '/', SUBSTRING(date_cmnt,1,4)) 
            				           FROM comment_posts
            				           WHERE comment_id = '$row[0]'
            				           ORDER BY date_cmnt";
            				$result2 = $conn->query($query2);
        				    echo "<header>
									<div class='title'>
										<h2>".$row[1]."</h2>
									</div>
									<div class='meta'>
										<time class='published'>".$row[5]."<br>".$row[4]."</time>
									</div>
								</header>
								<span class='image featured'><img src='uploads_feed/".$row[3]."' style='max-width:100%; height:auto;' onclick='window.open(this.src)'/></span>
								<p>".$row[2]."</p>
								<hr/>
								<b>Comment to this post: </b><br>";
								
								if (is_array($result2) || is_object($result2)){
    								foreach ($result2 as $row2) {
    								    $flagg = 0;
    								    echo "<h1>".$row2[1]." - ".$row2[4]." at ".$row2[3]."</h1>";
    								    echo "<p>".$row2[2]."</p>";
    								}
								}
								
							    if($flagg==99){
							        echo "<p>There are no comments on this post... </p><hr/>";
							    }
								
								echo "<footer>
    									<form style='padding-left: 20px;' action='code.post_comment.php?t10=".$t55."' method='POST'>
    									    <input type='hidden' value='".$row[0]."' name='idcmnt'>  
                                            <b>Add Comment: </b><br><input type='text' name='cmnt' style='border-radius: 2px;' placeholder='....'>
                                            <br><br>
                                            <input type='submit' value='Submit'>  
                                        </form>
    								  </footer> <br> <hr/>";
        				}
        
        				$result = null;
        				$conn = null;
        			?>
				</article>

				<section id="footer">
					<p class="copyright" style="text-align:left;">&copy; Postigram - Kelompok 7 PemWeb Kelas F</p>
				</section>
			</div>
			
			<section id="footer">
				<p class="copyright">&copy; Postigram - Kelompok 7 PemWeb Kelas F</p>
			</section>
			
			<div id="modalForm" class="modal">
              <div class="modal-content">
                <span class="close">&times;</span>
                <h2><b>Edit Account Password</b></h2>
                <form style="padding-left: 20px;" action="code.update_pwd.php?t3=<?php echo $t55; ?>" method="POST"> 
                    <b>Your Old Password: </b><br><input type="password" name="pass1" style="border-radius: 2px;" placeholder="Old Password">
                    <br><br>
                    <b>Your New Password: </b>: </b><br><input type="password" name="pass2" style="border-radius: 2px;" placeholder="New Password">
                    <br><br>
                    <b>Re-enter Your New Password: </b><br><input type="password" name="pass3" style="border-radius: 2px;" placeholder="Re-enter New Password">
                    <br><br>
                    <input type="submit" value="Update Password">  
                    <input id="cancel1" type="button" value="Cancel">
                </form>
              </div>
            </div>
            
            <div id="modalChange" class="modal">
              <div class="modal-content">
                <span class="close2">&times;</span>
                <h2><b>Change Profile Picture</b></h2>
                <form method="POST" action="code.edit_picture.php?t4=<?php echo $t55; ?>" enctype='multipart/form-data'>
                  <input type='file' name='file' />
                  <input type='submit' value='Upload Image' name='but_upload'>
                  <input id="cancel2" type="button" value="Cancel">
                </form>
              </div>
            </div>
            
            <div id="modalForm2" class="modal">
              <div class="modal-content">
                <span class="close3">&times;</span>
                <h2><b>Post Feed</b></h2>
                <form style="padding-left: 20px;" action="code.post_feed.php?t5=<?php echo $t55; ?>" method="POST" enctype='multipart/form-data'> 
                    <input type='file' name='file' /> <br> <br>
                    <b>Description: </b><br><input type="text" name="desc1" style="border-radius: 2px;" placeholder="Your Description">
                    <br><br>
                    <input type="submit" value="Submit" name='but_upload1'>  
                    <input id="cancel3" type="button" value="Cancel">
                </form>
              </div>
            </div>
            
            <script>
    
                window.onclick = function(event) {
                  if (event.target == modal) {
                    modal3.style.display = "none";
                  }
                }
            </script>
        
        <script>
            var modal = document.getElementById('modalForm');
            var btn = document.getElementById("myBtn");
            var span = document.getElementsByClassName("close")[0];
            var ccl = document.getElementById('cancel1');
            
            var modal2 = document.getElementById('modalChange');
            var btn2 = document.getElementById("btn2");
            var span2 = document.getElementsByClassName("close2")[0];
            var ccl2 = document.getElementById('cancel2');
            
            var modal3 = document.getElementById('modalForm2');
            var btn3 = document.getElementById("myBtn2");
            var span3 = document.getElementsByClassName("close3")[0];
            var ccl3 = document.getElementById('cancel3');
            
            btn.onclick = function() {
              modal.style.display = "block";
            }
            
            span.onclick = function() {
              modal.style.display = "none";
            }
            
            ccl.onclick = function() {
              modal.style.display = "none";
            }
            
            btn2.onclick = function() {
              modal2.style.display = "block";
            }
            
            span2.onclick = function() {
              modal2.style.display = "none";
            }
            
            ccl2.onclick = function() {
              modal2.style.display = "none";
            }
            
            btn3.onclick = function() {
              modal3.style.display = "block";
            }
            
            span3.onclick = function() {
              modal3.style.display = "none";
            }
            
            ccl3.onclick = function() {
              modal3.style.display = "none";
            }

            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
              else if (event.target == modal2) {
                modal2.style.display = "none";
              }
              else if (event.target == modal3) {
                modal3.style.display = "none";
              }
            }
        </script>

		<!-- Scripts -->
			<script src="profile_include/jquery.min.js"></script>
			<script src="profile_include/jquery.poptrox.min.js"></script>
			<script src="profile_include/browser.min.js"></script>
			<script src="profile_include/breakpoints.min.js"></script>
			<script src="profile_include/util.js"></script>
			<script src="profile_include/main.js"></script>

	</body>
</html>