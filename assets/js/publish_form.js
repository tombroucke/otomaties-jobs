import 'jquery-validation';
import Pikaday from "pikaday";

import '../scss/publish_form.scss';


jQuery(function ($) {
	$('.otomaties-jobs-publish-form').validate();
	let options = {
		firstDay: 1,
		format: 'DD-MM-YYYY',
	}
	var publicationDate = new Pikaday({
		...options,
		...{
			field: document.getElementById('publication_date')
		}
	});
	var applicationDeadline = new Pikaday({
		...options,
		...{
			field: document.getElementById('application_deadline')
		}
	});

});
