---
title: HOW TO INVEST IN ASX SMALL CAPS. THE TOP PERFORMING STOCKS OF TOMORROW
layout: /default
---

<?php
// load auth0 lib
require PAGES_SITE_ROOT.'/init.php';
$userInfo = $auth0->getUser();
?>

<h2>Landing Page</h2>
<?= getenv('AUTH0_REDIRECT_URI'); ?>
<?php if(!$_SESSION['isLoggedIn']) : ?>
<p>You are not currently logged in.</p>
<p><a class="btn btn-primary text-white hover:text-white" href="/login">login</a> or 
<a class="btn btn-primary text-white" href="javascript:void(0)" data-cb-type="checkout" data-cb-item-0="Small-Caps-REport-USD-Monthly" data-cb-item-0-quantity="1" >subscribe</a> to see private page.</p>
<p><a href="/public" class="btn btn-primary">VISIT PUBLIC PAGE</a></p>
<?php else: ?>
<h2>Welcome <span class="nickname"><?php echo $userInfo['nickname'] ?></span></h2>
<p><a href="/public">Link to private page</a></p>
<p><a class="btn btn-secondary text-white" href="/logout">Logout</a></p>
<h3>Customer portal</h3>
<p>You can manage your account via the customer portal</p>
<a class="btn btn-secondary text-white hover:text-white" href="javascript:void(0)" data-cb-type="portal" >Manage account</a>
<? endif; ?>
<? var_dump(PAGES_SITE_ROOT); ?>