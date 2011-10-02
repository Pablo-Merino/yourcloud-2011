<div class="page-header">
          <h1>About YourCloud <small>Wanna know more about us? Here is all :)</small></h1>
        </div>
        <div class="row">
          <div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            <h3>YourCloud, support</h3>
            <p style="padding-right: 15px; text-align: justify">You need any kind of support with YourCloud? Any bug found? Potential security bugs? Email <a href="mailto:pablo@zad0xsis.net">the support</a> and we'll get to you as soon as we can :) Thanks!</p>
            <p style="padding-right: 15px; text-align: justify">You can always read our <a href="./?/blog">blog</a> for the latest news about YourCloud :)</p>
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