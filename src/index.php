<?php
/*------------------------------------------------------------*/
require_once("hvmConfig.php");
require_once(M_DIR."/mfiles.php");
require_once("hvmFiles.php");
require_once("Hvm.class.php");
/*------------------------------------------------------------*/
$ua = @$_SERVER['HTTP_USER_AGENT'];
if (
	! $ua
	|| stristr($ua, "bot")
	|| stristr($ua, "crawl")
	|| stristr($ua, "spider")
	) {
	http_response_code(204);
	exit;
}
/*------------------------------------------------------------*/
global $Mview;
global $Mmodel;
$Mview = new Mview;
$Mmodel = new Mmodel;
$Mview->holdOutput();
/*------------------------------------------------------------*/
$hvm = new Hvm;
$hvmLogin = new HvmLogin;
if ( isset($_REQUEST['logOut']) ) {
	$hvm = new Hvm;
	$hvmLogin->logOut();
}
$isLoggedIn = $hvmLogin->enterSession();
$hvm->control();
$Mview->flushOutput();
/*------------------------------------------------------------*/
/*------------------------------------------------------------*/
