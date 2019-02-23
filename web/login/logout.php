<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include
?>

<html>
	<head>

			<?php

			if($isUserLoggedIn === 1){

			    $not_token = $f->mk_key(40);
			    $time      = strtotime(date('Y-m-d H:i:s'));

			    $up = "DELETE FROM notification_temp WHERE uuid = '$user_uuid'";
			    $up = db::$link->query($up);


			    $set_token = "INSERT INTO notification_temp
			          (token,uuid,time) VALUES
			          ('$not_token','$user_uuid','$time')";
			    $set_token = db::$link->query($set_token);


			    //set offline status
			    $user_uuif = sha1(sha1($user_uuid));

			    $up = "UPDATE user_find_db SET online_status = 'offline' WHERE uuid = '$user_uuid'"; $up = db::$link->query($up);
			    $u->userinset('last_online_time',$time,$user_uuif);
			}


			//3. site vals
			$html_title = 'Logout | We-TeVe'; //Tap title
			require_once ('../include/head.php');

			session_destroy();
			setcookie("usercode","",time()-3600, "/");
			?>

	</head>

	<body>
	<script>
		docready();
		sethtmltitle('<?php echo $html_title; ?>');


		var backsite = '<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>';
		if(backsite != ""){
			var url = backsite; //one site back or start page
		}else{
			var url = "../index";
		}
			gotosite(url,'','1');


	</script>


	</body>
</html>
