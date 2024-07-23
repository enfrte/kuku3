<div class="container mt-5">
	<h1>{if !empty($name)} Hello {$name} {else} Hello you {/if}</h1>

	<div id="foo" hx-target="#foo" hx-trigger="" hx-get="">
		<h1>Loading...</h1>
	</div>
</div>