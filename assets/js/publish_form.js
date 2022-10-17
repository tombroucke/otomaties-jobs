import Pikaday from "pikaday";
import Quill from "quill";
import FormValidator from '@tombroucke/otomaties-form-validator';
import Polyglot from 'node-polyglot';

import '../scss/publish_form.scss';


jQuery(function ($) {

});

window.addEventListener('DOMContentLoaded', (event) => {
	const publishjobForm = document.querySelector('.otomaties-jobs-publish-form');

	const jobDescriptionEditor = new Quill('#job_description', {
		modules: {
			toolbar: [
				['bold', 'italic', 'underline'],
				['link']
			]
		},
		theme: 'snow',
	});

	const companyDescriptionEditor = new Quill('#company_description', {
		modules: {
			toolbar: [
				['bold', 'italic', 'underline'],
				['link']
			]
		},
		theme: 'snow',
	});

	publishjobForm.addEventListener('submit', () => {
		const jobDescription = document.querySelector('textarea[name="job_description"]');
		jobDescription.value = jobDescriptionEditor.root.innerHTML;
	});

	publishjobForm.addEventListener('submit', () => {
		const companyDescription = document.querySelector('textarea[name="company_description"]');
		companyDescription.value = companyDescriptionEditor.root.innerHTML;
	});
	
	var polyglot = new Polyglot();
	polyglot.extend({
		'This field is required': 'Dit veld is verplicht',
		'Enter a value less than or equal to {0}': 'Geef een waarde lager dan of gelijk aan {0} in',
		'Please enter a valid e-mailaddress': 'Geef een geldig e-mailadres in',
		'Enter a value greater than or equal to {0}': 'Geef een waarde hoger dan of gelijk aan {0} in',
		'Please select an option': 'Selecteer een optie',
	})
	new FormValidator(publishjobForm, polyglot);

	const options = {
		firstDay: 1,
		format: 'DD-MM-YYYY',
	}
	const publicationDate = new Pikaday({
		...options,
		...{
			field: document.getElementById('publication_date')
		}
	});
	const applicationDeadline = new Pikaday({
		...options,
		...{
			field: document.getElementById('application_deadline')
		}
	});

});
