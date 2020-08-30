<?php
    session_start();
    if($_SESSION == ''){
        header('Location: index.php');
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Postigram</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="feeds_include/main.css" />
		<link rel="stylesheet" href="feeds_include/form_edit.css" />
		<link rel="shortcut icon" type="image/x-icon" href="/profile_images/Logo.png"/>
	</head>
	<body class="single is-preload">
			<div id="wrapper">
					<header id="header">
						<h1>Postigram</h1>
						<nav class="links">
							<ul>
								<li><a href="profile.php?t2=<?php echo $_GET['t1'];?>&t99=<?php echo $_GET['t1'];?>">My Profile</a></li>
								<li><input id ="myBtn" type="button" value="POST FEEDS"></li>
								<li><a href="index.php">Logout</a></li>
							</ul>
						</nav>
					</header>

					<div id="main">
						<!-- Post -->
						    <p style="text-align:center;">What's on your mind? Share it right now !<br>
						        <input id ="myBtn2" type="button" value="POST FEEDS"></p>
						    <hr/>
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
            									<div class='title'>";
                        				
                        				$conn3 = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
                        				$query3 = "SELECT * 
                        				           FROM user_profile
                        				           WHERE username = '$row[1]'";
                        				$result3 = $conn->query($query3);
                        				foreach ($result3 as $row3) {
        								    if($row3[7] == $_GET['t1']){
                							    echo "<h2><a href='profile.php?t2=".$_GET['t1']."&t99=".$_GET['t1']."'>".$row[1]."</a></h2>";
                							}
                							else{
                							    echo "<h2><a href='profile.php?t2=f".$row3[7]."&t99=".$_GET['t1']."'>".$row[1]."</a></h2>";
                							}
        								}
            							
            							echo "</div>
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
                									<form style='padding-left: 20px;' action='code.post_comment.php?t10=".$_GET['t1']."' method='POST'>
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
					</div>

					<section id="footer">
						<p class="copyright">&copy; Postigram - Kelompok 7 PemWeb Kelas F</p>
					</section>

			</div>
			
			<div id="modalForm" class="modal">
              <div class="modal-content">
                <span class="close">&times;</span>
                <h2><b>Post Feed</b></h2>
                <form style="padding-left: 20px;" action="code.post_feed.php?t5=<?php echo $_GET['t1']; ?>" method="POST" enctype='multipart/form-data'> 
                    <input type='file' name='file' /> <br> <br>
                    <b>Description: </b><br><input type="text" name="desc1" style="border-radius: 2px;" placeholder="Your Description">
                    <br><br>
                    <input type="submit" value="Submit" name='but_upload1'>  
                    <input id="cancel1" type="button" value="Cancel">
                </form>
              </div>
            </div>
            
            <script>
                var modal = document.getElementById('modalForm');
                var btn = document.getElementById("myBtn");
                var btn2 = document.getElementById("myBtn2");
                var span = document.getElementsByClassName("close")[0];
                var ccl = document.getElementById('cancel1');
                
                btn.onclick = function() {
                  modal.style.display = "block";
                }
                
                btn2.onclick = function() {
                  modal.style.display = "block";
                }
                
                span.onclick = function() {
                  modal.style.display = "none";
                }
                
                ccl.onclick = function() {
                  modal.style.display = "none";
                }
    
                window.onclick = function(event) {
                  if (event.target == modal) {
                    modal.style.display = "none";
                  }
                }
            </script>

			<script src="feeds_include/jquery.min.js"></script>
			<script src="feeds_include/browser.min.js"></script>
			<script src="feeds_include/breakpoints.min.js"></script>
			<script src="feeds_include/util.js"></script>
			<script src="feeds_include/main.js"></script>

	</body>
</html>