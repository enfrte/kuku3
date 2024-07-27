<?php

use Latte\Runtime as LR;

/** source: templates/layout.latte */
final class Template_ff330703e8 extends Latte\Runtime\Template
{
	public const Source = 'templates/layout.latte';

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
	<script src="https://unpkg.com/htmx.org@2.0.1"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script src="/kuku3/src/assets/js/main.js"></script>
	<title>Kuku3</title>
	<style>
		body {

		}
		.menu-item:hover {
			background-color: rgb(0, 58, 105) !important;
		}
		.menu-item {
			cursor: pointer;
		}
	</style>
</head>
<body class="bg-light">

';
		$this->renderBlock('content', get_defined_vars()) /* line 25 */;
		echo '
</body>
</html>
';
	}


	/** {block content} on line 25 */
	public function blockContent(array $ʟ_args): void
	{
	}
}
