<!DOCTYPE html>
<html xmlns:og="http://opengraphprotocol.org/schema/" lang="<?= language() ?>" dir="<?= direction() ?>" vocab="http://schema.org/">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8"/>
		<meta name="robots" content="noindex">
		<base href="<?= url() ?>" />
	
		<ktml:title>
		<ktml:meta>
		<ktml:link>
		
		<script src="https://js.chargebee.com/v2/chargebee.js" data-cb-site="undertheradarreport-test" ></script>
		
		<ktml:style>
		<ktml:style src="theme://css/styles.css?v=023" rel="preload" as="style" type="text/css" />
	
		<ktml:script>
		<? $title = page()->layout->title; ?>
		<title><?= $title; ?></title>
		
	</head>
	<body>
		<?= partial('nav') ?>
		<?= partial('hero') ?>
		<div class="container mx-auto">
			<ktml:content>
		</div>
	</body>
</html>