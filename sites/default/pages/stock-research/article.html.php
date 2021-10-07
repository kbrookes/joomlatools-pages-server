---
@route: /stock-research/[*:slug]
@collection:
    extend: /stock-research
layout: /default
---

<h1><?= collection()->content['Name'] ?></h1>