function getLatestPracticeData() {
	return {
		questionNumber: 0,
		progressPercent: 0,
		question: '',
		answerArray: [],
		choiceArray: [],
		result: '',
		resultMessage: '',
		exit: false,
		nextQuestionModal: false,

		updateProgressBar: function() {
			this.progressPercent = Math.ceil((this.questionNumber / this.questions.length) * 100);
		},
		
		checkAnswer: function() {
			//debugger;
			this.result = 'Correct';
			const qst = this.questions[this.questionNumber]['foreign_phrase_array'];
			const ans = this.answerArray;

			if (qst.length !== ans.length) {
				this.result = 'Incorrect';
			}
			else {
				for (let i = 0; i < qst.length; i++) {
					if (qst[i] !== ans[i].word) {
						this.result = 'Incorrect';
					}
				}
			}

			this.resultMessage = this.questions[this.questionNumber]['foreign_phrase'];
			this.nextQuestionModal = true;
		},

		addToAnswer: function(choice, id) {
			//debugger;
			this.answerArray.push(choice);
			this.choiceArray.forEach((choice) => {
				if (choice.id === id) {
					choice.hidden = true;
				}
			});
		},

		removeFromAnswer: function(index, id) {
			//debugger;
			this.answerArray.splice(index, 1);
			this.choiceArray.forEach((choice) => {
				if (choice.id === id) {
					choice.hidden = false;
				}
			});
		}, 

		populateChoiceAnswerArea: function() {
			// debugger;
			this.choiceArray = [...this.questions[this.questionNumber]['foreign_phrase_object']];
			// this.shuffleChoices(this.generateRandomWord());
			this.answerArray = [];
		},

		nextQuestion: function () {
			this.nextQuestionModal = false;

			if ((this.questionNumber + 1) == this.questions.length) {
				// Replace the progress button with an exit button
				this.exit = true;
				this.progressPercent = 100;
				return;
			}
			
			this.questionNumber++;
			this.updateProgressBar();
			this.populateChoiceAnswerArea();
		},

		updateOffsets() {
			//debugger;
			const choiceButton = this.$refs.choiceButton;
			this.widthOffset = choiceButton.offsetWidth;
			this.heightOffset = choiceButton.offsetHeight;
		},

		init: function () {
			this.populateChoiceAnswerArea();
		}
	}
}

// If there's an error response, show it in the toast
document.addEventListener('htmx:responseError', event => {
	const toastEl = document.getElementById('toast');
	toastEl.querySelector('.toast-body').textContent = event.detail.xhr.responseText;
	const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
	toast.show();
});

// Function to split sentences in the textarea
function splitSentences(textareaId) {
	const textarea = document.getElementById(textareaId);
	let text = textarea.value.replace(/(\r\n|\r|\n|“|"|”)/g, ' '); // Remove existing newlines and other things you don't want included.
	text = text.replace(/ {2,}/g, ' '); // Remove 2 or more spaces
	text = text.replace(/Radio \| Uutisviikko selkosuomeksi \|/g, 'Selkouutiset -');
	text = text.replace(/TV \| Selkouutiset \|/g, 'Selkouutiset -');
	text = text.replace(/(\s\|)/g, '.'); 
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
