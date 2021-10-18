<?php
session_start();

# CB key to validate the url that it is from the hook call
# Webhook to create new user in Auth0 on creating subscription in chargeBee
if(isset($_REQUEST['cbcreatekey']) && $_REQUEST['cbcreatekey']='whv2_AzyuDfSePjVHa1MNe') {
	define('KOOWA_ROOT'  , getenv('APP_ROOT'));
	
	// load auth0 lib
	require(PAGES_SITE_ROOT.'/init.php');

	$payload = @file_get_contents('php://input');
	$decArr = json_decode($payload, true);
	$customer=$decArr['content']['customer'];
	//echo 'CUSTOMER-> <pre>'; print_r($customer); echo '</pre>';
	
	/*
	# test directly by hitting this url: https://www.activebooking.com.au/?cbcreatekey=whv2_AzyuDfSePjVHa1MNe 
	$customer=array();
	$customer['id']="13gurmanpsingh";
	$customer['email']="gurmanpsingh@gmail.com";
	$customer['first_name']="Gurman";
	$customer['last_name']="P. Singh";
	*/
	
	$cb=new CBAuth0_API();

	# search user by E-mail
	$res=$cb->__searchUserBy($customer, "EMAIL");
	
	$decodedRes=json_decode($res, TRUE);

	# If user does not exist, create new user
	if($decodedRes['msg']==0){
		$res=$cb->__createUser($customer);
		echo 'USER CREATED-> <pre>'; print_r($res); echo '</pre>';
	}else{
		// update user with Role ID
		$roleRes=$cb->__setUserRole($decodedRes['user']['user_id']);
		$decodedRes=json_decode($roleRes, TRUE);

		if($decodedRes['status']=='success'){
			$userRole=$decodedRes['msg'];
			$_SESSION['userRole']=$userRole;
		}
		echo 'USER FOUND-> <pre>'; print_r($_SESSION); echo '</pre>';
	}

	header('HTTP/1.1 200 OK');
	return;
}else{
	define('KOOWA_ROOT'  , getenv('APP_ROOT'));
	define('KOOWA_VENDOR', getenv('APP_DATA').'/vendor');
	require KOOWA_VENDOR.'/joomlatools/pages/resources/pages/bootstrapper.php';
	
	/* # Email Test, if the email is sent 
	// load auth0 lib
	require(KOOWA_ROOT.'/pages/init.php');

	$cb=new CBAuth0_API();
	$res=$cb->__sendResetPasswordEmail("gurmanpsingh@royalscrown.com");
	echo $res; die;
	*/
}

?>