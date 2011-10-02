<div class="page-header">
          <h1>About YourCloud <small>Wanna know more about us? Here is all :)</small></h1>
        </div>
        <div class="row">
          <div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            <h3>YourCloud, what is it?</h3>
            <p style="padding-right: 15px; text-align: justify">YourCloud is a new cloud storage system, a bit limited due to the expensive cost of the resources. We offer a free 25Mb account, with the possibility to upgrade to bigger accounts. When you upgrade your account you'll help us with maintaining your files safely, accessing your files quickly and easily.</p>
            <h3>Who made this?</h3>
            <p style="padding-right: 15px; text-align: justify">Pablo Merino made this. He's a 15 years old teenager who knows a lot about this, and wanted to make an easy file storage system. He made one which, sadly, had to be shut down due to a server failure. He started it again, resulting on YourCloud 2.0 :)</p>
          <h3>Why does this looks so nice?</h3>
            <p style="padding-right: 15px; text-align: justify">Well, we used <a href="http://twitter.github.com/bootstrap/">Twitter bootstrap</a> which is a framework-like package for making good looking pages quickly. That's why it looks so nice.</p>
            <h3>Can I report suggestions/bugs/anything?</h3>
            <p style="padding-right: 15px; text-align: justify">Yeah! W alike our users to report when they feel something's missing, something has a bug on it or simply they need help. A support site is still under development, so for now send a mail to <a href="mailto:pablo@zad0xsis.net">pablo@zad0xsis.net</a>. Thanks, we appreciate it!</p><br>
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