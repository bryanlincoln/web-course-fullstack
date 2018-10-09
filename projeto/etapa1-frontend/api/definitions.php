<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors', 1); // 1
error_reporting(E_ALL); // E_ALL;

session_start();

define("DEFAULT_LOGGED_HOME", "painel.php");
define("LOGIN_PAGE", "./");

$url = str_replace("msg", "lmsg", isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "../");
define("LAST_PAGE", $url);

define("POST_MODEL", '<div style="border:2px solid #000">
    <h3>#username#</h3>
    <p>#message#</p>
    <p>#date#</p>
    <p>#likes# curtidas</p>
    <a href="api/api.php?like&id=#id#">Upvote</a>
</div>');


include_once("connections.php");
include_once("api_functions.php");

?>