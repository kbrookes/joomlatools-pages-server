---
title: Stock Research
@route: /stock-research
@collection:
    model: ext:storyblok.model.companies
layout: /default
---
<h1>Storyblok Data</h1>
<?  foreach(collection() as $item):?>
 <h2><?= $item->Code; ?></h2>
 <? var_dump($item); 
 endforeach; ?>