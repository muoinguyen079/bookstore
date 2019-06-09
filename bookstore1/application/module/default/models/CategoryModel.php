<?php
class CategoryModel extends Model{

	
	private $_columns 	= array('id','name','picture','created','created_by','modified','modified_by','status','ordering');
	private $_userInfo;

	public function __construct(){
		parent::__construct();
		
		$this->setTable(TBL_CATEGORY);
		$userObj 				=  Session::get('user');
		$this->_userInfo 		= $userObj['info'];
	}

	public function listItem($arrParam, $option = null){
		$query[] 		= "SELECT `id`, `name`,`picture`";
		$query[] 		= "FROM `$this->table`";
		$query[] 		= "WHERE `status`= 1 ";
		$query[] 		= "ORDER BY `ordering` ASC";
	
		
		$query		= implode(" ", $query);
		$result		= $this->fetchAll($query);
		return $result;
	}


}