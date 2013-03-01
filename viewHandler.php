<?php

/* check we have a view to present */
if (!isset($_GET["v"])) {
	die("<html><body><p>Please go to <a href=\"index.php\">index</a>." .
		"</p></body></html>");
}

/* get the view and its path */
$view = $_GET["v"];
$path = "views/$view";

/* check we havn't any .. in the view name */
if (preg_match("/\.\./", $view)) {
	header("HTTP/1.0 400 Bad Request");
	die(json_encode(array("err" => "There cannot be a \"..\" in the view name.")));
}

/* check the directory for the view exists */
if (!is_dir($path)) {
	header("HTTP/1.0 404 Not Found");
	die(json_encode(array("err" => "No such view: $view.")));
}

/* read the files */
$html = file_get_contents("$path/html.html");
$css = file_get_contents("$path/css.css");
$js = file_get_contents("$path/js.js");

/* check the files was read */
if ($html === false) {
	header("HTTP/1.0 500 Internal Server Error");
	die(json_encode(array("err" => "Could not read html.")));
} else if ($css === false) {
	header("HTTP/1.0 500 Internal Server Error");
	die(json_encode(array("err" => "Could not read css.")));
} else if ($js === false) {
	header("HTTP/1.0 500 Internal Server Error");
	die(json_encode(array("err" => "Could not read js.")));
}

/* add the path to each image in the html
 * Change <img src="..." ... > to <img src="$path/..." ... >
 */
$res = preg_replace('/src="(.*)"/', "src=\"$path/$1\"", $html);
if ($res == NULL) {
	header("HTTP/1.1 500 Internal Server Error");
	die(json_encode(array("err" => "Could not replace image tags.")));
} 

/* update the html to the replaced */
$html = $res;

/* create json object of the data */
$arr = array("html" => $html, "css" => $css, "js" => $js);
$json = json_encode($arr);

/* send the header and the data */
header("Content-Type: application/json");
echo $json;

