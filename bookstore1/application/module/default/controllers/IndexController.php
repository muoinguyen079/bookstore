<?php
class IndexController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function noticeAction(){
		$this->_view->render('index/notice');
	}

	public function indexAction(){
		$this->_view->_title 	= 'Book Store';
		$this->_view->SpecialBooks 	= $this->_model->listItem($this->_arrParam, array('task' => 'books-special'));
		$this->_view->newBooks 		= $this->_model->listItem($this->_arrParam, array('task' => 'books-new'));

		$this->_view->render('index/index');

	}

	public function registerAction(){
		$userInfo 		= Session::get('user');
		//$userInfo = null;
		if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
			URL::redirect('default', 'user', 'index');
		}

		if(isset($this->_arrParam['form']['submit'])){
			URL::checkRefreshPage($this->_arrParam['form']['token'], 'default', 'user', 'register');

			$queryUserName	= "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '".$this->_arrParam['form']['username']."'";
			$queryEmail		= "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '".$this->_arrParam['form']['email']."'";
		
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('username', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryUserName,'min' => 3, 'max' => 25))
					 ->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query' => $queryEmail))
					 ->addRule('password', 'password', array('action' => 'add'));
					
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrorsPublic();
			}else{
				
				$id = $this->_model->saveItem($this->_arrParam,array('task' => 'user-register'));
				URL::redirect('default', 'index', 'notice', array('type' => 'register-success'));
				
			}
		}
		$this->_view->render('index/register');
	}

	public function logoutAction(){
		Session::delete('user');
		URL::redirect('default', 'index', 'index');
	}
	
	public function loginAction(){
		$userInfo = null;
		if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
			URL::redirect('default', 'user', 'index');
		}

		$this->_view->_title = 'Login';

		$userInfo 		= Session::get('user');

		if(isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token']  > 0)  {
			$validate 	= new Validate($this->_arrParam['form']);
			$email 		= $this->_arrParam['form']['email'];
			$password 	= md5($this->_arrParam['form']['password']);
			$query 		= "SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
			$validate->addRule('email', 'existRecord', array('database' => $this->_model, 'query'=> $query));
			$validate->run();

			if($validate->isValid()==true){
				$infoUser		= $this->_model->infoItem($this->_arrParam);
				$arraySession	= array(
										'login'		=> true,
										'info'		=> $infoUser,
										'time'		=> time(),
										'group_acp'	=> $infoUser['group_acp']
									);
				Session::set('user', $arraySession);
				URL::redirect('default', 'user', 'index');
			}else{
				$this->_view->errors	= $validate->showErrorsPublic();
			}
		}
		
		$this->_view->render('index/login');
	}
}