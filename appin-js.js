var viewStack = new Array(); // to keep track of the order the views were visited
var currentView; // to know what to push onto the stack
var mode; // to know if we have portrait or landscape mode

/* set some functionality when the document is ready */
$(document).ready(function() {
	/* load the main view at startup */
	setView("main");

	/* we want portrait mode */
	changeMode("portrait");

	/* 
	 * set the functionality of the back button,
	 * we want to show the previous view 
	 */
	$("#buttonBack").click(function() {
		if (viewStack.length < 1) {
			/* if the stack is empty, set the main view */
			setView("main");
		} else {
			/* the stack is not empty, set the previous view */
			setView(viewStack.pop());
		}
	});

	/*
	 * set the functionality of the reset button,
	 * we want to restart the application (by
	 * showing main)
	 */
	$("#buttonReset").click(function() {
		/* reset the stack, curretView and the mode */
		currentView = "main";
		viewStack = new Array();
		changeMode("portrait");

		/* show main */
		setView("main");
	});

	/*
	 * set the menu toggling
	 */
	$("#buttonMenu").click(function() {
		$("#menu").toggle();
	});

	/*
	 * we want to make sure the menu is hidden
	 */
	$("#menu").hide();

	/*
	 * make the rotate button toggle portrait/landscape
	 */
	$("#buttonRotate").click(function() {
		var action = (mode == "portrait") ? "landscape" : "portrait";
		changeMode(action);
	});
});

/**
 * Set the view to view. View should be a string.
 */
function setView(view) {
	if (typeof view != "string") {
		/* if view is not a string, do nothing */
		return;
	}

	/* set the system status to loading (viev) */
	setStatus("<p>Loading " + view + ".</p>");

	/* push the old view onto the stack */
	viewStack.push(currentView);

	/* set the new view */
	currentView = view;

	

	/* hide the menu */
	$("#menu").hide("fast");
	/* load the html/css/js, most should be self explaining */
	$.ajax({
		url: "viewHandler.php?v="+view,
		dataType: "json",
		statusCode: { /* to handle errors from the script */
			404: function(data) {
				var error = data.err;
				$("#status").html("<p class\"error\">Could not load view " + error + ": it does not exist.</p>"); },
			400: function(data) {
				var error = data.err;
				$("#status").html("<p class\"error\">There is an error in the view syntax: " + error + ".</p>"); },
			500: function(data) {
				var error = data.err;
				$("#status").html("<p class\"error\">Could not load the view: " + error + ".</p>"); },
		}
	}).done(function(data) {
		/* we loaded the view successfully, set the data */
		$("#view").html(data.html);
		$("#viewCss").html(data.css);
		$("#viewScripts").html(data.js);

		/* set the system status to done loading */
		setStatus("<p>Done!</p>");
	});
}

/* 
 * to switch between portrait and landscape
 * Paremeters: newMode, a string of either "portrait" or "landscape".
 */
function changeMode(newMode) {
	if (newMode != "portrait" && newMode != "landscape") {
		return;
	}

	/* save the new mode */
	mode = newMode;

	/* set the status */
	setStatus("Rotating to " + newMode);

	/* remove the classes */
	$("#box").removeClass("portait landscape widthheightportrait widthheightlandscape");
	$("#view").removeClass("widthheightportrait widthheightlandscape");
	$(".menuButton").removeClass("menuButtonPortrait menuButtonLandscape");
	$("#buttons").removeClass("buttonsPortrait buttonsLandscape");

	
	if (newMode == "portrait") {
		/* set the css */
		$("#box").addClass("portrait widthheightportrait");
		$("#view").addClass("widthheightportrait");
		$(".menuButton").addClass("menuButtonPortrait");
		$("#buttons").addClass("buttonsPortrait");
	} else {
		/* newMode is landscape */

		/* set the css */
		$("#box").addClass("widthheightlandscape landscape");
		$("#view").addClass("widthheightlandscape");
		$(".menuButton").addClass("menuButtonLandscape");
		$("#buttons").addClass("buttonsLandscape");
	}

	/* set the status */
	setStatus("<p>Done!</p>");
}

function setStatus(stat) {
	$("#status").html(stat);
}

