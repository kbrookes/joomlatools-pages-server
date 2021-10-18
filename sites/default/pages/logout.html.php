---
title: Logout page
layout: /default
---



<?php
// load auth0 lib
require PAGES_SITE_ROOT.'/init.php';

$auth0->logout();
$return_to = getenv('public_url');
$logout_url = sprintf('https://%s/v2/logout?client_id=%s&returnTo=%s', getenv('AUTH0_DOMAIN'), getenv('AUTH0_CLIENT_ID'), $return_to);
unset($_SESSION['userRole']);
unset($_SESSION['isLoggedIn']);

header('Location: ' . $logout_url);
die();