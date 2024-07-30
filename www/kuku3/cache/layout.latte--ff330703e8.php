<?php

use Latte\Runtime as LR;

/** source: layout.latte */
final class Template_ff330703e8 extends Latte\Runtime\Template
{
	public const Source = 'layout.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 8 */;
		echo '/assets/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<style>
		.menu-item:hover {
			background-color: rgb(0, 58, 105) !important;
		}
	</style>
	<!-- JS 3rd party -->
	<script src="https://unpkg.com/htmx.org@2.0.1"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<!-- JS custom -->
	<script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 21 */;
		echo '/assets/js/main.js"></script>
	<script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 22 */;
		echo '/assets/js/kuku3.js"></script>
	
	<title>Kuku3</title>
</head>
<body class="bg-light">
';
		if (!empty($flash_msg)) /* line 27 */ {
			echo LR\Filters::escapeHtmlText($flash_msg) /* line 27 */;
		}
		echo '

';
		$this->renderBlock('content', get_defined_vars()) /* line 29 */;
		echo '
</body>
</html>
';
	}


	/** {block content} on line 29 */
	public function blockContent(array $ʟ_args): void
	{
	}
}
