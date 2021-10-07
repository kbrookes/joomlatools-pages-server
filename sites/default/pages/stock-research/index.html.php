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
<script type="module">
    import {
        Grid,
        html
    } from "https://unpkg.com/gridjs?module";
</script>
<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
<div class="bg-white shadow-md rounded my-6">
    <table class="table-fixed">
        <thead>
            <tr class="bg-primary text-white uppercase text-sm text-left">
                <th class="px-2 py-3">Company</th>
                <th class="px-2 py-3">Code</th>
                <th class="px-2 py-3">Sector</th>
                <th class="px-2 py-3">Market Cap</th>
                <th class="px-2 py-3">Current Price</th>
                <th class="px-2 py-3">Div Yield</th>
                <th class="px-2 py-3">Rating</th>
                <th class="px-2 py-3 w-1/2">Comment</th>
            </tr>
        </thead>
        <tbody>
        <? 
        $i = 0;
        foreach(collection() as $article): 
            $i++;
            $label_bg = 'bg-yellow-400';
            $rating = $article->content['Company_Rating'];
            switch ($rating){
                case 'Sell':
                    $label_bg = 'bg-red-600';
                    break;
                case 'Take profits':
                    $label_bg = 'bg-yellow-600';
                    break;
                case 'Spec Buy':
                    $label_bg = 'bg-green-400';
                    break;
                case 'Buy':
                    $label_bg = 'bg-green-600';
                    break;
                case 'Hold':
                    $label_bg = 'bg-yellow-400';
                    break;
            }
            
        ?>
            <tr class="border-b border-gray-200 <?= $i%2 ? '' : 'bg-gray-50'; ?> hover:bg-gray-100 text-sm">
                <td class="px-2 py-1 font-bold whitespace-nowrap "><a href="<?= route(page('/stock-research/article'), ['slug' => $article->slug]) ?>"><?= $article->content['Name'] ?></a></td>
                <td class="px-2 py-1 font-bold"><?= $article->content['Code'] ?></td>
                <td class="px-2 py-1"><?= $article->content['Sector']; ?></td>
                <td class="px-2 py-1"><?= $article->content['Market_Cap']; ?></td>
                <td class="px-2 py-1"><?= $article->content['Current_Price']; ?></td>
                <td class="px-2 py-1"><?= $article->content['Div_Yield']; ?></td>
                <td class="px-2 py-1 uppercase"><span class="whitespace-nowrap text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white <?= $label_bg . ' ' . $rating; ?> uppercase last:mr-0 mr-1"><?= $rating; ?></span></td>
                <td class="px-2 py-1"><? 
                $recommendation = $article->content['Recommendations'];
                if(is_array($recommendation)){
                    $recommendation = $article->content['Recommendations']['content'];
                    foreach($recommendation as $content){
                        $paras = $content['content'];
                        foreach($paras as $para){
                            echo '<p>' . $para['text'] . '</p>';
                        }
                    }
                }
                ?></td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>