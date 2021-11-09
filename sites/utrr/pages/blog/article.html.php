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
        <? if(!empty($video)){
            echo '<div class="video aspect-w-16 aspect-h-9" data-id="' . $video . '"></div>';
        } elseif(!empty($thumb)){?>
            <img src="<?= $thumb; ?>" />
        <? } ?>
        <div class="content-overview">
            <?= collection()->long_text; ?>
        </div>
    </div>
    
</div>

<script>
    document.addEventListener("DOMContentLoaded",
    function() {
        var a, n,
            v = document.getElementsByClassName("video");
        for (n = 0; n < v.length; n++) {
            a = document.createElement("div");
            a.setAttribute("data-id", v[n].dataset.id);
            a.innerHTML = videoThumb(v[n].dataset.id);
            a.onclick = videoIframe;
            v[n].appendChild(a);
        }
    });
    
    function videoThumb(id) {
        var thumb = '<img src="https://i.ytimg.com/vi/ID/maxresdefault.jpg">',
            playBtn = '<span></span>';
        return thumb.replace("ID", id) + playBtn;
    }
    
    function videoIframe() {
        var iframe = document.createElement("iframe");
        iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.id + "?autoplay=1");
        iframe.setAttribute("allowfullscreen", "1");
        iframe.setAttribute("frameborder", "0");
        this.parentNode.replaceChild(iframe, this);
    }
    
</script>