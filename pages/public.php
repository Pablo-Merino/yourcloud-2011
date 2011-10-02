<div class="page-header">
          <h1>Public file</h1>
        </div>
        <div class="row">
          <div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            <p style="padding-right: 15px; text-align: justify">
            <?php
            $file = urldecode($location[3]);
			if(file_exists("./data/".$error."/".$file)) {
				$ispublic = explode(".", base64_decode($file));
				//$ispublic = base64_decode($ispublic[0]);
				$ispublic = explode("->", $ispublic[0]);
				$ispublic = $ispublic[1];
				if($ispublic != 1) {
					?>
         				
						</ul>
						<div class="alert-message error" style="max-width: 540px; height: 29px">
        				<!--<a class="close" href="#">&times;</a>-->
        				<p style="margin-top: 6px"><strong>Oh god!</strong> It looks like that file doesn't exists :(</p>
        				</div>
         				<?php

				} else {
            	$extension = file_extension(urldecode($location[3]));
				$files = array("jpeg", "jpg", "png", "bmp", "gif");
            	if(in_array($extension, $files)) {
?>
						<div style="float:left">
						<ul class="media-grid">
  							<li>
    							<a href="#">
      								<img style="min-width: 400px; max-height: 200px; min-height:150px" class="thumbnail" src="./data/<?php echo $error."/".urldecode($location[3]);?>" alt="">
    							</a>
  							</li>

						</ul></div>



						<?php
				} else if(in_array($extension, array("mp3"))) {
				?>
				<div align="center">
				<audio controls="controls">
  					<source src="<?php echo "./data/".$_SESSION['user']."/".$file; ?>" type="audio/mp3" />
  					Your browser does not support the audio element.
				</audio></div><br>
				<?php
				}

          			$filexp = explode(".", base64_decode($file));
          			?>
          			<p align="center" style="word-wrap: break-word;"><?php 
          			
          			$filen = str_replace($filexp[0].".", "", base64_decode($file));
          			echo $filen;
          			
          			?>
					<form action="./extra/dl.php" method="post" align="center">
						<input type="hidden" name="puser" value="<?php echo $error."/"?>">

						<input type="hidden" name="pfile" value="<?php echo $location[3];?>">
						<input type="hidden" name="ispublic" value="1">

            			<button class="btn success" type="submit">Download!</button>
          			</form>
          			
					<?php
					}
				} else {
					if($error == "error") {
						?>
         				
						</ul>
						<div class="alert-message error" style="max-width: 540px; height: 29px">
        				<!--<a class="close" href="#">&times;</a>-->
        				<p style="margin-top: 6px"><strong>Oh god!</strong> Looks like an error appeared while downloading the file</p>
        				</div>
         				<?php

					} else {
?>
         				
						</ul>
						<div class="alert-message error" style="max-width: 540px; height: 29px">
        				<!--<a class="close" href="#">&times;</a>-->
        				<p style="margin-top: 6px"><strong>Oh god!</strong> It looks like that file doesn't exists :(</p>
        				</div>
         				<?php
				}
				}?>
            </p>
                      </div>
           <div class="span4">
                        <div style="text-align:center"><img src="./img/logo.png" style="width: 200px; height: 200px"></div>
<hr>
            <?php
					if(!isset($_SESSION['user'])) {
						?>
						<form align="center" action="./extra/functions.php" method="post">
            				<input type="hidden" name="action" value="login">
            				<input class="input-big" type="text" placeholder="Username" name="user"><br><br>
            				<input class="input-big" type="password" placeholder="Password" name="pass"><br><br>
            				<button class="btn" type="submit">Sign in</button>
          				</form>
						<?php
					} else {
						?>
						<ul>
							<li><a href="./?/profile">Profile</a></li>
							<li><a href="./?/profile/files">My files</a></li>
							<li><a href="./?/profile/settings">Settings</a></li>
							
							<li><a href="./?/profile/logout">Logout</a></li>
							
<?php
							if($_SESSION['userlevel'] == 1) {
							?>
							<li><a href="./?/admin">Admin</a></li>

							<?php
							}
							?>
						</ul>
							
						<?php
					}
				?>

          </div>