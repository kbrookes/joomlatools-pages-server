---
title: Stock Research
@route: /blog
@collection:
    model: ext:storyblok.model.blog
    state:
      limit: 25
      sort: first_published_at
      order: desc
layout: /default
---
<?
function readTime($postContent){
    $word = str_word_count(strip_tags($postContent));
    $m = floor($word / 200);
    $s = floor($word % 200 / (200 / 60));
    $est = $m . ' minute' . ($m == 1 ? '' : 's') . ', ' . $s . 's';

    return $est;
}

?>
<h1>Blog</h1>
<div class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-12">
    <?  foreach(collection() as $item):
        $authorURL = $item->author['cached_url'];
        $authorSlug = preg_replace('/authors\/([a-z,\-]+)/', '$1', $authorURL);
        $author = collection('/authors', ['slug' => $authorSlug]);
        $authorImage = $author->image['filename'];
        ?>
        <div class="overflow-hidden shadow-lg rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
            <a href="<?= route(page('/blog/article'), ['slug' => $item->slug]); ?>" class="w-full block h-full">
            <?= partial('blog-item', [
                'category' => $item->category,
                'title' => $item->title,
                'intro' => $item->intro,
                'image' => $item->image,
                'video' => $item->videoID,
                'author' => $item->author,
                'date' => $item->first_published_at,
                'content' => $item->long_text,
                'author' => $author->name,
                'authorImage' => $authorImage,
            ]); ?>
            </a>
        </div>
    <? endforeach; ?>
    </div>
    <?= helper('paginator.pagination') ?>

</div>