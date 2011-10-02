<?php
if($_SESSION['userlevel'] != 1) {
	    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./?/home">';    

} else {

?>
<div class="page-header">
          <h1>Admin panel</h1>
        </div>
        <div class="row">
          <div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>-->
            <h3>User list</h3>
            <p style="padding-right: 15px; text-align: justify"><ol>
            <?php
            $dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());
			
           	mysql_select_db("yc2", $dbconnect) or die("could not select database<br>".mysql_error());

			$result = mysql_query("SELECT * FROM users", $dbconnect) or die(mysql_error());

			while($r[]=mysql_fetch_row($result));
			sort($r);

			foreach($r as $element) {
			if($element) {
			
				echo "<li>".$element[0]."</li>";
			}
			}
            ?>
            
            </p></ol>
            <h3>Invite list</h3>
            <p style="padding-right: 15px; text-align: justify">
            <?php
            $dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());
			
           	$invites = getInvites($dbconnect);
            echo "<ol>";
           	foreach($invites as $key) {
           		if($key) {
					 echo "<li>".$key[0]."</li>";

           		}
           	}
            echo "</ol>";
           	echo "Invite link: ./?/invites/".encrypt("private-beta-link", $_SESSION['invitepass']);

            ?>
            <br><form action="./extra/functions.php" method="post" align="center">
              
              <input type="hidden" name="action" value="newinvitepass">

                  <button class="btn success" type="submit">Generate new invite link</button>
                </form>
                <form action="./extra/functions.php" method="post" align="center">
              
              <input type="hidden" name="action" value="cleaninvites">

                  <button class="btn warning" type="submit">Clean invites</button>
                </form><?php 
                $cmd = shell_exec("df -h | grep /dev/sda");
                $cmd = explode(" ", $cmd);
                foreach($cmd as $key => $value) { 
                  if(is_null($value) || $value=="") { 
                    unset($cmd[$key]); 
                  } 
                } 
                $newcmd = array_values($cmd);
                ?>
                <h3>System stats</h3>
                <p>HD Free space = <?php echo $newcmd[3];?></p>
                <p>Used = <?php echo $newcmd[4];?></p>
                <p>Memory details = <?php 

                $mem = getMemDetails();
                $mem = explode(" ", $mem);
                echo $mem[2]."MB free of ".$mem[0]."MB total. Used ".$mem[1]."MB";
                
                ?></p>
            <h3>New post</h3> 
        	<form action="./extra/functions.php" method="POST">
        					<input type="hidden" name="action" value="addpost">
            				<input class="medium" name="title" size="16" type="text" placeholder="Post name"/> <br><br>
       				        <input class="medium" name="author" size="16" type="text" placeholder="Post author" value="<?php echo $_SESSION['user'] ?>"/> <br><br>
            				<input class="medium" name="date" size="16" type="text" placeholder="Post date" value="<?php echo date('F jS, y');?>"/> <br><br>
							<textarea class="xxlarge" id="textarea" name="content" placeholder="Post content"></textarea> <br><br>
      		<button type="submit" class="btn primary">Post</button> 
              		</form>

                      </div>
                               <div class="span4">

                     	<?php
          	if(isset($_SESSION['user'])) {

          	$kbmax = $_SESSION['max']; 
          	$kbleft = getDirectorySize("./data/".$_SESSION['user']."/");
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
					}
				?>

          </div>