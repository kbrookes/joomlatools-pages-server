---
title: Stock Research
@route: /stock-research
@collection:
    model: ext:storyblok.model.companies
    state:
      sort: title
      order: asc
layout: /default
---
<h1>Storyblok Data</h1>
<?  foreach(collection() as $item):?>
 <h2><a href="<?= route(page('stock-research/article'), ['slug' => $item->slug]); ?>"><?= $item->title; ?></a></h2>
 
 <? endforeach; ?>