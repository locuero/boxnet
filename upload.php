<?php session_start();

include('lib/Box_Rest_Client.php');

$api_key = 'nf9ajg80mgwwjsnq7fzl4k0ism1yqtp0 ';
$box_net = new Box_Rest_Client($api_key);


if(!array_key_exists('auth',$_SESSION) || empty($_SESSION['auth'])) {
  $_SESSION['auth'] = $box_net->authenticate();
}
else {
	$box_net->auth_token = $_SESSION['auth'];
} 

if(array_key_exists('action',$_POST)) {
	if($_POST['action'] == 'create_folder') {
		$folder = new Box_Client_Folder();
		$folder->attr('folder', 'hola');
		$folder->attr('parent_id', false);
		$folder->attr('share', true);
		
		echo $box_net->create($folder);

	}
	else if($_POST['action'] == 'upload_file') {
		$file = new Box_Client_File($_FILES['file']['tmp_name'], $_FILES['file']['name']);
		$file->attr('folder_id', 0);
		echo $box_net->upload($file);

	}
}


var_dump($box_net->folder(0));
?>
