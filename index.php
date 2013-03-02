<?php
/* the width of the view */
$width_width = 320;

/* the height of the view */
$width_height = 480;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Appin</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<style>
		/* set a background color and remove margin from the browser window */
		body, html {
			background-color: #D1D1D1;
			margin: 0px;
			padding: 0px;
		}

		/* draw a black border with round corners as a box */
		div#box {
			padding: 40px 40px 80px 40px; /* to make the box appear */
			border-radius: 40px; /* we want round corners */
			background-color: black; /* make the box black */
			margin: 20px auto; /* center it, 20 pixels free above */
			width: <?php echo $width_width; ?>px; /* set width */
			height: <?php echo $width_height; ?>px; /* set height */
		}

		/* the view, set bgcolor and overflow */
		div#view {
			width: <?php echo $width_width; ?>px; /* set width */
			height: <?php echo $width_height; ?>px; /* set height */
			background-color: white; /* we want (as default) a white view */
			overflow-y: auto; /* to enable scrolling when necessary */
			overflow-x: hidden;
		}

		/* if someone wants a copyright footer */
		div#foot {
			font-size: 12px; /* make it pretty small */
			text-align: center; /* center the text */
		}

		/* to show the system status */
		div#status {
			font-size: 12px;
			text-align: center;
		} 

		/* to show errors */
		p.error {
			color: red;
			font-size: 14px;
		}

		/* to make the menu buttons look pretty */
		div.menuButton {
			background-color: #AAAAAA; /* make the buttons grey */
			height: 20px; /* don't forget there is margin and padding as well */
			width: <?php echo ($width_width/3 - 40); ?>px; /* we have 3 buttons, each with a space of 40 pixels around, adjust the width so the buttons are as wide as possible */
			margin: 7px 10px 0px 10px; /* set some margins */
			padding: 10px; /* set padding (to make the text appear more in the center */
			float: left; /* the buttons are to appear on a row */
			border-radius: 10px; /* give them round corners */
			text-align: center; /* make the text centered */
		}

		/* hide the menu by default */
		div#menu {
			display: none;
		}
	</style>
	<script src="appin-js.js"></script>
	<script id="viewScripts"></script> <!-- to hold the scripts of the current view -->
	<style id="viewCss" type="text/css" rel="stylesheet"></style> <!-- to hold the css of the current view -->
</head>
<body>
	<div id="box">
		<div id="view"> <!-- to hold the current view -->
			<p>The interface should have been presented here. However, it has not been loaded.</p>
			<p>Please try refreshing the page, or wait a few seconds.</p>
			<p>If you still don't see anything, please make sure there is a main view (or contact someone responsible).</p>
		</div> <!-- view -->
		<div id="buttons"> <!-- the buttons -->
			<div class="menuButton" id="buttonBack">Back</div>
			<div class="menuButton" id="buttonReset">Reset</div>
			<div class="menuButton" id="buttonMenu">Menu</div>
		</div> <!-- buttons -->
	</div> <!-- box -->
	<div id="status"> <!-- to hold the app status (done, loading, etc.) -->
		&nbsp;
	</div> <!-- status -->
	<!-- <div id="foot">
		<p class="copy">&copy; (this year) (the designer)</p>
	</div> --> <!-- foot -->
</body>
</html>
