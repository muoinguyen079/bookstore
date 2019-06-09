<?php
class BookController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	// ACTION: LIST CATEGORY
	public function listAction(){
		$this->_view->_title 			= ' List Book';
		$this->_view->categoryName 		= $this->_model->infoItem($this->_arrParam, array('task' => 'get-cat-name'));
		$this->_view->Items 			= $this->_model->listItem($this->_arrParam, array('task' => 'books-in-cat'));
		$this->_view->render('book/list');
	}
	
	// ACTION: DETAIL BOOK
	public function detailAction(){
		$this->_view->_title 		= 'Info book';
		 $this->_view->bookInfo 		= $this->_model->infoItem($this->_arrParam, array('task' => 'book-info'));
		 
		 $this->_view->bookRelate	= $this->_model->listItem($this->_arrParam, array('task' => 'books-relate'));
		$this->_view->render('book/detail');
	}
	
}