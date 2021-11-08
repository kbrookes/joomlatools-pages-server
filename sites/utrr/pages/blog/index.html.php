---
title: Stock Research
@route: /blog
@collection:
    model: ext:storyblok.model.blog
    state:
      sort: first_published_at
      order: desc
layout: /default
---
<h1>Blog</h1>
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-12">
<?  foreach(collection() as $item):?>
    <?= partial('blog-item', [
        'category' => $item->category,
        'title' => $item->title,
        'intro' => $item->intro,
        'image' => $item->image,
        'video' => $item->videoID,
    ]); ?>
 <? //var_dump($item);
 endforeach; ?>
</div>