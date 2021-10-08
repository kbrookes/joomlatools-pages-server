---
title: Stock Research
@route: /stock-research
@collection:
    model: webservice
    config:
        url: https://api.storyblok.com/v2/cdn/stories?filter_query[component][in]=StockOverview&starts_with=stock-research&token=qUIRVFhERHNhylrUuoPvBAtt&version=published
        data_path: stories
        identity_key: slug
layout: /default
---
<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />

<div id="wrapper"></div>

<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js" defer></script>
<script data-inine="true" defer="true" >
document.addEventListener("DOMContentLoaded", function() {
    const { Grid, html } = gridjs;
    new gridjs.Grid({
          columns: [
              { name: 'Company',
                formatter: (_, row) => html(`<a href="/stock-research/${row.cells[0].data.replace(/\s+/g, '-').toLowerCase()}" class="font-bold text-primary">${row.cells[0].data}</a>`) },
              { name: 'Code',
                formatter: (cell) => html(`<strong>${cell}</strong>`) },
              { name: 'Sector' }, 
              { name: 'Market Cap' },
              { name: 'Current Price' },
              { name: 'Div Yield' },
              { name: 'Rating',
                formatter: (_, row) => html(`<span class='whitespace-nowrap text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white uppercase ${row.cells[6].data.replace(/\s+/g, '-').toLowerCase()}'>${row.cells[6].data}</span>`)
              },
              { name: 'Comment' },
          ],
          search: true,
          sort: true,
          data: [
            <? foreach(collection() as $article): 
                $rating = $article->content['Company_Rating'];
            ?>
            ["<?= $article->content['Name'] ?>", "<?= $article->content['Code'] ?>", "<?= $article->content['Sector']; ?>", "<?= $article->content['Market_Cap']; ?>", "<?= $article->content['Current_Price']; ?>", "<?= $article->content['Div_Yield']; ?>", "<?= $rating; ?>", "<? 
            $recommendation = $article->content['Recommendations'];
            if(is_array($recommendation)){
                $recommendation = $article->content['Recommendations']['content'];
                foreach($recommendation as $content){
                    $paras = $content['content'];
                    foreach($paras as $para){
                        echo $para['text'];
                    }
                }
            }
            ?>"],
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
        }).render(document.getElementById("wrapper"));
    });
</script>