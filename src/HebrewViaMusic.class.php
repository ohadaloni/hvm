<?php
/*------------------------------------------------------------*/
class HebrewViaMusic extends Hvm {
	/*------------------------------------------------------------*/
	protected function before() {
		parent::before();
	}
	/*------------------------------------------------------------*/
	public function index() {
		$this->add();
		$this->listSongs();
	}
	/*------------------------------------------------------------*/
	public function listSongs() {
		$sql = "select * from hebrewViaMusic order by date desc";
		$rows = $this->Mmodel->getRows($sql);
		$this->Mview->showTpl("hebrewViaMusic/listSongs.tpl", array(
			'rows' => $rows,
		));
	}
	/*------------------------------------------------------------*/
	public function show() {
		$row = $this->Mmodel->getById("hebrewViaMusic", $_REQUEST['id']);
		$this->Mview->showTpl("hebrewViaMusic/show.tpl", array(
			'row' => $row,
		));
	}
	/*------------------------------*/
	/*------------------------------*/
	public function editText() {
		$row = $this->Mmodel->getById("hebrewViaMusic", $_REQUEST['id']);
		$this->Mview->showTpl("hebrewViaMusic/editText.tpl", array(
			'row' => $row,
			'fname' => $_REQUEST['fname'],
		));
	}
	/*------------------------------*/
	public function edit() {
		$row = $this->Mmodel->getById("hebrewViaMusic", $_REQUEST['id']);
		$this->Mview->showTpl("hebrewViaMusic/edit.tpl", array(
			'row' => $row,
		));
	}
	/*------------------------------*/
	public function update() {
		$this->Mmodel->dbUpdate("hebrewViaMusic", $_REQUEST['id'], $_REQUEST);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function remove() {
		$id = $_REQUEST['id'];
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->Mmodel->sql("delete from hebrewViaMusic where id = $id");
		else
			$this->Mview->error("remove: box not checked. ignoring.");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function add($description = null) {
		$this->Mview->showTpl("hebrewViaMusic/add.tpl");
	}
	/*------------------------------*/
	public function insert() {
		$_REQUEST['date'] = date("Y-m-d");
		$id = $this->Mmodel->dbInsert("hebrewViaMusic", $_REQUEST);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function redir() {
			$this->redirect("/hebrewViaMusic");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}

