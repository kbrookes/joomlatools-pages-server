---
@route: /stock-research/[*:slug]
@collection:
    extend: /stock-research
layout: /stock-research
---

<div class="grid grid-cols-3 gap-4 pt-9">
    <div class="col-span-2 content-main">
        <span><a href="<?= route(page('/stock-research/index')) ?>">< GO BACK</a></span>
        <h1 class="text-primary"><?= collection()->Name ?></h1>
        <div class="info">
            <p class="font-bold mb-1"><strong class="text-primary uppercase font-light">Sector:</strong> <?= collection()->Sector; ?></p>
            <p class="font-bold mb-5"><strong class="text-primary uppercase font-light">Industry:</strong> <?= collection()->Industry; ?></p>
        </div>
        <div class="content-overview">
            <? 
            $overview = collection()->Overview;
            if(is_array($overview)){
                $overview = collection()->Overview['content'];
                foreach($overview as $content){
                    $paras = $content['content'];
                    foreach($paras as $para){
                        echo '<p>' . $para['text'] . '</p>';
                    }
                }
            }
            ?>
        </div>
        <div class="content-recommendations bg-green-600 text-white p-6">
            <? 
            $recommendation = collection()->Recommendations;
            if(is_array($recommendation)){
                $recommendation = collection()->Recommendations['content'];
                foreach($recommendation as $content){
                    $paras = $content['content'];
                    foreach($paras as $para){
                        echo '<p>' . $para['text'] . '</p>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="content-sidebar bg-blue-50 p-6">
        <?
        $label_bg = 'bg-yellow-400';
        $gauge = 2500;
        $rating = collection('')->record->Company_Rating;
        $rating_label = strtolower($rating);
        switch ($rating_label){
            case 'sell':
                $label_bg = 'bg-red-600';
                $gauge = 500;
                break;
            case 'take profits':
                $label_bg = 'bg-yellow-600';
                $gauge = 1500;
                break;
            case 'spec buy':
                $label_bg = 'bg-green-400';
                $gauge = 3500;
                break;
            case 'buy':
                $label_bg = 'bg-green-600';
                $gauge = 4500;
                break;
            case 'hold':
                $label_bg = 'bg-yellow-400';
                $gauge = 2500;
                break;
        }
        ?>
        <div class="p-3 text-white uppercase <?= $label_bg . ' ' . $rating_label; ?> mb-2">
            RADAR RATING: <strong><?= collection()->record->Company_Rating; ?></strong>
        </div>
        <div class="p-3 text-white uppercase bg-primary mb-2">
            MARKET CAP ($M)* <?= collection()->record->Market_Cap; ?>
        </div>
        <div class="p-3 text-white uppercase bg-primary mb-2">
            DIVIDEND YIELD (%)* <?= collection()->record->Div_Yield; ?>
        </div>
        <div class="p-3 text-white uppercase bg-primary mb-2">
            NET CASH ($M) <?= collection()->record->Net_Cash_or_Debt_M; ?>
        </div>
        <!-- TradingView Widget BEGIN -->
            <div class="sidebar-tv-widget">
                <div class="tradingview-widget-container">
                  <div class="tradingview-widget-container__widget"></div>

                  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                  {
                  "symbol": "ASX:<?= collection()->Code; ?>",
                  "width": "100%",
                  "colorTheme": "light",
                  "isTransparent": false,
                  "locale": "en"
                }
                  </script>
                </div>
            </div>
            <!-- TradingView Widget END -->
        <div class="date-published text-dark py-3">
            <?  $date = collection()->published_at;
                //$result = $date->format('Y-m-d H:i:s'); ?>
            *Data as of <?= $date; ?>
        </div>
        <canvas id="rating-gauge"></canvas>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            let opts = {
                angle: 0, // The span of the gauge arc
                lineWidth: 0.44, // The line thickness
                radiusScale: 0.83, // Relative radius
                pointer: {
                    length: 0.6, // // Relative to gauge radius
                    strokeWidth: 0.035, // The thickness
                    color: '#000000' // Fill color
                },
                staticLabelsWithText: {
                    font: "13px arial", // Specifies font
                    labels: [
                        {label:"SELL",value:500},
                        {label:"TAKE PROFITS", value:1500},
                        {label:"HOLD",value:2500},
                        {label:"SPEC BUY",value:3500},
                        {label:"BUY",value:4500}
                    ],
                        color: "#0", // Optional: Label text color
                        fractionDigits: 0 // Optional: Numerical precision. 0=round off.
                    },
                staticZones: [
                   {strokeStyle: "#DC2626", min: 0, max: 999}, // Red from 100 to 130
                   {strokeStyle: "#D97705", min: 1000, max: 1999}, // Yellow
                   {strokeStyle: "#FABF24", min: 2000, max: 2999}, // Green
                   {strokeStyle: "#34D39A", min: 3000, max: 3999}, // Yellow
                   {strokeStyle: "#059669", min: 4000, max: 5000}  // Red
                ],
                limitMax: false, // If false, max value increases automatically if value > maxValue
                limitMin: false, // If true, the min value of the gauge will be fixed
                colorStart: '#6FADCF', // Colors
                colorStop: '#8FC0DA', // just experiment with them
                strokeColor: '#E0E0E0', // to see which ones work best for you
                generateGradient: true,
                highDpiSupport: true // High resolution support
            }
                
            let target = document.querySelector('#rating-gauge') // your canvas element
            
            let gaugeChart = new Gauge(target).setOptions(opts) // create sexy gauge!
            gaugeChart.maxValue = 5000 // set max gauge value
            gaugeChart.setMinValue(0) // Prefer setter over gauge.minValue = 0
            gaugeChart.animationSpeed = 32 // set animation speed (32 is default value)
            gaugeChart.set(<?= $gauge; ?>) // set actual value
        });
        </script>
    </div>
</div>