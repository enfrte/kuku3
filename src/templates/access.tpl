{include file="header.tpl"}

<div class="container mt-5">
	<h2 class="mb-5">What's the frequency, Kenneth?</h2>
	<form hx-post="/kuku3/src/" hx-target="body" hx-trigger="submit" class="row g-3">
		<div class="col-auto">
			<input name="password" type="password" class="form-control" placeholder="Frequency">
		</div>
	</form>
</div>


{include file="footer.tpl"}
