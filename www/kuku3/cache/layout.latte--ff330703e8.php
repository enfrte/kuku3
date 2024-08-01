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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<!-- JS custom -->
	<script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 20 */;
		echo '/assets/js/main.js"></script>
	<script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 21 */;
		echo '/assets/js/kuku3.js"></script>
	
	<title>Kuku3</title>
</head>
<body class="bg-dark">

<div id="flash-msg">
	<div class="toast-container position-fixed bottom-0 end-0 p-3">
		<div id="toast" class="toast align-items-center text-bg-default" role="alert">
			<div class="d-flex">
				<div class="toast-body"></div>
				<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
	</div>	
</div>

';
		$this->renderBlock('content', get_defined_vars()) /* line 38 */;
		echo '

<script>
document.addEventListener(\'htmx:responseError\', event => {
	const toastEl = document.getElementById(\'toast\');
	toastEl.querySelector(\'.toast-body\').textContent = event.detail.xhr.responseText;
	const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
	toast.show();
});
	// toastEl = document.getElementById(\'toast\');
	// toast = new bootstrap.Toast(toastEl, { delay: 3000 });
	// toast.show();


	// document.body.addEventListener(\'htmx:afterSwap\', (event) => {
	// 	console.log(\'swapped\', event.detail.target);
	// 	if (event.detail.target.id === \'flash-msg\') { // The element that was the hx-swap target
	// 		var toastEl = document.getElementById(\'#toast\');
	// 		var toast = new bootstrap.Toast(toastEl);
	// 		toast.show();
	// 	}
	// });
</script>

</body>
</html>
';
	}


	/** {block content} on line 38 */
	public function blockContent(array $ʟ_args): void
	{
	}
}
