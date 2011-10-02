<?php
session_start();
$username = $_SESSION['user'];// Put here
$max_filesize = $_SESSION['left'];
$public = $_POST['public']; // Maximum filesize in BYTES (currently 0.5MB).
$upload_path = "../data/".$username."/"; // The place the files will be uploaded to (currently a 'files' directory).

$filename = $_FILES['file']['name']; // Get the name of the file (including file extension).
// Check if it's executable.
// Now check the file size, if it is too large then DIE and inform the user.
if(filesize($_FILES['file']['tmp_name']) > $max_filesize)
	die('<META HTTP-EQUIV="Refresh" Content="0; URL=../?/profile/error/5">');
// Check if we can upload to the specified path, if not DIE and inform the user.
if(!is_writable($upload_path))
	die('<META HTTP-EQUIV="Refresh" Content="0; URL=../?/profile/error/6">');
// Upload the file to your specified path.
if($public == "on") {

	if(move_uploaded_file($_FILES['file']['tmp_name'],$upload_path . base64_encode("public->1.".$filename))) {
	// It worked.
		header('Location: ../?/profile/files');

	} else {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../?/profile/error/4">'; // It failed :(.
	}
} else {
	if(move_uploaded_file($_FILES['file']['tmp_name'],$upload_path . base64_encode("public->0.".$filename))) {
	// It worked.
		header('Location: ../?/profile/files');

	} else {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../?/profile/error/4">'; // It failed :(.
	}
}

?>