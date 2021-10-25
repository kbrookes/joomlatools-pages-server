---
title: My awesome default title
@layout: template://pages/document.html
---

<title content="replace"><?= title() ?? $title ?></title>

<ktml:script src="https://js.chargebee.com/v2/chargebee.js" data-cb-site="undertheradarreport-test" />
<ktml:script src="theme://js/gauge.min.js" />
			
<ktml:style src="theme://css/styles.css?v=023" rel="preload" as="style" type="text/css" />

<body>
	<?= partial('nav') ?>
	<div class="container mx-auto">
		<ktml:content>
	</div>
</body>