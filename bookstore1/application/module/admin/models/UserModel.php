<?php
class UserModel extends Model{

	
	private $_columns 	= array('id','username','email', 'fullname', 'password', 'created','created_by','modified','modified_by','status','ordering','group_id');
	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_USER);
	}

	public function countItem($arrParam, $option = null){
		$query[] 	= "SELECT COUNT(`id`) AS `total`";
		$query[] 	= "FROM `$this->table`";
		$query[] 	= "WHERE `id` > 0";

		// FILTER : KEYWORD
		if(!empty($arrParam['filter_search'])){
			$keyword		= '"%' . $arrParam['filter_search'] . '%"';
			$query[] 		= "AND (`username` LIKE $keyword OR `email` LIKE $keyword)";
		}
		
		// FILTER : STATUS
		if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default' ){
			$query[] 		= "AND `status` = '" .$arrParam['filter_state']. "'";
		}

		// FILTER : GROUP ID
		if(isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default' ){
			$query[] 		= "AND `group_id` = '" . $arrParam['filter_group_id'] . "'";
		}

		$query		= implode(" ", $query);
		$result		= $this->fetchRow($query);
		return !empty( $result) ? $result['total'] : 0;
	}

	public function itemInSelectbox($arrParam, $option = null){
		$result = '';
		if($option == null){
			$query = "SELECT `id`, `name` FROM `" . TBL_GROUP . "`";
			$result = $this->fetchPairs($query);
			$result['default'] = "- Select Group -";
			ksort($result);
			
		}
		return $result;
	}

	public function listItem($arrParam, $option = null){
		$query[] 		= "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`fullname`, `u`.`status`, `u`.`ordering`, `u`.`created`, `u`.`created_by`,`u`.`modified_by`, `u`.`modified`, `g`.`name` AS `group_name`";
		$query[] 		= "FROM `$this->table` AS `u` LEFT JOIN `".TBL_GROUP."` AS `g` ON `u`.`group_id`=`g`.`id`";
		$query[] 		= " WHERE `u`.`id` > 0 ";
		// FILTER : KEYWORD
		if(!empty($arrParam['filter_search'])){
			$keyword		= '"%' . $arrParam['filter_search'] . '%"';
			$query[] 		= "AND (`username` LIKE $keyword OR `email` LIKE $keyword)";
		}

		// FILTER : STATUS
		if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default' ){
			$query[] 		= "AND `u`.`status` = '" . $arrParam['filter_state'] . "'";
		}

		// FILTER : GROUP ID
		if(isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default' ){
			$query[] 		= "AND `u`.`group_id` = '" . $arrParam['filter_group_id'] . "'";
		}

		//SORT
		if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir'])){
			$column			= $arrParam['filter_column'];
			$columnDir		= $arrParam['filter_column_dir'];
			$query[] 		= "ORDER BY `u`.`$column` $columnDir";
		}else{
			$query[] 		= "ORDER BY `u`.`id` DESC ";
		}

		// PAGINATION
		$pagination			= $arrParam['pagination'];
		$totalItemsPerPage	= $pagination['totalItemsPerPage']; 
		if($totalItemsPerPage > 0){
			$position	= ($pagination['currentPage']-1)*$totalItemsPerPage;
			$query[]	= "LIMIT $position, $totalItemsPerPage";
		}

		
		$query		= implode(" ", $query);
		$result		= $this->fetchAll($query);
		return $result;
	}

	public function changeStatus($arrParam, $option = null){
		if($option['task'] == 'change-ajax-status'){
			$status = ($arrParam['status'] == 0) ? 1 : 0;
			$id		= $arrParam['id'];
			$modified_by	= $this->_userInfo['username'];
			$modified		= date('Y-m-d', time());
			$query	= "UPDATE`$this->table` SET `status` = $status, `modified` = '$modified',`modified_by` = '$modified_by' WHERE `id` = '".$id."'";
			$this->query($query);
			
			$result = array(
								'id'		=> $id,
								'status'	=> $status,
								'link'		=> URL::createLink('admin','user', 'ajaxStatus', array('id' => $id, 'status' => $status))
							);
			return  $result;
		}

		if($option['task'] == 'change-status'){
			$status 	= $arrParam['type'];
			$modified_by	= $this->_userInfo['username'];
			$modified		= date('Y-m-d', time());
			if(!empty($arrParam['cid'])){
				$ids		= $this->createWhereDeleteSQL($arrParam['cid']);
				$query		= "UPDATE`$this->table` SET `status` = $status, `modified` = '$modified',`modified_by` = '$modified_by'  WHERE `id` IN ($ids)";
				$this->query($query);
				Session::set('message', array('class' => 'success', 'content' =>  'Có '.$this->affectedRows().' phần tử được thay đổi trạng thái !'));
			}else{
				
				Session::set('message',array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muốn thay đổi trạng thái !'));
			}
		}
		
	}


	public function deleteItem($arrParam, $option = null){
		if($option == null){
			if(!empty($arrParam['cid'])){
				$ids		= $this->createWhereDeleteSQL($arrParam['cid']);
				echo $query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
				$this->query($query);
				Session::set('message', array('class' => 'success', 'content' =>'Có '.$this->affectedRows().' phần tử được XÓA!'));
			}else{
				Session::set('message',array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muốn xóa!'));
			}
		}
	}

	public function infoItem($arrParam, $option = null){
		if($option == null){
			$query[] 	= "SELECT `id`,`username`,`email`,`fullname`,`group_id`,`status`,`ordering`";
			$query[] 	= "FROM `$this->table`";
			$query[] 	= "WHERE `id` = '" . $arrParam['id']. "'";
			$query		= implode(" ", $query);
			$result		= $this->fetchRow($query);
			return $result;
		}
	}
	public function saveItem($arrParam, $option = null){
		if($option['task'] == 'add'){
			$arrParam['form']['created']	= date('Y-m-d', time());
			$arrParam['form']['created_by']	=  $this->_userInfo['username'];
			$arrParam['form']['password']	= md5($arrParam['form']['password']);
			$data	= array_intersect_key($arrParam['form'],array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', array('class' => 'success', 'content' =>'Dữ liệu được lưu thành công!'));
			return $this->lastID();
		}
		if($option['task'] == 'edit'){
			// khong cho thay doi user name
			unset($arrParam['form']['username']);
			
			$arrParam['form']['modified']	= date('Y-m-d', time());
			$arrParam['form']['modified_by']	= 10;
			if($arrParam['form']['password'] != null){
				$arrParam['form']['password']	= md5($arrParam['form']['password']);
			}else{
				unset($arrParam['form']['password']);
			}
			$data	= array_intersect_key($arrParam['form'],array_flip($this->_columns));
		
			$this->update($data, array(array('id', $arrParam['form']['id'])));
			Session::set('message', array('class' => 'success', 'content' =>'Dữ liệu được lưu thành công!'));
			return $arrParam['form']['id'];
		}
	}

	public function ordering($arrParam, $option = null){
		if($option == null){
			if(!empty($arrParam['order'])){
				
				$i = 0;
				$modified_by	= $this->_userInfo['username'];
				$modified		= date('Y-m-d', time());
				foreach($arrParam['order'] as $id => $ordering){
					 $i++;
					 $query	= "UPDATE`$this->table` SET `ordering` = $ordering, `modified` = '$modified',`modified_by` = '$modified_by'  WHERE `id` = '".$id."'";
					 $this->query($query);
				}
				Session::set('message', array('class' => 'success', 'content' =>'Có '.$i.' phần tử được thay đổi Ordering!'));	
			}
		}
	}
}