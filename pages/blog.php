<div class="page-header">
          <h1>Blog <small>We write news and all here :D</small></h1>
        </div>
        <div class="row">
          <div class="span10">
            <!--<h2>YourCloud, hmm, WTF?</h2>--><?php
            if($error == "viewpost") {
            	$post=$location[3].'.post';

				$content = "";

				if(file_exists('./extra/blogposts/'.$post)) {

					$tagValue = array();
					$tagValue = parse('./extra/blogposts/'.$post);
					$content .= "<div class=\"box\" style=\"max-width: 540px; margin-bottom:20px\">\n";
					$content .="<h3><a href=\"?/blog/viewpost/".$file_no_ext."/\">".$tagValue["title"]."</a></h3>\n";
					$content .= "<h3 style=\"margin-top: -10px; margin-bottom: -10px\">".$tagValue["date"]."</h3>\n";
					$content .= "<h3>Posted by ".$tagValue["author"]."</h3>\n";
					$content .= "<p>".$tagValue["body"]."</p><a href=\"https://twitter.com/share\" data-text=\"".$tagValue["title"]." - YourCloud\" class=\"twitter-share-button\" data-count=\"none\">Tweet</a><script type=\"text/javascript\" src=\"//platform.twitter.com/widgets.js\"></script></div>\n";
					
				} else {
					?>
         				
						</ul>
						<div class="alert-message error" style="max-width: 540px; height: 29px">
        				<!--<a class="close" href="#">&times;</a>-->
        				<p style="margin-top: 6px"><strong>Oh god!</strong> Looks like that post is missing :(</p>
        				</div>
         				<?php
				}
				echo $content;
				
            } else {
            $content = "";

			$dirlist = getDirectoryList('./extra/blogposts/');

			natsort($dirlist);
			$dirlist = array_reverse($dirlist);

			foreach ($dirlist as $file) {

				$file_no_ext = str_replace('.post','',$file);

				$tagValue = array();
				$tagValue = parse('./extra/blogposts/'.$file);
			
				$content .= "<div class=\"box\" style=\"max-width: 540px; margin-bottom:20px\">\n";
				$content .="<h3><a href=\"?/blog/viewpost/".$file_no_ext."/\">".$tagValue["title"]."</a></h3>\n";
				$content .= "<h3 style=\"margin-top: -10px; margin-bottom: -10px\">".$tagValue["date"]."</h3>\n";
				$content .= "<h3>Posted by ".$tagValue["author"]."</h3>\n";
				if(strlen($tagValue["body"]) >= 250) {
					$content .= "<p>".substr($tagValue["body"], 0, 250)."... <a href=\"./?/blog/viewpost/".$file_no_ext."/\">Read more</a></p>\n";
				} else {
					$content .= "<p>".$tagValue["body"]."</p>\n";

				}
				
				$content .= "</div>";

			}

			echo $content;
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