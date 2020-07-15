<?php
/*------------------------------------------------------------*/
require_once("hvmConfig.php");
require_once(M_DIR."/mfiles.php");
require_once("hvmFiles.php");
require_once("Hvm.class.php");
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
