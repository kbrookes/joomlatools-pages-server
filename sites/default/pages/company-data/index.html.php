---
@route: /company-data
@collection:
    model: airtable
    config:
        url: https://api.airtable.com/v0/appxFHbo5P6cryBsh/Table%201
        api_key: keyvuFe20ZrHxoipH
---

<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />

<?  foreach(collection() as $item): ?>
<? var_dump($item) ?>
<? endforeach; ?>
