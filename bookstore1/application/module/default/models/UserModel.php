<?php
class UserModel extends Model{

	
	private $_columns 	= array('id',
								'username',
								'email',
								'fullname', 
								'password',
								'created',
								'created_by',
								'modified',
								'modified_by',
								'register_date',
								'register_ip',
								'status',
								'ordering',
								'group_id'
								);
	
	
	private $_userInfo;							
	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_USER);

		$userObj 				=  Session::get('user');
		$this->_userInfo 		= $userObj['info'];
	}

	public function listItem($arrParam, $option = null){
		if($option['task'] == 'books-in-cart'){
			$cart	= Session::get('cart');
			$result	= array();
			if(!empty($cart)){
				$ids	= "(";
				foreach($cart['quantity'] as $key => $value) $ids .= "'$key', ";
				$ids	.= " '0')" ;

				$query[]	= "SELECT `id`, `name`, `picture`";
				$query[]	= "FROM `".TBL_BOOK."`";
				$query[]	= "WHERE `status`  = 1 AND `id` IN $ids";
				$query[]	= "ORDER BY `ordering` ASC";
		
				$query		= implode(" ", $query);
				$result		= $this->fetchAll($query);
				

				foreach($result as $key => $value){
					$result[$key]['quantity']	= $cart['quantity'][$value['id']];
					$result[$key]['totalprice']	= $cart['price'][$value['id']];
					$result[$key]['price']		= $result[$key]['totalprice'] / $result[$key]['quantity'];
				}
			}
			return $result;
		}

		
		if($option['task'] == 'history-cart'){
			$username		= $this->_userInfo['username'];
			$query[]	= "SELECT `id`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`";
			$query[]	= "FROM `".TBL_CART."`";
			$query[]	= "WHERE `username`  = '$username'";
			$query[]	= "ORDER BY `date` ASC";
	
			$query		= implode(" ", $query);
			$result		= $this->fetchAll($query);
			
			return $result;
		}
}

	
	public function saveItem($arrParam, $option = null){
	
		if($option['task'] == 'submit-cart'){
			$id			= $this->randomString(7);
			$username	= $this->_userInfo['username'];
			$books		= json_encode($arrParam['form']['bookid']);
			$prices		= json_encode($arrParam['form']['price']);
			$quantities	= json_encode($arrParam['form']['quantity']);
			$names		= json_encode($arrParam['form']['name']);
			$pictures	= json_encode($arrParam['form']['picture']);
			$date		= date('Y-m-d H:i:s', time());
			
			$query	= "INSERT INTO `".TBL_CART."`(`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`)
					VALUES ('$id', '$username', '$books', '$prices', '$quantities', '$names', '$pictures', '0', '$date')";
			
			$this->query($query);
			Session::delete('cart');
		}
	
	}

	public function randomString($length = 5){
	
		$arrCharacter = array_merge(range('a','z'), range(0,9), range('A','Z'));
		$arrCharacter = implode($arrCharacter, '');
		$arrCharacter = str_shuffle($arrCharacter);
	
		$result		= substr($arrCharacter, 0, $length);
		return $result;
	}


}	
