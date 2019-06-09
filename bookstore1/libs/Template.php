<?php
class Template{
	
	// File config (admin/main/template.ini)
	private $_fileConfig;
	
	// File template (admin/main/inde.php)
	private $_fileTemplate;
	
	// Folder template (admin/main/)
	private $_folderTemplate;
	
	// Controller Object
	private $_controller;
	
	public function __construct($controller){
		$this->_controller = $controller;
	}
	
	public function load(){
		$fileConfig 	= $this->getFileConfig();
		$folderTemplate = $this->getFolderTemplate();
		$fileTemplate 	= $this->getFileTemplate();
		
		$pathFileConfig	= TEMPLATE_PATH . $folderTemplate . $fileConfig;
		
		if(file_exists($pathFileConfig)){
			$arrConfig = parse_ini_file($pathFileConfig);
			
			$view = $this->_controller->getView();
			$view->_title 		= $view->createTitle($arrConfig['title']);
			$view->_metaHTTP 	= $view->createMeta($arrConfig['metaHTTP'], 'http-equiv');
			$view->_metaName 	= $view->createMeta($arrConfig['metaName'], 'name');
			$view->_cssFiles 	= $view->createLink($this->_folderTemplate . $arrConfig['dirCss'], $arrConfig['fileCss'], 'css');
			$view->_jsFiles 	= $view->createLink($this->_folderTemplate . $arrConfig['dirJs'], $arrConfig['fileJs'], 'js');
			$view->_dirImg 		= TEMPLATE_URL . $this->_folderTemplate . $arrConfig['dirImg'];

			
			$view->setTemplatePath(TEMPLATE_PATH . $folderTemplate . $fileTemplate);
		}
	
	}
	
	
	// SET FILE TEMPLATE ('index.php')
	public function setFileTemplate($value = 'index.php'){
		$this->_fileTemplate = $value;
	}
	
	// GET FILE TEMPLATE
	public function getFileTemplate(){
		return $this->_fileTemplate;
	}
	
	// SET FILE CONFIG ('template.ini)
	public function setFileConfig($value = 'template.ini'){
		$this->_fileConfig = $value;
	}
	
	// GET FILE CONFIG
	public function getFileConfig(){
		return $this->_fileConfig;
	}
	
	
	// SET FOLDER TEMPLATE (default/main/)
	public function setFolderTemplate($value = 'default/main/'){
		$this->_folderTemplate = $value;
	}
	
	// GET FOLDER CONFIG
	public function getFolderTemplate(){
		return $this->_folderTemplate;
	}
}