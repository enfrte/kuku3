<?php

use Latte\Runtime as LR;

/** source: practice.latte */
final class Template_e823e65804 extends Latte\Runtime\Template
{
	public const Source = 'practice.latte';

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

		echo '<script>
	// let questions = JSON.parse(';
		echo LR\Filters::escapeJs($questions) /* line 5 */;
		echo '); 
	// console.log(questions);
</script>
<div class="container bg-light" style="height: 100vh;" x-data=\'{ questions: ';
		echo LR\Filters::escapeHtmlAttr($questions) /* line 8 */;
		echo ' }\'>
	<div x-data="getLatestPracticeData()" class="pt-2">

		<div class="progress-container pt-3 d-flex align-items-center justify-content-between">
			<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 12 */;
		echo '/practiceInfo" class="text-dark text-decoration-none">
				<div 
					class="btn btn-lg pt-1 pb-1 ps-0 me-2" 
					type="button">
					<span class="bi bi-x-lg"></span>
				</div>
			</a>

			<div class="progress-bar-container d-block w-100">
				<div class="progress">
					<div 
						class="progress-bar bg-lightgreen" 
						role="progressbar" 
						:style="\'width:\'+progressPercent+\'%;\'" 
						:aria-valuenow="progressPercent" 
						aria-valuemin="0" 
						aria-valuemax="100">
					</div>
				</div>
			</div>
		</div>

		<div class="border border-secondary border-2 rounded-3 text-dark p-4 mt-4 pb-1">
			<p x-text="questions[questionNumber][\'native_phrase\']"></p>
		</div>

		<hr>

		<div class="answer-container">
			<template x-for="(answer, index) in answerArray" :key="answer.id">
				<button 
					class="btn btn-sm btn-outline-secondary rounded-4 border-2 text-dark m-1 pt-2 pb-2" 
					x-text="answer.word" 
					x-on:click="removeFromAnswer(index, answer.id)">
				</button>
			</template>
		</div>

		<hr class="mb-4">

		<div class="choice-container d-flex flex-wrap justify-content-center mb-1">
			<template x-for="(choice, index) in choiceArray" :key="choice.id">
				<div 
					class="btn-placeholder" 
					style="max-width:max-content;">
					<button 
						type="button"
						class="btn btn-sm btn-outline-secondary rounded-4 border-2 text-dark bg-light pt-2 pb-2" 
						x-text="choice.word" 
						x-bind:class="{\'hidden\': choice.hidden}"
						x-on:click="addToAnswer(choice, choice.id)">
					</button>
				</div>
			</template>
		</div>

		<div class="d-grid">
			<button 
				:disabled="answerArray.length < 1" 
				class="btn btn-lg bt-100 btn-success bg-lightgreen rounded-4 text-black fw-bold mt-3" 
				x-on:click="checkAnswer()">
				CHECK
			</button>
		</div>	

		<div 
			x-show="nextQuestionModal" 
			class="container fixed-bottom" 
			:class="{ \'bg-success\': result === \'Correct\', \'bg-danger\': result === \'Incorrect\' }"
			style="height: 200px;">
			<div class="container h-100">
				<div class="row h-100 align-items-end justify-content-center">
					<h3 x-text="result" class="text-light"></h3>
					<p x-text="resultMessage" class="text-light"></p>
					<button 
						class="btn btn-light btn-lg btn-block fw-bold mt-auto mb-4"
						x-on:click="nextQuestion">
						CONTINUE
					</button>
				</div>
			</div>
		</div>

		<div 
			x-show="exit" 
			class="container fixed-bottom bg-grey" 
			style="height: 200px;">
			<div class="container h-100">
				<div class="row h-100 align-items-end justify-content-center">
					<h3 class="text-light">Practice complete</h3>
					<p class="text-light">Return to the practice index. Check back tomorrow for updated practices.</p>
					<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl(Flight::get('basePath'))) /* line 103 */;
		echo '/practiceInfo" 
						class="btn btn-primary btn-lg btn-block fw-bold mt-auto mb-4" 
						role="button">
						EXIT
					</a>
				</div>
			</div>
		</div>
		
	</div>
</div>

';
	}
}
