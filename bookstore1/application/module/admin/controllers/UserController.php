<?php
class UserController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	

	//List USER
	public function indexAction(){
		$this->_view->_title 		= 	'User Manager :: List ';
		$totalItems					=	$this->_model->countItem($this->_arrParam, null);
		$configPagination			= array('totalItemsPerPage'	=> 5,'pageRange'=> 3);
		$this->setPagination($configPagination);
		$this->_view->pagination	=	new Pagination($totalItems,$this->_pagination);

		$this->_view->slbGroup		=	$this->_model->itemInSelectbox($this->_arrParam, null);
		$this->_view->Items			=	$this->_model->listItem($this->_arrParam, null);
		$this->_view->render('user/index');

	}

	//ACTION : ADD & EDIT user
	public function formAction(){
		$this->_view->_title = ' User: Add';
		$this->_view->slbGroup		=	$this->_model->itemInSelectbox($this->_arrParam, null);
		if(isset($this->_arrParam['id'])){
			
			$this->_view->_title	 = ' User : Edit';
			$this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
			if(empty($this->_arrParam['form'])) URL::redirect('admin', 'user', 'index');
			
		}
		if(isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token'] > 0){
			$task 			= 'add'; 
			$requirePass 	= true;
			$queryUserName	= "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '".$this->_arrParam['form']['username']."'";
			$queryEmail		= "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '".$this->_arrParam['form']['email']."'";
			if(isset($this->_arrParam['form']['id'])){
				$task   		 = 'edit';
				$requirePass 	 = false;
				$queryUserName  .= "AND`id` <> '".$this->_arrParam['form']['id']."'";
				$queryEmail 	.= "AND`id` <> '".$this->_arrParam['form']['id']."'";
			}

			
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('username', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryUserName,'min' => 3, 'max' => 25))
					 ->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query' => $queryEmail))
					 ->addRule('password', 'password', array('action' => $task), $requirePass)
					 ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
					 ->addRule('status', 'status', array('deny' => array('default')))
					 ->addRule('group_id', 'status', array('deny' => array('default')));
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
			
				$id = $this->_model->saveItem($this->_arrParam,array('task' => $task));
				if($this->_arrParam['type'] == 'save-close') URL::redirect('admin','user','index');
				if($this->_arrParam['type'] == 'save-new') 	 URL::redirect('admin','user','form');
				if($this->_arrParam['type'] == 'save') 		 URL::redirect('admin','user','form',array('id' => $id));
			}
		}
	
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render('user/form');
	}

	//Action : Ajax Status (*)
	public function ajaxStatusAction(){
		$result = $this->_model->changeStatus($this->_arrParam, array('task' => 'change-ajax-status'));
		echo json_encode($result);
	}

	//Action : STATUS (*)
	public function statusAction(){
		$this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
		URL::redirect('admin', 'user', 'index');
	}	
	//Action : TRASH (*)
	public function trashAction(){
		$this->_model->deleteItem($this->_arrParam);
		URL::redirect('admin', 'user', 'index');
	}	
	//Action : Ordering (*)
	public function orderingAction(){
		$this->_model->ordering($this->_arrParam);
		URL::redirect('admin', 'user', 'index');
	}	
}