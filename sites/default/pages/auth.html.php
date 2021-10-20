---
title: Testing persistence of logged in status
layout: /default
---

<?php

// load auth0 lib
require PAGES_SITE_ROOT.'/init.php';

// Handle errors sent back by Auth0.
if ((isset($_GET['error']) && !empty($_GET['error'])) || (isset($_GET['error_description']) && !empty($_GET['error_description']))) {
    printf( '<h1>Error2</h1><p>%s</p>', htmlspecialchars( $_GET['error'] ) );
    die();
}

// If there is a user persisted (PHP session by default), return that.
// Otherwise, look for a "state" and "code" URL parameter to validate and exchange.
// If the state validation and code exchange are successful, return `userinfo`.
try {
    $userInfo = $auth0->getUser();

    $cb=new CBAuth0_API();
    $res=$cb->__searchUserBy($userInfo, 'ROLE');
    $decodedRes=json_decode($res, true);

    if($decodedRes['status']=='success'){
        $userRole=$decodedRes['msg'];
        $_SESSION['isLoggedIn']=TRUE;
        $_SESSION['auth0__user']['userRole']=$userRole;
    }

} catch (Exception $e) {
    die( 'Error: '.$e->getMessage() );
}

// No user information so redirect to the Universal Login Page.
if (empty($userInfo)) {
    $auth0->login();
}

// We either have a persisted user or a successful code exchange.
header('Location: '.getenv('AUTH0_REDIRECT_URI').'/public');
die();

// This is where a user record in a local database could be retrieved or created.
// End with a redirect to a new page.