---
title: Stock Research
@route: /stock-research
@collection:
    model: storyblok
    config:
        url: https://api.storyblok.com/v2/cdn/stories?filter_query[component][in]=StockOverview&starts_with=stock-research&token=qUIRVFhERHNhylrUuoPvBAtt&version=published
layout: /default
---
<h1>Storyblok Data</h1>
<?  foreach(collection() as $item):?>
 <h2><?= $item->Code; ?></h2>
 <? var_dump($item);
 endforeach; ?>