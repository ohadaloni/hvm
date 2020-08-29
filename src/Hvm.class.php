<?php
/*------------------------------------------------------------*/
class Hvm extends Mcontroller {
	/*------------------------------------------------------------*/
	protected $loginName;
	protected $loginId;
	protected $loginType;
	/*------------------------------*/
	private $startTime;
	/*------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();

		// permit is called before before()
		// and if fails, before is not called.
		$this->loginId = HvmLogin::loginId();
		$this->loginName = HvmLogin::loginName();
		$this->loginType = HvmLogin::loginType();

		Mutils::setenv("debugLevel", 1);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	protected function before() {
		ini_set('max_execution_time', 10);
		ini_set("memory_limit", "5M");

		$this->startTime = microtime(true);
		$this->Mview->assign(array(
			'loginName' => $this->loginName,
		));
		if ( $this->showMargins()) {
			$this->Mview->showTpl("head.tpl");
			$this->Mview->showTpl("header.tpl");
			$menu = new Menu;
			$menu->index();
			$msgs = Msession::get('msgBuf');
			$this->Mview->showTpl("msgs.tpl", array(
				'msgs' => $msgs,
			));
		}
		$method = @$_SERVER['REQUEST_METHOD'];
		if ( $method == "GET" ) {
			$url = @$_SERVER['REQUEST_URI'];
			if ( $this->redirectable($url) ) {
				$this->Mview->setCookie("lastVisit", $url);
			}
		}
		$this->Mview->register_modifier("terse", array("Mutils", "terse",));
	}
	/*------------------------------------------------------------*/
	protected function after() {
		if ( ! $this->showMargins())
			return;
		$endTime = microtime(true);
		$time = $endTime - $this->startTime ;
		$millis = $time * 1000;
		$millis = round($millis, 3);
		$this->Mview->msg("Running Time: $millis milliseconds");
		$this->Mview->showTpl("footer.tpl");
		$this->Mview->showTpl("foot.tpl");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function index() {
		$loginType = HvmLogin::loginType();
		$loginId = HvmLogin::loginId();
		if ( $loginId ) {
			$sql = "select landHere from users where id = $loginId";
			$landHere = $this->Mmodel->getString($sql);
			if ( $this->redirectable($landHere) ) {
				$this->redirect($landHere);
				return;
			}
		}
		$lastVisit = @$_COOKIE['lastVisit'];
		if ( $this->redirectable($lastVisit) ) {
			$this->redirect($lastVisit);
			return;
		}
		$this->redirect("/hebrewViaMusic");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function landHere() {
		$referer = $_SERVER['HTTP_REFERER'];
		$parts = explode("/", $referer, 4);
		$landHere = "/".$parts[3];
		$affected = $this->dbUpdate("users", $this->loginId, array(
			'landHere' => $landHere,
		));
		$this->Mview->msg("landHere page set to $landHere");
		$this->redirect($landHere);
	}
	/*------------------------------------------------------------*/
	public function unland() {
		$affected = $this->dbUpdate("users", $this->loginId, array(
			'landHere' => null,
		));
		$this->Mview->msg("landHere page set to auto");
		$this->redirect("/");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function redirectable($url) {
		if ( ! $url )
			return(false);
		if ( $url == "/" )
			return(false);

		$parts = explode("?", $url);
		$parts = explode("/", $parts[0]);
		$pathParts = array();
		foreach ( $parts as $part )
			if ( $part != "" )
				$pathParts[] = $part;
		if ( ! $pathParts )
			$pathParts = array("hvm", "x");

		$className = $pathParts[0];
		$action = @$pathParts[1];
		$action = $action ? $action : "index";
		$nots = array(
			'hvm' => array(
				'unland',
				'changePasswd',
				'updatePasswd',
			),
		);
		foreach( $nots as $notClassName => $notClass )
			foreach( $notClass as $notAction )
				if ( strcasecmp($notClassName, $className) == 0
						&& 
						( strcasecmp($notAction, $action) == 0 || $notAction == 'any' )
					) {
						return(false);
					}

		$files = Mutils::listDir(".", "php");
		$baseName = null;
		foreach ( $files as $file ) {
			$fileParts = explode(".", $file);
			$baseName = reset($fileParts);
			if(strtolower($className) != strtolower($baseName) )
				continue;
			require_once($file);
			if ( ! class_exists($baseName) ) {
				return(false);
			}
			break;
		}
		if ( ! method_exists($baseName, $action) ) {
			return(false);
		}
		return(true);
	}
	/*------------------------------------------------------------*/
	private function isAjax() {
		$http_x_requested_with = @$_SERVER['HTTP_X_REQUESTED_WITH'];
		$isAjax =
			$http_x_requested_with &&
			strtolower($http_x_requested_with) == "xmlhttprequest" ;
		return($isAjax);
	}
	/*------------------------------*/
	private function showMargins() {
		if ( $this->isAjax() ) {
			return(false);
		}
		$nots = array(
			'hvm' => array(
				'unland',
			),
		);
		$controller = $this->controller;
		$action = $this->action;
		foreach( $nots as $notClassName => $notClass )
			foreach( $notClass as $notAction )
				if ( strcasecmp($notClassName, $controller) == 0
						&& 
						( strcasecmp($notAction, $action) == 0 || $notAction == 'any' )
					) {
						return(false);
					}
		return(true);
	}
	/*------------------------------------------------------------*/
	public function changePasswd() {
		$this->Mview->showTpl("admin/changePasswd.tpl");
	}
	/*------------------------------*/
	public function updatePasswd() {
		$loginName = $this->loginName;
		$oldPasswd = @$_REQUEST['oldPasswd'];
		$newPasswd = @$_REQUEST['newPasswd'];
		$newPasswd2 = @$_REQUEST['newPasswd2'];
		if ( ! $oldPasswd || ! $newPasswd || ! $newPasswd2 ) {
			$this->Mview->error("updatePasswd: please fill in all 3 fields");
			return;
		}
		if ( $newPasswd != $newPasswd2 ) {
			$this->Mview->error("updatePasswd: new passwords are not the same");
			return;
		}
		$sql = "select * from users where loginName = '$loginName'";
		$loginRow = $this->Mmodel->getRow($sql);
		if ( ! $loginRow ) {
			$this->Mview->error("updatePasswd: no login row");
			return;
		}
		$dbPasswd = $loginRow['passwd'];
		if ( $dbPasswd != $oldPasswd && $dbPasswd != sha1($oldPasswd) ) {
			$this->Mview->error("updatePasswd: old password incorrect");
			return;
		}
		$newDbPasswd = sha1($newPasswd);
		$this->dbUpdate("users", $loginRow['id'], array(
			'passwd' => $newDbPasswd,
		));
		$this->Mview->msg("Password changed");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	protected function dbInsert($tableName, $data) {
		if ( $this->loginName )
			return($this->Mmodel->dbInsert($tableName, $data));
		$this->Mview->error("Not logged in. insert ignored");
		return(null);
	}
	/*------------------------------*/
	protected function dbUpdate($tableName, $id, $data) {
		if ( $this->loginName )
			return($this->Mmodel->dbUpdate($tableName, $id, $data));
		$this->Mview->error("Not logged in. Update ignored");
		return(null);
	}
	/*------------------------------*/
	protected function dbDelete($tableName, $id) {
		if ( $this->loginName )
			return($this->Mmodel->dbDelete($tableName, $id));
		$this->Mview->error("Not logged in. delete ignored");
		return(null);
	}
	/*------------------------------*/
	protected function sql($sql) {
		if ( $this->loginName )
			return($this->Mmodel->sql($sql));
		$this->Mview->error("Not logged in. db change ignored");
		return(null);
		
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}
