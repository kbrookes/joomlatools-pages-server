---
@route: /stock-research/[*:slug]/reports
@collection:
    model: ext:storyblok.model.reports
    state:
        sort: first_published_at
        order: desc
        query:
            data:
                is_startpage: 0
              
layout: /stock-research
---
<? foreach(collection(['starts_with' => 'stock-research/' . $item->slug]) as $item):?>
<h2><?= $item->title; ?></h2>
<? endforeach; ?>