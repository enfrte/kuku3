<div class="container-fluid pt-5" style="height: 100vh;">
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
					<button onclick="splitSentences('source')" type="button" class="btn btn-info">2. Format text</button>
					<button 
						hx-get="/kuku3/src/translate" 
						hx-target="#source"
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
		<div class="col-md-6">
			<textarea oninput="autoResize(this)" id="source" class="form-control" style="height: 650px;"></textarea>
		</div>
		<div class="col-md-6">
			<textarea oninput="autoResize(this)" id="translation" class="form-control" style="height: 650px;"></textarea>
		</div>
	</div>
</div>

<script src="/kuku3/src/assets/js/main.js"></script>