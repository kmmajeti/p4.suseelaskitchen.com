// Setting up the options for ajax
var options = { 
    type: 'POST',
    url: '/posts/p_add/',
    beforeSubmit: function() {
			$('#results').html("Adding...");
    },
		// Whatever is echo'd out from the v_posts_p_add.php page
		// will be returned as the parameter "response".
		// and it will inject that data into the page 
    success: function(response) {   
			$('#results').html(response);
    } 
}; 

// Using the above options, ajax'ify the form
$('form').ajaxForm(options);
