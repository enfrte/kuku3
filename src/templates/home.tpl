{*include file="header.tpl"*}

<div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
	<div hx-get="/kuku3/src/translation" hx-target="body" class="menu-item text-white bg-dark" style="min-width: 100%;">
		<div class="card-body">
			<h5 class="card-title mb-0 text-center">NEW TRANSLATION</h5>
		</div>
	</div>
	<a href="/kuku3/src/logout" style="min-width: 100%; text-decoration: none;">
		<div onclick="/kuku3/src/logout" class="menu-item text-white bg-dark">
			<div class="card-body">
				<h5 class="card-title mb-0 text-center">LOG OUT</h5>
			</div>
		</div>
	</a>
</div>

{*include file="footer.tpl"*}
