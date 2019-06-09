<?php
class View{
	
	public $_moduleName;
	public $_templatePath;
	public $_title;
	public $_metaHTTP;
	public $_metaName;
	public $_cssFiles;
	public $_jsFiles;
	public $_dirImg;
	public $_fileView;
	
	public function __construct($moduleName){
		$this->_moduleName = $moduleName;
	}
	
	public function render( $fileInclude, $loadFull = true){
		$path = MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $fileInclude . '.php';
		if(file_exists($path)){
			if($loadFull == true){
				$this->_fileView = $fileInclude;
				require_once $this->_templatePath;
			}else{
				require_once $path;
			}
		}else{
			echo '<h3>' . __METHOD__ . ': Error</h3>';
		}
	}
	
	// Thiết lập đường dẫn đến template
	public function setTemplatePath($path){
		$this->_templatePath = $path;
	}
	
	// CREATE CSS - JS
	public function createLink($path, $files, $type = 'css'){
		$xhtml = '';
		if(!empty($files)){
			$path = TEMPLATE_URL . $path . DS;
			
			foreach($files as $file){
			
				if($type == 'css'){

					$xhtml .= '<link rel="stylesheet" type="text/css" href="'.$path.$file.'"/>';
				}else if($type == 'js'){
					$xhtml .= '<script type="text/javascript" src="'.$path.$file.'"></script>';
				}
			}
		}
		return $xhtml;
	}
	
	
	// CREATE META (NAME - HTTP)
	public function createMeta($arrMeta, $typeMeta = 'name'){
		$xhtml = '';
		if(!empty($arrMeta)){
			foreach($arrMeta as $meta){
				$temp = explode('|', $meta);
				$xhtml .= '<meta '.$typeMeta.'="'.$temp[0].'" content="'.$temp[1].'" />';
			}
		}
		return $xhtml;
	}
	
	// CREATE TITLE
	public function createTitle($value){
		return '<title>'.$value.'</title>';
	}
	
	// SET TITLE
	public function setTitle($value){
		$this->_title = '<title>'.$value.'</title>';
	}
	
	// SET CSS
	public function appendCSS($arrayCSS){
		if(!empty($arrayCSS)){
			foreach ($arrayCSS as $css){
				$file = APPLICATION_URL . $this->_moduleName . DS . 'views' . DS . $css;
				$this->_cssFiles .= '<link rel="stylesheet" type="text/css" href="'.$file.'"/>';
			}
		}
	}
	
	// SET JS
	public function appendJS($arrayJS){
		if(!empty($arrayJS)){
			foreach ($arrayJS as $js){
				$file = APPLICATION_URL . $this->_moduleName . DS . 'views' . DS . $js;
				$this->_jsFiles .= '<script type="text/javascript" src="'.$file.'"></script>';
			}
		}
	}
}