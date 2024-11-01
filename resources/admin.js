jQuery(document).ready(function($) {
	$('#addonchat-use-remote-authentication').bind('change click', function() {
		var $this = $(this);
		if($this.is(':checked')) {
			$('#addonchat-guest-access-container').show();
		} else {
			$('#addonchat-guest-access-container').hide();
		}
	}).change();
});