if (Drupal.jsEnabled) {	
	Drupal.behaviors.Meebo = function (context) {
		$('input[name="meebo_sharing"]').change(function() {
			var value = $("input[name='meebo_sharing']:checked").val();
			
			if(value == 1) {
				$('#meebo-discover').show();
			} else {
				$('#meebo-discover').hide();
			}
		});
		
		if($("input[name='meebo_sharing']:checked").val() == 1) {
			$('#meebo-discover').show();
		}
	}
}