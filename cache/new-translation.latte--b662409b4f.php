<?php

use Latte\Runtime as LR;

/** source: new-translation.latte */
final class Template_b662409b4f extends Latte\Runtime\Template
{
	public const Source = 'new-translation.latte';

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
		echo '<div class="container-fluid pt-4" style="height: 100vh;">
	<div class="row">
		<div class="col">
			<div class="d-flex flex-row mb-2">
				<div class="btn-group w-100" role="group" aria-label="Button group">
					<button 
						hx-get="/kuku3/src/get_latest_news" 
						hx-target="#source"
						type="button" 
						class="btn btn-primary">
						1. Fetch latest yle news
					</button>
					<button onclick="splitSentences(\'source\')" type="button" class="btn btn-info">2. Format text</button>
					<button 
§						hx-post="/kuku3/src/translate" 
						hx-target="#translation"
						hx-include="#source"
						type="button" 
						class="btn btn-warning">
						3. Translate
					</button>
					<button type="button" class="btn btn-success">4. Save</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 pt-3">
			<textarea oninput="autoResize(this)" id="source" name="source" class="form-control" style="height: 650px;"></textarea>
		</div>
		<div class="col-md-6 pt-3">
			<textarea oninput="autoResize(this)" id="translation" name="translation" class="form-control" style="height: 650px;"></textarea>
		</div>
	</div>
</div>
';
	}
}
