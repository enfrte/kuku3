<?php

use Latte\Runtime as LR;

/** source: home.latte */
final class Template_51aa01afaf extends Latte\Runtime\Template
{
	public const Source = 'home.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		echo "\n";
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		$this->parentName = 'layout.latte';
		return get_defined_vars();
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		echo '<div class="d-flex flex-column justify-content-center align-items-center bg-dark" style="height: 100vh;">
	<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 5 */;
		echo '/translation" class="text-white text-decoration-none" style="min-width: 100%;">
		<div class="p-3 menu-item bg-dark" style="min-width: 100%;">
			<div class="card-body">
				<h5 class="card-title mb-0 text-center text-white">NEW TRANSLATION</h5>
			</div>
		</div>
	</a>
	<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 12 */;
		echo '/practice" class="text-white text-decoration-none" style="min-width: 100%;">
		<div class="p-3 menu-item bg-dark" style="min-width: 100%;">
			<div class="card-body">
				<h5 class="card-title mb-0 text-center text-white">PRACTICE</h5>
			</div>
		</div>
	</a>
	<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 19 */;
		echo '/logout" class="text-white text-decoration-none" style="min-width: 100%;">
		<div class="p-3 menu-item bg-dark" style="min-width: 100%;">
			<div class="card-body">
				<h5 class="card-title mb-0 text-center text-white">LOG OUT</h5>
			</div>
		</div>
	</a>
</div>
';
	}
}
