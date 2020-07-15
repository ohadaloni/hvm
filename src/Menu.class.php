<?php
/*------------------------------------------------------------*/
class Menu extends Mcontroller {
	/*------------------------------------------------------------*/
	public function index() {
			$this->Mview->showTpl("menuDriver.tpl", array(
				'menu' => $this->dd(),
			));
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function dd() {
		$menu = array(
			'hvm' => array(
				array(
					'name' => 'listSongs',
					'title' => 'List Songs',
					'url' => "/hebrewViaMusic/listSongs",
				),
				array(
					'name' => 'showSource',
					'title' => 'Show Source Code',
					'url' => "/showSource",
				),
			),
		);
		$loginName = HvmLogin::loginName();
		if ( $loginName )
			$menu[$loginName] = array(
				array(
					'name' => 'landHere',
					'title' => 'Land Here',
					'url' => "/hvm/landHere",
				),
				array(
					'name' => 'UnLand',
					'title' => 'unland (land latest)',
					'url' => "/hvm/unland",
				),
				array(
					'name' => 'chpass',
					'title' => 'Change Password',
					'url' => "/hvm/changePasswd",
				),
				array(
					'name' => 'logout',
					'title' => 'Log Off',
					'url' => "/?logOut=logOut",
				),
			);
		return($menu);
	}
	/*------------------------------------------------------------*/
}

