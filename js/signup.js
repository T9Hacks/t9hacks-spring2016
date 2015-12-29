var canReload = false;
$(document).ready(function(){
	/* On change events for participant friends */
	$("input[type=radio][name=friends]").change(function(){ 
		var n = $(this).val(); 
		var h = $(".regBtn").attr("href");
		$(".regBtn").attr("href", h.slice(0, -1) + n);
	});
	
	/* On change events for	participant confirmation table */
	$("#participantName")		.change(function(){ $("#pName")		.html($(this).val()); });
	$("#participantEmail")		.change(function(){ $("#pEmail")	.html($(this).val()); });
	$("#participantCollege")	.change(function(){	$("#pCollege")	.html($(this).val()); });
	$("#participantMajor")		.change(function(){ $("#pMajor")	.html($(this).val()); });
	$("#participantPhone")		.change(function(){ $("#pPhone")	.html($(this).val()); });
	
	$("#participantLinkedin")	.change(function(){ $("#pLinkedin")	.html($(this).val()); });
	$("#participantWebsite")	.change(function(){	$("#pWebsite")	.html($(this).val()); });
	$("#participantGithub")		.change(function(){ $("#pGithub")	.html($(this).val()); });
	$("#participantCompany")	.change(function(){ $("#pCompany")	.html($(this).val()); });
	$("#participantPosition")	.change(function(){	$("#pPosition")	.html($(this).val()); });
	$("#participantFacebook")	.change(function(){ $("#pFacebook")	.html($(this).val()); });
	$("#participantTwitter")	.change(function(){ $("#pTwitter")	.html($(this).val()); });
	
	$("#pShirt").html( $("input[type=radio][name=shirt][checked=checked]").val() );
	$("input[type=radio][name=shirt]").change(function(){ $("#pShirt").html($(this).val()); });
	
	/* on change participant friend confirmation table */
	$("#friendName1")	.change(function(){ $("#fName1")	.html($(this).val()); });
	$("#friendEmail1")	.change(function(){ $("#fEmail1")	.html($(this).val()); });
	
	$("#friendName2")	.change(function(){ $("#fName2")	.html($(this).val()); });
	$("#friendEmail2")	.change(function(){ $("#fEmail2")	.html($(this).val()); });
	
	$("#friendName3")	.change(function(){ $("#fName3")	.html($(this).val()); });
	$("#friendEmail3")	.change(function(){ $("#fEmail3")	.html($(this).val()); });
	
	/* On change event for resume uploading */
	$("#resumeUploadInput").change = (function () {
		var res = (this.value).split("\\");
		var file = res[res.length-1];
		document.getElementById("resumeName").value = file;
		document.getElementById("pResume")
		$("#pResume").html( file );
	});
	
	
	/* On change events for	mentor confirmation table */
	$("#mentorName")		.change(function(){ $("#mName")		.html($(this).val()); });
	$("#mentorEmail")		.change(function(){ $("#mEmail")	.html($(this).val()); });
	$("#mentorPhone")		.change(function(){ $("#mPhone")	.html($(this).val()); });
	
	$("#mentorCompany")		.change(function(){ $("#mCompany")	.html($(this).val()); });
	$("#mentorPosition")	.change(function(){	$("#mPosition")	.html($(this).val()); });
	
	$("#mentorBreakfast")	.change(function(){ mBreakfast(); });
	$("#mentorLunch")		.change(function(){ mLunch(); });
	$("#mentorDinner")		.change(function(){ mDinner(); });
	
	$("#mentorWebDesign")	.change(function(){ mWebDesign(); });
	$("#mentorWebDev")		.change(function(){ mWebDev(); });
	$("#mentorAndroid")		.change(function(){ mAndroid(); });
	$("#mentoriOS")			.change(function(){ miOS(); });
	$("#mentorUIUX")		.change(function(){ mUIUX(); });
	$("#mentorGaming")		.change(function(){ mGaming(); });
	$("#mentorPrint")		.change(function(){ mPrint(); });
	$("#mentorArduino")		.change(function(){ mArduino(); });
	
	mBreakfast();
	mLunch();
	mDinner();
	
	mWebDesign();
	mWebDev();
	mAndroid();
	miOS();
	mUIUX();
	mGaming();
	mPrint();
	mArduino();
});
/* Functions for mentor confirmation table */
function mBreakfast() {	$("#mBreakfast").html(	(($("#mentorBreakfast").prop( "checked" )) ?	'<i class="fa fa-check-square-o"></i>' : "") ); }
function mLunch() { 	$("#mLunch").html( 		(($("#mentorLunch").prop( "checked" )) ? 		'<i class="fa fa-check-square-o"></i>' : "") ); }
function mDinner() { 	$("#mDinner").html( 	(($("#mentorDinner").prop( "checked" )) ? 		'<i class="fa fa-check-square-o"></i>' : "") ); }

function mWebDesign() { $("#mWebDesign").html(	(($("#mentorWebDesign").prop("checked")) ? 	'<i class="fa fa-check-square-o"></i>' : "") ); }
function mWebDev() { 	$("#mWebDev").html( 	(($("#mentorWebDev").prop("checked")) ? 	'<i class="fa fa-check-square-o"></i>' : "") ); }
function mAndroid() { 	$("#mAndroid").html( 	(($("#mentorAndroid").prop("checked")) ? 	'<i class="fa fa-check-square-o"></i>' : "") ); }
function miOS() { 		$("#miOS").html( 		(($("#mentoriOS").prop("checked")) ? 		'<i class="fa fa-check-square-o"></i>' : "") ); }
function mUIUX() { 		$("#mUIUX").html( 		(($("#mentorUIUX").prop("checked")) ? 		'<i class="fa fa-check-square-o"></i>' : "") ); }
function mGaming() { 	$("#mGaming").html( 	(($("#mentorGaming").prop("checked")) ? 	'<i class="fa fa-check-square-o"></i>' : "") ); }
function mPrint() { 	$("#mPrint").html( 		(($("#mentorPrint").prop("checked")) ? 		'<i class="fa fa-check-square-o"></i>' : "") ); }
function mArduino() { 	$("#mArduino").html( 	(($("#mentorArduino").prop("checked")) ? 	'<i class="fa fa-check-square-o"></i>' : "") ); }


// turn off reload for reg buttons
$(".regBtn").click(function(){ canReload = true; });


/* ******************************************** */
/*			Sign-up Form to 					*/
/* 			Confirmation Table					*/
/* ******************************************** */
// confirmation button, hides form and shows confirmation table
$(".confirmationBtn").click(function(event){
	event.preventDefault();

	$(".signupLoading").show();
	setTimeout(function(){
		$(".signupLoading").hide();
		$(".signupForm").hide();
		$(".signupConfirmation").show();
	}, 700);
	
	animateToTop($(".signupTop"));
});

//back to edit button, shows form and hides confirmation table
$(".backToEditBtn").click(function(event){
	event.preventDefault();
	showForm();
});
function showForm() {
	$(".signupForm").show();
	$(".signupConfirmation").hide();
	
	animateToTop($(".signupTop"));
}





/* **************************************************************** */
/*					Submit Registeration							*/
/*	Code adapted from: http://www.html5rocks.com/en/tutorials/cors  */
/* **************************************************************** */

$("#mentorSubmitBtn").click(function(event){
	var f = $(this).attr("data-friends");
	submitSignup(event, false, f);
});

$("#participantSubmitBtn").click(function(event){
	var f = $(this).attr("data-friends");
	submitSignup(event, true, f);
});


function submitSignup(event, isParticipant, numFriends) {
	// first, prevent default
	event.preventDefault();
	
	
	// delete any old error messages
	$(".fieldError").remove();
	$(".error").removeClass("error").html("");
	
	
	// create the ids
	var prefix = (isParticipant) ? "participant" : "mentor";
	var hashPrefix = "#" + prefix;
	var $nameDiv	= $(hashPrefix + "Name");
	var $emailDiv	= $(hashPrefix + "Email");
	var $phoneDiv	= $(hashPrefix + "Phone");
	var $collegeDiv	= $(hashPrefix + "College");
	var $majorDiv	= $(hashPrefix + "Major");
	
	var $topDiv		= $(hashPrefix + "Top");
	var $loadingDiv	= $(hashPrefix + "Loading");
	var $resultDiv	= $(hashPrefix + "Result");
	var $formDiv	= $(hashPrefix + "Form");
	var $confirmationDiv = $(hashPrefix + "Confirmation");
	
	
	// errors
	var errorCount = 0;
	
	// array of divs that must be checked
	var inputDivs = [$nameDiv, $emailDiv, $phoneDiv];
	
	// array of error messages
	var inputErrors = [
		"You must enter your email.",
		"You must enter your name.",
		"You must enter your phone number."
	];
	if(isParticipant) {
		inputDivs.push($collegeDiv);
		inputErrors.push("You must enter your college.");
		
		inputDivs.push($majorDiv);
		inputErrors.push("You must enter your major.");
	}
	for(var i=0; i<numFriends; i++) {
		var fid = i+1;
		inputDivs.push($("#friendName" + fid));
		inputErrors.push("You must enter their name.");
		inputDivs.push($("#friendEmail" + fid));
		inputErrors.push("You must enter their email.");
	}
	
	// loop through the inputs
	for(var i=0; i<inputDivs.length; i++) {
		var inputVal = inputDivs[i].val();
		if(inputVal == null || inputVal == "") {
			errorCount++;
			inputDivs[i].parent().parent().append('<div class="fieldError error">' + inputErrors[i] + '</div>');
		} else {}
	}
	
	if(errorCount > 0) {
		$(".signupResult").addClass("error").html("It looks like there was a problem with your submission.  Please fix any problems and submit again.");
		showForm();
	}
	
	
	//console.log("errorCount: " + errorCount);
	// only show if no errors
	if(errorCount == 0) {
		
		// show the loading gif
		var h = $topDiv.height();
		var w = $formDiv.width();
		var h40 = h + 40;
		var w40 = w + 40;
		$loadingDiv.height(h40).width(w40);
		$loadingDiv.fadeIn(100);
		
		// get the data
		var data = new FormData($formDiv[0]);
		//console.log(data);
		
		// store the url
		var url = $formDiv.attr("action");
		
		// post the data
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function(xhr, status, error) {
				// everything went well
				if(xhr.SUCCESS) {
					//console.log("success");
					setTimeout(function(){
						doSuccess();
					}, 1000);
				  
				// start trouble shooting problems
				} else {
					// print entire json response
					console.log(xhr);
					console.log(status);
					console.log(error);
					
					// get the message
					var errorMessage = xhr.MESSAGE;
					console.log(errorMessage);
				  
					// print error to screen
					$resultDiv.html(errorMessage).addClass("error");
					$loadingDiv.fadeOut();
					showForm();
				}
				
				// scroll to top
				animateToTop($topDiv);
				
			},
			error: function(xhr, status, error) {
				//console.log("error in ajax form submission");
				console.log(xhr);
				console.log(status);
				console.log(error);
				var errorMessage = xhr.responseText;
				console.log(errorMessage);
				$resultDiv.html(errorMessage).addClass("error");
				$loadingDiv.fadeOut();
				showForm();
				
				// scroll to top
				animateToTop($topDiv);
			}
		});
	} // end if errors
	
}

function animateToTop($topDiv) {
	// scroll to top
	$('html, body').animate({
		scrollTop: ($topDiv.offset().top - 81)
	}, 500);
}

function doSuccess() {
	canReload = true;
	window.location.href = "signup-success.php";
}

window.onbeforeunload = function (e) {
	if(!canReload) {
		e = e || window.event;
		var t = "If you leave this page, your progress will be lost.";
		if (e) {
			e.returnValue = t;
		}
		return t;
	}
};

