<div class="page-header">
          <h1>Login <small>Get into your profile :D</small></h1>
        </div>
        <div class="row">
        <?php
        if($location[2] == "error") {
        ?>
        	<div class="span10">
        	<p>Whoops! Login error, try again</p>
			<form action="./extra/functions.php" method="post" style="text-aling:center">
            	<center><p>Username: <input class="xlarge" id="xlInput" name="user" size="30" type="text" /></p>
            	<p>Password: <input class="xlarge" id="xlInput" name="pass" size="30" type="password" /></p>
            	<input type="hidden" name="action" value="login">
       			<input type="submit" class="btn normal"></input></center>
			</form>
          </div><?php
        } else {
        ?> 
          <div class="span10">
			<form action="./extra/functions.php" method="post" style="text-aling:center">
            	<center><p>Username: <input class="xlarge" id="xlInput" name="user" size="30" type="text" /></p>
            	<p>Password: <input class="xlarge" id="xlInput" name="pass" size="30" type="password" /></p>
            	<input type="hidden" name="action" value="login">
       			<input type="submit" class="btn normal"></input></center>
			</form>
          </div>
          <?php
            }
				?>
		            <div class="span4">
                        <div style="text-align:center"><img src="./img/logo.png" style="width: 200px; height: 200px"></div>
<hr>
            <?php
					if(isset($_SESSION['user'])) {
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
