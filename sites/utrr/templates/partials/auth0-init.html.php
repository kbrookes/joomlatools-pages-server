<?php
session_start();
// load libraries and declare the auth0 obj 
require KOOWA_ROOT.'/vendor/autoload.php';
use josegonzalez\Dotenv\Loader;
use Auth0\SDK\Auth0;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\ApiException;

$Dotenv = new Loader(KOOWA_ROOT.'/config/.env');
$Dotenv->parse()->putenv(true);

$auth0 = new Auth0([
  'domain' => getenv('AUTH0_DOMAIN'),
  'client_id' => getenv('AUTH0_CLIENT_ID'),
  'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
  'redirect_uri' => getenv('AUTH0_REDIRECT_URI').'/auth',
  'scope' => 'openid profile email users',
]);

?>