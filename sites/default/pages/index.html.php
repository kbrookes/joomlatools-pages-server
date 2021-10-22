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

<p>You can also look at an example of a fairly simple collection, using <a class="font-bold text-primary" href="/stock-research">Storyblok data</a>, or a more <a class="font-bold text-primary" href="/company-data">complex version using Airtable data</a></p>