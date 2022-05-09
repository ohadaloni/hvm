<?php
/*------------------------------------------------------------*/
class ShowSource extends Hvm {
	/*------------------------------------------------------------*/
	public function index() {
		$V = "/var/www/vhosts";
		$fileList = $this->fileList();
		$tplArgs = $fileList;
		$file = @$_REQUEST['file'];
		if ( $file ) {
			/*	$parts = explode("/", $file);	*/
			/*	$sourceFileName = end($parts);	*/
			$source = highlight_file($file, true);
		}
		$this->Mview->showTpl("showSource/showSource.tpl", array(
			'files' => $fileList,
			'sourceFile' => $file,
			'source' => @$source,
		));
	}
	/*------------------------------------------------------------*/
	private function fileList() {
		$files = `echo *.php tpl/*.tpl`;
		$files = preg_split('/\s+/', $files);
		array_pop($files);
		foreach ( $files as $key => $file )
			if ( strstr($file, "*") )
				unset($files[$key]);
		return($files);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}
/*------------------------------------------------------------*/
