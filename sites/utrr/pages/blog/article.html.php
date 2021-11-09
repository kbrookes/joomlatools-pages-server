---
@route: /blog/[*:slug]
@collection:
    extend: /blog
layout: /default
---
<?

function ytThumbMax($videoID) {
    $url = 'https://i.ytimg.com/vi/' . $videoID . '/maxresdefault.jpg';
    return $url;
}

$thumb = null;
$video = collection()->videoID;
$image = collection()->image;
if(!empty($video)){
    $thumb = ytThumbMax($video);
} elseif(empty($video) && $image != 'none'){
    $thumb = $image;
} 

$published = date('Y-m-d',$date);



?>
<div class="grid grid-cols-3 gap-4 pt-9">
    <div class="col-span-2 content-main">
        <span><a href="<?= route(page('/blog/index')) ?>">< GO BACK</a></span>
        <h1 class="text-primary"><?= collection()->title ?></h1>
        <? if(!empty($thumb)){?>
            <img src="<?= $thumb; ?>" />
        <? } ?>
        <div class="content-overview">
            <?= collection()->long_text; ?>
        </div>
    </div>
    
</div>