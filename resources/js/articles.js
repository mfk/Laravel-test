'use strict';

$(document).ready(function(){

	const form = $('#article__upsert');

    if ( form.length == 0 ) {
		return;
	}

	const title = form.find('input[name="article__title"]');
	const text = form.find('textarea[name="article__text"]');
	const categories = form.find('select[name="article__categories"]');
	const submitButton = form.find('button');

	form.submit( function() {
		submitButton.loadingButton();

		title.attr('readonly', true);
		text.attr('readonly', true);

		$.ajax({
			type: 'POST',
			url: form.prop('action'),
			data: {
				title: title.val(),
				text: text.val(),
				categories: categories.val() ? categories.val().join(',') : '',
			},
			dataType: 'json',
			success: function( data ) {
				title.attr('readonly', false);
				text.attr('readonly', false);
				submitButton.loadingButton(false);

				submitButton.notify('successful', { className:'success', position:'right' });
			},
			error: function( error ) {
				title.attr('readonly', false);
				text.attr('readonly', false);
				submitButton.loadingButton(false);

				submitButton.notify('failed', { position:'right' });
			}
		});

		return false;
	});

});