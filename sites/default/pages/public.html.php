---
title: Public Page
layout: /default
---

<?php
// load auth0 lib
require PAGES_SITE_ROOT.'/init.php';
# echo 'here <pre>'; print_r($_SESSION); echo '</pre>';
# echo 'here <pre>'; print_r($userInfo); echo '</pre>';

$userInfo = $auth0->getUser();
if(isset($userInfo['given_name']) && $userInfo['given_name']!==''){
    $nameOfUser=$userInfo['given_name'];
}else if(isset($userInfo['name']) && $userInfo['name']!==''){
    $nameOfUser=$userInfo['name'];
}else if(isset($userInfo['nickname']) && $userInfo['nickname']!==''){
    $nameOfUser=$userInfo['nickname'];
}else{$nameOfUser="Authenticated User";}

$blurClass = '';
$privColor = '';
if (!$_SESSION['isLoggedIn']) {
    $blurClass = 'filter blur-sm';
    $privColor = 'text-primary';
} else {
    $blurClass = '';
    $privColor = 'text-green-600';
}

?>  

<H1><?= page()->title; ?></H1>
<p>Welcome to the Public page.</p>

<p><a href="/">Go Back</a></p>

<?php
if(!$_SESSION['isLoggedIn']) {
    echo '<h4>You are not authorized to access the Private page.</h4>';
    echo '<p>Please <a href="/login">Log In</a> to the application to get private page.</p>';
} else {
    echo '<h4>'.$nameOfUser.', you are logged in user.<h4>';
    echo '<p>You can see <a href="/test">Private Blog</a></p>';
    echo '<p><a class="btn btn-primary" href="/logout">Logout</a></p>';
 }
?>

<table class="border border-collapse border-gray-100 table-auto">
    <thead>
        <tr class="bg-primary text-white">
            <th class="p-2">Code</th>
            <th class="p-2">Company</th>
            <th class="p-2">Price</th>
            <th class="p-2">Radar Rating</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border border-gray-100 p-2">ART</td>
            <td class="border border-gray-100 p-2">Airtasker</td>
            <td class="border border-gray-100 p-2 <?= $blurClass; ?>"><? obfuscate('0.985');?></td>
            <td class="border border-gray-100 font-bold p-2 <?= $blurClass . ' ' . $privColor; ?>"><? obfuscate('SPEC BUY'); ?></td>
        </tr>
        <tr class="bg-emerald-200">
            <td class="border border-gray-100 p-2">DTC</td>
            <td class="border border-gray-100 p-2">DAMSTRA</td>
            <td class="border border-gray-100 p-2 <?= $blurClass; ?>"><? $price = '0.88'; $price = obfuscate($price); echo $price?></td>
            <td class="border border-gray-100 text-green-600 font-bold p-2 <?= $blurClass . ' ' . $privColor; ?>"><? obfuscate('SPEC BUY'); ?></td>
        </tr>
        <tr>
            <td class="border border-gray-100 p-2">GNG</td>
            <td class="border border-gray-100 p-2">GR Engineering</td>
            <td class="border border-gray-100 p-2 <?= $blurClass; ?>"><? obfuscate('1.81'); ?></td>
            <td class="border border-gray-100 text-green-600 font-bold p-2 <?= $blurClass . ' ' . $privColor; ?>"><? obfuscate('SPEC BUY'); ?></td>
        </tr>
        <tr>
            <td class="border border-gray-100 p-2">KAR</td>
            <td class="border border-gray-100 p-2">Karoon Energy</td>
            <td class="border border-gray-100 p-2 <?= $blurClass; ?>"><? obfuscate('1.36'); ?></td>
            <td class="border border-gray-100 text-green-600 font-bold p-2 <?= $blurClass . ' ' . $privColor; ?>"><? obfuscate('SPEC BUY'); ?></td>
        </tr>
        <tr>
            <td class="border border-gray-100 p-2">KLL</td>
            <td class="border border-gray-100 p-2">Kalium Lakes</td>
            <td class="border border-gray-100 p-2 <?= $blurClass; ?>"><? obfuscate('0.195'); ?></td>
            <td class="border border-gray-100 text-green-600 font-bold p-2 <?= $blurClass . ' ' . $privColor; ?>"><? obfuscate('SPEC BUY'); ?></td>
        </tr>
        <tr>
            <td class="border border-gray-100 p-2">PGC</td>
            <td class="border border-gray-100 p-2">Paragon Care</td>
            <td class="border border-gray-100 p-2 <?= $blurClass; ?>"><? obfuscate('0.34'); ?></td>
            <td class="border border-gray-100 text-green-600 font-bold p-2 <?= $blurClass . ' ' . $privColor; ?>"><? obfuscate('SPEC BUY'); ?></td>
        </tr>
        <tr>
            <td class="border border-gray-100 p-2">PPE</td>
            <td class="border border-gray-100 p-2">People Infrastructure</td>
            <td class="border border-gray-100 p-2 <?= $blurClass; ?>"><? obfuscate('3.91'); ?></td>
            <td class="border border-gray-100 text-green-600 font-bold p-2 <?= $blurClass . ' ' . $privColor; ?>"><? obfuscate('SPEC BUY'); ?></td>
        </tr>
    </tbody>
</table>

<?

function obfuscate($string, $replaceWith = 'x') {

$chars = preg_quote('#/\!?@%^&*()_+=[]{}~"“”‘’\'`~<>,.|;:…—–-', '/');

// u at the end is for unicode so it is multibyte safe
// \s space, tab, newline, carriage return, vertical tab
if (!$_SESSION['isLoggedIn']) {
    $string = preg_replace('/[^' . $chars . '\s]/u', $replaceWith, $string);
    echo $string;
} else {
    echo $string;
}

} 

?>