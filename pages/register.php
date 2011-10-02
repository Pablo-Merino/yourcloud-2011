<div class="page-header">
          <h1>Register on YourCloud <small>You like it? Register now!</small></h1>
        </div>
        <div class="row">
                  <div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            
			<?php
			if($error == "error") {
				switch($location[3]) {
					case 1:
						?>
						<h3>Well, YourCloud is under private beta :(</h3>
            <p style="padding-right: 15px; text-align: justify">That means only a limited number of users could register. Write here your mail address and we'll contact you when the public beta period is opened, thanks!</p><br>
            <form action="./extra/functions.php" method="post" style="text-align:center">

            	<input class="xlarge" id="xlInput" name="mail" size="30" type="text" placeholder="Enter your mail here!"/>
            	


            	<input type="hidden" name="action" value="beta">
       			<input type="submit" class="btn normal"></input></center>
			</form>
						<span class="label important" style="margin-left: 140px">Please, enter a valid mail address here, thanks.</span>	

						<?php
						
						break;
					case 2:
						?>
						<h3>Well, YourCloud is under private beta :(</h3>
            <p style="padding-right: 15px; text-align: justify">That means only a limited number of users could register. Write here your mail address and we'll contact you when the public beta period is opened, thanks!</p><br>
            <form action="./extra/functions.php" method="post" style="text-align:center">

            	<input class="xlarge" id="xlInput" name="mail" size="30" type="text" placeholder="Enter your mail here!"/>
            	


            	<input type="hidden" name="action" value="beta">
       			<input type="submit" class="btn normal"></input></center>
			</form>
						<span class="label important" style="margin-left: 140px">Please, enter a valid mail address here, thanks.</span>	
	
						<?php
						break;
					default:
						?>
						<h3>Well, YourCloud is under private beta :(</h3>
            <p style="padding-right: 15px; text-align: justify">That means only a limited number of users could register. Write here your mail address and we'll contact you when the public beta period is opened, thanks!</p><br>
            <form action="./extra/functions.php" method="post" style="text-align:center">

            	<input class="xlarge" id="xlInput" name="mail" size="30" type="text" placeholder="Enter your mail here!"/>
            	


            	<input type="hidden" name="action" value="beta">
       			<input type="submit" class="btn normal"></input></center>
			</form>
						<span class="label success" style="margin-left: 80px">We won't sell your mail address to no one, as we won't send spam never</span>	

						<?php						
				} 
			} else if($error == "done") {
				?>
				<h3>You just registered into the private beta!</h3>	
           		<p style="padding-right: 15px; text-align: justify">Please share this, so others can join too. Invites are sent on on Friday usually, so you should get one soon.</p><br>
				<p align="center"><a style href="https://twitter.com/share" class="twitter-share-button" data-url="http://yc.us.to/?/register" data-text="Just registered for YourCloud private beta! Go and register yourself!" data-count="none">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script></p>
				<?php
				
			} else {
			?>
			<h3>Well, YourCloud is under private beta :(</h3>
            <p style="padding-right: 15px; text-align: justify">That means only a limited number of users could register. Write here your mail address and we'll contact you when the public beta period is opened, thanks!</p><br>
            <form action="./extra/functions.php" method="post" style="text-align:center">

            	<input class="xlarge" id="xlInput" name="mail" size="30" type="text" placeholder="Enter your mail here!"/>
            	


            	<input type="hidden" name="action" value="beta">
       			<input type="submit" class="btn normal"></input></center>
			</form>
									<span class="label success" style="margin-left: 80px">We won't sell your mail address to no one, as we won't send spam never</span>	

			<?php
			}
			?>
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