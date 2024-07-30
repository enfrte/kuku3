<?php

use Latte\Runtime as LR;

/** source: practice-info.latte */
final class Template_8a335537b1 extends Latte\Runtime\Template
{
	public const Source = 'practice-info.latte';

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
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
	<div class="text-center">
		<h2>Practice</h2>
';
		if (!empty($title)) /* line 8 */ {
			echo '			<a href="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 9 */;
			echo '/practice" class="btn btn-primary btn-lg btn-block mt-3">
				';
			echo LR\Filters::escapeHtmlText($title) /* line 10 */;
			echo '
			</a>
';
		} else /* line 12 */ {
			echo '			<p class="lead">Could not fetch practice.</p>
';
		}
		echo '	</div>
</div>

';
	}
}
