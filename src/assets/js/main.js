// Function to split sentences in the textarea
function splitSentences(textareaId) {
	const textarea = document.getElementById(textareaId);
	let text = textarea.value.replace(/(\r\n|\r|\n|“|"|”)/g, ' '); // Remove existing newlines and other things you don't want included.
	text = text.replace(/ {2,}/g, ' '); // Remove 2 or more spaces
	text = text.replace(/Radio \| Uutisviikko selkosuomeksi \|/g, 'Selkouutiset -');
	const datePattern = /(\d{1,2})\.(\d{1,2})\.(\d{4})/g; // convert date format dd.mm.yyyy to dd-mm-yyyy
	text = text.replace(datePattern, (match, p1, p2, p3) => `${p1}-${p2}-${p3}`);

	const exceptions = ['Mr','Mrs','Dr','Sr','Prof','St','Ave','Rd','Blvd']; // collect these from a form field
	const exceptionsPattern = exceptions.join('|');
	const pattern = new RegExp(`(.*?)(?<!${exceptionsPattern})[.!?\\]]`, 'g');
	const sentences = text.match(pattern);
	
	if (sentences) {
		const newText = sentences.map(sentence => sentence.trim()).join("\n");
		textarea.value = newText;
	}
}

function autoResize(textarea) {
	textarea.style.height = 'auto'; // Reset the height to auto to calculate the new height
	textarea.style.height = (textarea.scrollHeight) + 'px'; // Set the height to match the content
}
