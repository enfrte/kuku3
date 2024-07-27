<?php

use Latte\Runtime as LR;

/** source: access.latte */
final class Template_17c0f92422 extends Latte\Runtime\Template
{
	public const Source = 'access.latte';

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
		echo '<div class="container mt-5">
	<h2 class="mb-5">What\'s the frequency, Kenneth?</h2>
	<form hx-post="/kuku3/src/" hx-target="body" hx-trigger="submit" class="row g-3">
		<div class="col-auto">
			<input name="password" type="password" class="form-control" placeholder="Frequency">
		</div>
	</form>
</div>
';
	}
}
