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
		echo '<div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
	<a href="/kuku3/src/translation" style="min-width: 100%; text-decoration: none;">
		<div class="menu-item text-white bg-dark" style="min-width: 100%;">
			<div class="card-body">
				<h5 class="card-title mb-0 text-center">NEW TRANSLATION</h5>
			</div>
		</div>
	</a>
	<a href="/kuku3/src/logout" style="min-width: 100%; text-decoration: none;">
		<div onclick="/kuku3/src/logout" class="menu-item text-white bg-dark">
			<div class="card-body">
				<h5 class="card-title mb-0 text-center">LOG OUT</h5>
			</div>
		</div>
	</a>
</div>
';
	}
}
