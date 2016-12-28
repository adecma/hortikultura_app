$(document).ready(function () {
	// confirm delete
	$(document.body).on('submit', '.ask-delete', function () {
		var text = 'Anda yakin akan menghapus data ini?';

		return confirm(text);
	});

	//auto hide notification alert
	$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
});