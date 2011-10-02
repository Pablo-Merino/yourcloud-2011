<div class="page-header">
          <h1>Profile <small>Here you manage your YourCloud profile</small></h1>
        </div>
        <div class="row">
          <div class="span10">
         	<?php
if(isset($_SESSION['user'])) {

	if($error == "files") {

		if($location[3]) {
			$file = urldecode($location[3]);
			if(file_exists("./data/".$_SESSION['user']."/".$file)) {

?>
					<ul class="breadcrumb" style="max-width: 540px;">
  						<li><a href="./?/profile">Profile</a> <span class="divider">/</span></li>
  						<li><a href="./?/profile/files">Files</a> <span class="divider">/</span></li>
  						<li class="active"><?php
				$filexp = explode(".", $file);

				$file = str_replace($filexp[0].".", "", $file);
				echo $file;

				?></li>
					</ul><?php
				$file = urldecode($location[3]);
				$extension = file_extension(urldecode($location[3]));
				$files = array("jpeg", "jpg", "png", "bmp", "gif");
				if(in_array($extension, $files)) {
?>
						<div style="float:left">
						<ul class="media-grid">
  							<li>
    							<a href="#">
      								<img style="min-width: 420px; max-height: 200px; min-height:150px" class="thumbnail" src="./data/<?php echo $_SESSION['user']."/".urldecode($location[3]);?>" alt="">
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
?>
					<form action="./extra/dl.php" method="post" align="center">
						<input type="hidden" name="file" value="<?php echo $location[3];?>">

            			<button class="btn success" type="submit">Download!</button>
          			</form>
          			<form action="./extra/functions.php" method="post" align="center">
						<input type="hidden" name="action" value="delete">
						<input type="hidden" name="filename" value="<?php echo $location[3];?>">

            			<button class="btn danger" type="submit">Delete file</button>
          			</form><?php
				$filexp = explode(".", $file);
?>
          			<p align="center" style="word-wrap: break-word;"><?php

				$filen = str_replace($filexp[0].".", "", $file);
				echo $filen;

?>

          			</p>

					<?php
				$ispublic = explode(".", $file);
				$ispublic = base64_decode($ispublic[0]);
				$ispublic = explode("->", $ispublic);
				$ispublic = $ispublic[1];
				if($ispublic != 1) {
				}else{
					?><p align="center">Public link: <a href="http://yc.us.to/?/public/<?php echo $_SESSION['user']."/".$file?>">here</a></p><?php
				}

			} else {
?>
         				<ul class="breadcrumb" style="max-width: 540px;">
  							<li><a href="./?/profile">Profile</a> <span class="divider">/</span></li>
  							<li><a href="./?/profile/files">Files</a> <span class="divider">/</span></li>
  							<li class="active">Error</li>
						</ul>
						<div class="alert-message error" style="max-width: 540px; height: 29px">
        				<!--<a class="close" href="#">&times;</a>-->
        				<p style="margin-top: 6px"><strong>Oh god!</strong> It looks like that file doesn't exists :(</p>
        				</div>
         				<?php
			}
		} else {
			$username = $_SESSION['user'];
			$dirname = "./data/$username/";
			$dir = opendir($dirname);
?>
<ul class="breadcrumb" style="max-width: 540px;">
  						<li><a href="./?/profile">Profile</a> <span class="divider">/</span></li>
  						<li class="active">Files</li>
					</ul>
				<center><h4>List of files:</h4>
				<table style="width: 300px" class="zebra-striped">
			<?php
			$files = FALSE;

			if (glob($dirname . "*") != false)
			{
				while(false != ($file = readdir($dir)))
				{

					if(($file != ".") && ($file != "..") && ($file != ".htaccess"))
					{
						$filexp = explode(".", $file);
						$files = TRUE;
						$filen = str_replace($filexp[0].".", "", $file);
						echo "<tr><td><a href='./?/profile/files/$file'>$filen &raquo;</a></td></tr>";
					}

				}
			}
			else
			{
				echo "<tr><td>No files, upload some! :D</td></tr>";
			}


		}
		echo "</table>";

	} else if($error == "settings"){
			if($location[3] == "done") {
?>


				<div class="alert-message success" style="max-width: 540px">
  					<p><strong>Your action was performed successfully :D</strong> Your action was performed correctly, you can go back to your <a href="./?/profile">profile</a>.</p>
				</div><?php
			} else if($location[3] == "wipe") {
?>


				<div class="alert-message warning" style="max-width: 540px; height: 70px">
				       				<!--<a href="./?/login" class="btn danger" style="float:right">Wipe it</a>-->

  					<p style="margin-top: 6px; margin-bottom:10px"><strong>WARNING!</strong> You're about to wipe all the data in your account, are you sure?</p>
  					<form align="center" action="./extra/functions.php" method="post">
  						<button class="btn danger" style="float: right" type="submit">Wipe now</button>

						<input type="hidden" name="action" value="wipeacc">
						<div style="float:left"><input type="hidden" name="user" value="<?php echo $_SESSION['user']?>"></div>

						<input class="input-big" type="password" placeholder="Input your password for verify" name="pass"><br><br>

						

					</form>
				</div>
		<?php
				} else {?>
				<h1 align="center">Hi <?php echo $_SESSION['user']?> :)</h1>
				<div class="box" style="max-width: 540px">
					<h4 align="center">Change your password</h4>
					<form align="center" action="./extra/functions.php" method="post">
						<input type="hidden" name="action" value="chpass">
						<input type="hidden" name="user" value="<?php echo $_SESSION['user']?>">

						<input class="input-big" type="password" placeholder="Old password" name="oldpass"><br><br>

						<input class="input-big" type="password" placeholder="New password" name="newpass"><br><br>
						<input class="input-big" type="password" placeholder="New password again" name="checkpass"><br><br>

						<button class="btn" type="submit">Sign in</button>
					</form>
				</div><br>
				<div class="box" style="max-width: 540px; min-height: 70px">
					<h4 align="center">Wipe all my data</h4>
					<div align="center"><a href="./?/profile/settings/wipe" class="btn warning">Wipe my files</a></div>

				</div>
		<?php
			}

		} else if($error == "error") {
			$chpasserr = array("1", "2", "3", "4");
			if(in_array($location[3], $chpasserr)) {
?>

				<div class="alert-message warning" style="max-width: 540px">
  <p><strong>Error doing requested action</strong> Looks like was an error while doing the requested action, try checking inputed text and <a href="./?/profile/settings">try again</a>.</p>
</div>


		<?php
			} else if(in_array($location[3], array("4", "5", "6"))){
?>
				<div class="alert-message warning" style="max-width: 540px">
  					<p><strong>Upload error occurred</strong> Looks like an upload error occurred, please try uploading the file again.</p>
				</div>
			<?php

				} else {
?>
				<div class="alert-message warning" style="max-width: 540px">
  					<p><strong>Unknown error ocurred</strong> Looks like an unknown error occurred, please try again.</p>
				</div>
			<?php

			}
		} else if(!$error) {
?>
		<h1 align="center">Hi <?php echo $_SESSION['user']?> :)</h1>
		<div class="box" style="max-width: 540px">
		<form action="./extra/ul.php" method="post" enctype="multipart/form-data" align="center">

      		<input type="file" name="file" id="file" style="background-color: #f5f5f5; margin-bottom: 5px"><br>
      		<input type="checkbox" name="public"> Set as public?</input><br><br>
      		<input type="submit" class="btn normal" style="margin-bottom: -15px"></input>
		</form></div>

		<?php
		}
} else {
?>
<div class="alert-message info" style="max-width: 540px; height: 29px">
        			<!--<a class="close" href="#">&times;</a>-->
       				<a href="./?/login" class="btn info" style="float:right">Login</a>
        			<p style="margin-top: 6px"><strong>Notice:</strong> You're either not logged in, or just logged off</p>
      			</div>
<?php
}

?>

          </div>		     <div class="span4">
<?php
if(isset($_SESSION['user'])) {

	$kbmax = $_SESSION['max'];
	$kbleft = getDirectorySize("./data/".$_SESSION['user']."/");
	$_SESSION['left'] = ($kbmax - $kbleft['size']);
	//echo convert_from_bytes(($kbmax - $kbleft['size']), "MB");
	$percent = (($kbleft['size'] / $kbmax) *100);
?>
                        <div class="meter-wrap">
    						<div class="meter-value" style="background-color: #0a0; width: <?php echo $percent?>%;">
        							<div class="meter-text"><?php
	echo round($percent, 0)."% full";
	?></div>
    						</div>
						</div>
						          	<br><p align="center">Space left: <?php echo convert_from_bytes(($kbmax - $kbleft['size']), "MB");?> Megabytes</p>

<hr>
            <?php
} else {
?>
                                    <div style="text-align:center"><img src="./img/logo.png" style="width: 200px; height: 200px"></div><hr>

            <?php
}
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