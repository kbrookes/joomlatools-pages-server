---
@route: /reports
@collection:
    model: ext:storyblok.model.reports
    state:
        sort: first_published_at
        order: desc
layout: /stock-research
---
<? foreach(collection() as $item):?>
<h2><?= $item->title; ?></h2>
<? endforeach; ?>