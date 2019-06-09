<?php
class IndexModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $username	= $arrParam['form']['username'];
			$password	= md5($arrParam['form']['password']);
			$query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`email`, `u`.`username`, `u`.`group_id`, `g`.`group_acp`,`g`.`privilege_id`";
			$query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS g ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `username` = '$username' AND `password` = '$password'";
			
			$query		= implode(" ", $query);
            $result		    = $this->fetchRow($query);

            if($result['group_acp'] == 1){
               $arrPrivilege    = explode(",",$result['privilege_id'] );
               $strPrivilegeID  = '';
               foreach($arrPrivilege as $privilegeID) $strPrivilegeID   .= "'$privilegeID'," ;

                $queryP[]        = "SELECT `id`, CONCAT (`module`,'-', `controller`,'-', `action`) AS `name` ";
                $queryP[]        = "FROM `".TBL_PRIVILEGE."` AS p";
                $queryP[]        = " WHERE id IN ($strPrivilegeID'0')";
                
                
                $queryP		                     = implode(" ", $queryP);
                $result['privilege']		     = $this->fetchPairs($queryP);
             
            }
           
            return $result;
                
        }
    }
}