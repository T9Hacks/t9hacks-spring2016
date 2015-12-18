/* **************************** */
/*		Toggle the Forms		*/
/* **************************** */
$("#participantBtn").click(function(){
	toggleDivs(false, true, false);
});
$("#mentorBtn").click(function(){
	toggleDivs(false, false, true);
});
$("#participantBack").click(function(event){
	event.preventDefault();
	toggleDivs(true, false, false);
});
$("#mentorBack").click(function(event){
	event.preventDefault();
	toggleDivs(true, false, false);
});
function toggleDivs(signupShow, participantShow, mentorShow) {
	if(signupShow)
		$("#signupChoice").slideDown();
	else
		$("#signupChoice").slideUp();
	
	if(participantShow)
		$("#participantSignup").slideDown();
	else
		$("#participantSignup").slideUp();
	
	if(mentorShow)
		$("#mentorSignup").slideDown();
	else 
		$("#mentorSignup").slideUp();
}






/* ******************************** */
/*		Submit Registeration		*/
/*	Code adapted from: http://www.html5rocks.com/en/tutorials/cors/ */
/* ******************************** */
$("#mentorSubmitBtn").click(function(event){
	event.preventDefault();
	var successMessage = '<h1 class="blue">Success!</h1>' +
		'<p>Thank you for signing-up for ATLAS T9Hacks.  Your info will be send to your email.  We look forward to seeing you!</p>' +
		'<br/><br/><a href="index.html" class="btn btn-l">Back to Website</a>';
	
	submitSignup(event, "#mname", "#memail", "#mentorSignup", "#mentorForm", "#mentorLoading", "#mentorSuccess", successMessage);
});

$("#participantSubmitBtn").click(function(event){
	var successMessage = '<h1 class="blue">Success!</h1>' +
	'<p>Thank you for registering for ATLAS T9Hacks.  Your ticket will be send to your email.  We look forward to seeing you!</p>' +
	'<br/><br/><a href="index.html" class="btn btn-l">Back to Website</a>';
	
	submitSignup(event, "#pname", "#pemail", "#participantSignup", "#participantForm", "#participantLoading", "#participantSuccess", successMessage);
});
	
function submitSignup(event, nameDiv, emailDiv, signupDiv, formDiv, loadingDiv, successDiv, successMessage) {
	// first, prevent default
	event.preventDefault();
	
	// errors
	var errorCount = 0;
	
	// test if name filled out
	var name = $(nameDiv).val();
	if(name == null || name == "") {
		errorCount++;
		$(nameDiv).parent().parent().append('<div class="fieldError">You must enter your name.</div>');
	} else {}
		
	// test if email filled out
	var email = $(emailDiv).val();
	if(email == null || email == "") {
		errorCount++;
		$(emailDiv).parent().parent().append('<div class="fieldError">You must enter your email.</div>');
	} else {}
	
	//console.log("errorCount: " + errorCount);
	// only show if no errors
	if(errorCount == 0) {
		
		// show the loading gif
		var h = $(signupDiv).height();
		var w = $(formDiv).width();
		var h40 = h + 40;
		var w40 = w + 40;
		$(loadingDiv).height(h40).width(w40);
		$(loadingDiv).fadeIn(100);
		
		// get the data
		var data = new FormData($(formDiv)[0]);
		//console.log(data);
		
		// store the url
		var url = "http://creative.colorado.edu/~kosba/t9hacks/register.php";
		
		// post the data
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			contentType: false,
			processData: false,
			dataType: 'json',
			//success: function (returndata) {
			success: function(xhr, status, error) {
				// everything went well
				if(xhr.success) {
					//console.log("success");
					setTimeout(function(){
						$(successDiv).html(successMessage).removeClass("error").height(h).width(w).css({top: h+"px", display: "block"}).animate({top: "-="+h,});
						$(loadingDiv).hide();
					}, 1000);
	    		  
				// start trouble shooting problems
				} else {
	    			// print entire json response
	    			console.log(xhr);
	    			var errorMessage = error.responseText;
		    		console.log(errorMessage);
		    	  
		    		// see if email error
		    		if(xhr.emailSuccess == 0) {
		    			var errorMessage = "There was a problem sending a ticket to your email.  Please check the email you enered and resubmit the form.";
		    			$(successDiv).html(errorMessage).addClass("error");
						$(loadingDiv).fadeOut();
					  
					// all other errors
		    		} else {
		    			$(successDiv).html(errorMessage).height(h).width(w).css({top: h+"px", display: "block"}).animate({top: "-="+h,});
						$(loadingDiv).hide();
		    		}
				}
		    	
	    		// scroll to top
	    		$('html, body').animate({
	    			scrollTop: ($(signupDiv).offset().top - 81)
	    		}, 500);
	    	},
	    	error: function(xhr, status, error) {
	    		//console.log("error in ajax form submission");
	    		//console.log(xhr);
	    		//console.log(status);
	    		//console.log(error);
	    		var errorMessage = error.responseText;
	    		console.log(errorMessage);
	    		//var error = "<p>There was an error processing your request.  Please refresh the page and try again</p>";
	    		$(successDiv).html(errorMessage).height(h).width(w).css({top: h+"px", display: "block"}).animate({top: "-="+h,});
				$(loadingDiv).hide();
	    	}
		});
	} // end if errors, send ajax
	
}

