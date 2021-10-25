---
title: Company Data
@route: /company-data
@collection:
    model: ext:airtable.model.records
    state:
        sort: Name
        order: asc
        limit: 300
layout: /default
metadata:
    robots: noindex, nofollow
---



<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />

<div id="wrapper"></div>

<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js" defer></script>
<script data-inine="true" defer="true" >
document.addEventListener("DOMContentLoaded", function() {
    const { Grid, html, h } = gridjs;
    new gridjs.Grid({
          columns: [
              { name: 'Company',
                formatter: (_, row) => html(`<a href="/stock-research/${row.cells[0].data.replace(/\s+/g, '-').toLowerCase()}" class="font-bold text-primary">${row.cells[0].data}</a>`) },
              { name: 'Code',
                formatter: (cell) => html(`<strong>${cell}</strong>`) },
              { name: 'Sector' }, 
              { name: 'Market Cap' },
              { name: 'Div Yield' },
              { name: 'Rating',
                formatter: (_, row) => html(`<span class='whitespace-nowrap text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white uppercase ${row.cells[5].data.replace(/\s+/g, '-').toLowerCase()}'>${row.cells[5].data}</span>`)
              },
              { name: 'Net Cash/Debt $m',
                formatter: (cell) => {
                    return h('b', { style: {
                      'color': cell > 0 ? 'green' : 'red'
                    }}, cell);
                  }
              },
          ],
          search: true,
          sort: true,
          data: [
            <?  foreach(collection() as $item):
                $rating = $item->Company_Rating;
                $netCash = $item->Net_Cash_or_Debt_M;
            ?>
            ["<?= $item->Name; ?>", "<?= $item->Code; ?>", "<?= $item->Sector; ?>", "<?=  $item->Market_Cap; ?>", "<?= $item->Div_Yield; ?>", "<?= $rating; ?>", "<?= $netCash; ?>",],
            <? endforeach; ?>
          ],
          className: {
              thead: 'bg-primary text-white uppercase text-sm text-left',
              th: 'px-2 py-3 text-sm text-left',
              td: 'px-2 py-1 text-sm',
              table: 'w-full'
            },
            style: {
                th: {
                    'background-color': 'rgba(0, 143, 210, var(--tw-bg-opacity))',
                    color: '#fff',
                    'text-align': 'left'
                },
            },
            pagination: {
                enabled: true,
                limit: 15,
                summary: true
            }
        }).render(document.getElementById("wrapper"));
    });
</script>

<? foreach(collection() as $item):
var_dump($item->record);
endforeach ;?>