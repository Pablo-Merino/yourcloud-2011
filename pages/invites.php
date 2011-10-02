<div class="page-header">
          <h1>YourCloud <small>Invite station</small></h1>
        </div>
        <div class="row"><?php
        if($location[2] == "error" && $_SESSION['invitecode']) {
        	switch($location[3]) {
        		case "1":
        			?>
        			<div class="span10">
            			<p style="padding-right: 15px; text-align: justify">Looks like you didn't entered the username, password or email address :(</p><br>
          					<form align="center" action="./extra/functions.php" method="post">
            				<input type="hidden" name="action" value="register">
            				<input class="input-xlarge" type="text" placeholder="Username" name="user"><br><br>
            				<input class="input-xlarge" type="password" placeholder="Password" name="pass"><br><br>
            				<input class="input-xlarge" type="text" placeholder="Email address" name="mail"><br><br>

            				<button class="btn" type="submit">Register</button>
          				</form>
                      </div>

        			<?php
        			break;
        		case "2":
        			?>
        			<div class="span10">
            			<p style="padding-right: 15px; text-align: justify">Username can only contain alphanumeric characters :(</p><br>
          					<form align="center" action="./extra/functions.php" method="post">
            				<input type="hidden" name="action" value="register">
            				<input class="input-xlarge" type="text" placeholder="Username" name="user"><br><br>
            				<input class="input-xlarge" type="password" placeholder="Password" name="pass"><br><br>
            				<input class="input-xlarge" type="text" placeholder="Email address" name="mail"><br><br>
            				<input type="hidden" name="invitecode" value="<?php echo $_SESSION['invitecode']?>">

            				<button class="btn" type="submit">Register</button>
          				</form>
                      </div>

        			<?php
        			break;
        		case "3":
        			?>
        			<div class="span10">
            			<p style="padding-right: 15px; text-align: justify">You didn't entered a correct mail address :(</p><br>
          					<form align="center" action="./extra/functions.php" method="post">
            				<input type="hidden" name="action" value="register">
            				<input class="input-xlarge" type="text" placeholder="Username" name="user"><br><br>
            				<input class="input-xlarge" type="password" placeholder="Password" name="pass"><br><br>
            				<input class="input-xlarge" type="text" placeholder="Email address" name="mail"><br><br>
            				<input type="hidden" name="invitecode" value="<?php echo $_SESSION['invitecode']?>">

            				<button class="btn" type="submit">Register</button>
          				</form>
                      </div>

        			<?php
        			break;
				case "4":
        			?>
        			<div class="span10">
            			<p style="padding-right: 15px; text-align: justify">That username already exists :(</p><br>
          					<form align="center" action="./extra/functions.php" method="post">
            				<input type="hidden" name="action" value="register">
            				<input class="input-xlarge" type="text" placeholder="Username" name="user"><br><br>
            				<input class="input-xlarge" type="password" placeholder="Password" name="pass"><br><br>
            				<input class="input-xlarge" type="text" placeholder="Email address" name="mail"><br><br>
            				<input type="hidden" name="invitecode" value="<?php echo $_SESSION['invitecode']?>">

            				<button class="btn" type="submit">Register</button>
          				</form>
                      </div>

        			<?php
        			break;
        		case "5":
        			?>
        			<div class="span10">
            			<p style="padding-right: 15px; text-align: justify">Looks like your invite code is not correct or expired :(</p><br>
          				                      </div>

        			<?php
        			break;
        		default:
        		?>
        			<div class="span10">
            			<p style="padding-right: 15px; text-align: justify">Unexpected error, try again</p><br>
          					<form align="center" action="./extra/functions.php" method="post">
            				<input type="hidden" name="action" value="register">
            				<input class="input-xlarge" type="text" placeholder="Username" name="user"><br><br>
            				<input class="input-xlarge" type="password" placeholder="Password" name="pass"><br><br>
            				<input class="input-xlarge" type="text" placeholder="Email address" name="mail"><br><br>
            				<input type="hidden" name="invitecode" value="<?php echo $_SESSION['invitecode']?>">

            				<button class="btn" type="submit">Register</button>
          				</form>
                      </div>

        			<?php
        	}
        } else if($location[2] == "done") {
        ?>
        	<div class="span10">
            			<p style="padding-right: 15px; text-align: justify">Alright! :D You just registered! You can now <a href="./?/login">login</a> :)</p><br>
            </div>
            <?php
        } else {
        if(decrypt($error, $_SESSION['invitepass']) == "private-beta-link")  {

        	$_SESSION['invitecode'] = $error;

        
        ?>

	          <div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            <p style="padding-right: 15px; text-align: justify">I guess that if you're here you got an invite for YourCloud. You should read the <a data-controls-modal="modal-from-dom" data-backdrop="static" data-keyboard="true">Terms of Service</a>. They include some info you should know and they help us to guarantee a good working service. So you can register right now :)</p><br>

          <!-- sample modal content -->
          <div id="modal-from-dom" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close closeclass">&times;</a>
              <h3>Terms of Service</h3>
            </div>
            <div class="modal-body">
              <p>The terms of YourCloud beta are three:</p>
              <ul>
              	<li>You CAN'T sell invites. If you need one more invite, just <a href="mailto:pablo@zad0xsis.net">mail me</a> telling why you want a second invite</li>
				<li>We appreciate to our beta users to report all the bugs they experience while using the service</li>
              	<li>Please, don't try to hack us with a malicious intention, thanks.</li>

              </ul>
              <p>The default account includes 25Mb, although is not possible to upgrade right now, as this is a private beta.</p>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn primary closeclass">Agree</a>
            </div>
          </div>
		<form align="center" action="./extra/functions.php" method="post">
            				<input type="hidden" name="action" value="register">
            				<input type="hidden" name="invitecode" value="<?php echo $_SESSION['invitecode']?>">

            				<input class="input-xlarge" type="text" placeholder="Username" name="user"><br><br>
            				<input class="input-xlarge" type="password" placeholder="Password" name="pass"><br><br>
            				<input class="input-xlarge" type="text" placeholder="Email address" name="mail"><br><br>

            				<button class="btn" type="submit">Register</button>
          				</form>
          </div>
	<?php

} else if($error == "done"){
?>
<div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            <p style="padding-right: 15px; text-align: justify">Added to the invite list, you should get an mail from us soon :)</p><br>

                    </div>
<?php
} else {
?>
<div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            <p style="padding-right: 15px; text-align: justify">Well, looks like your invite code is not correct. Check the link and try again, or contact <a href="mailto:pablo@zad0xsis.net">me</a>. Sorry for the inconveniences.</p><br>

                    </div>
<?php
}
}
?>
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