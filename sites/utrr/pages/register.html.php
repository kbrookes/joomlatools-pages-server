<?php
// load auth0 lib
require(PAGES_SITE_ROOT.'/init.php');

/*
{
  "email": "john111.doe@gmail.com",
  "phone_number": "+199999999999997",
  "user_metadata": {},
  "blocked": false,
  "email_verified": false,
  "phone_verified": false,
  "app_metadata": {},
  "given_name": "John",
  "family_name": "Doe",
  "name": "John Doe",
  "nickname": "Johnny",
  "picture": "https://secure.gravatar.com/avatar/15626c5e0c749cb912f9d1ad48dba440?s=480&r=pg&d=https%3A%2F%2Fssl.gstatic.com%2Fs2%2Fprofiles%2Fimages%2Fsilhouette80.png",
  "user_id": "abc",
  "connection": "Initial-Connection",
  "password": "secret",
  "verify_email": false,
  "username": "johndoe1111"
}
*/
try {
    $userinfo = $auth0->getUser();
    echo '<pre>'; print_r($userinfo); echo '</pre>';
} catch (Exception $e) {
    die( $e->getMessage() );
}
?>