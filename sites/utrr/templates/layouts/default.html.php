---
title: My awesome default title
@layout: template://pages/document.html
---

<title content="replace"><?= title() ?? $title ?></title>

<ktml:script src="https://js.chargebee.com/v2/chargebee.js" data-cb-site="undertheradarreport-test" />
<ktml:style src="theme://css/styles.css?v=024" rel="preload" as="style" type="text/css" />

<body>
    <?= partial('nav') ?>
	<!--<?= partial('hero') ?>-->
	<div class="container mx-auto">
		<ktml:content>
	</div>
</body>