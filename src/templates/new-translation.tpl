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
						Fetch latest yle news
					</button>
					<button type="button" class="btn btn-info">Format text</button>
					<button 
						hx-get="/kuku3/src/translate" 
						hx-target="#source"
						type="button" 
						class="btn btn-warning">
						Translate
					</button>
					<button type="button" class="btn btn-success">Save</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<textarea id="source" class="form-control" style="height: 650px;"></textarea>
		</div>
		<div class="col-md-6">
			<textarea id="translation" class="form-control" style="height: 650px;"></textarea>
		</div>
	</div>
</div>
