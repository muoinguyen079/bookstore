<?php 
class helper{

    //Create Button
    public static function cmsButton($name, $id, $link, $icon, $type = 'new'){
        $xhtml = '<li class="button" id="'.$id.'">';
        if($type == 'new'){
            $xhtml .= '<a class="modal" href="'.$link.'"><span class="'.$icon.'"></span>'.$name.'</a>';
        }else if($type == 'submit'){
            $xhtml .= '<a class="modal" href="#" onclick="javascript:submitForm(\''.$link.'\');"><span class="'.$icon.'"></span>'.$name.'</a>';
        }
        $xhtml .=  '</li>'; 

        return $xhtml;
    }

    //Create Icon Status
    public static function cmsStatus($statusValue , $link, $id){
        $strStatus = ($statusValue == 0) ? 'unpublish' : 'publish';
       
        $xhtml     = '<a class="jgrid" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\');">
                        <span class="state '.$strStatus.'"></span>
                     </a>';
        return $xhtml;            
    }

    //Create Icon Special
    public static function cmsSpecial($statusValue , $link, $id){
        $strStatus = ($statusValue == 0) ? 'unpublish' : 'publish';
       
        $xhtml     = '<a class="jgrid" id="special-'.$id.'" href="javascript:changeSpecial(\''.$link.'\');">
                        <span class="state '.$strStatus.'"></span>
                     </a>';
        return $xhtml;            
    }
    //Create Icon Group ACP
    public static function cmsGroupACP($groupAcpValue, $link, $id){
		$strGroupACP 	= ($groupAcpValue == 0) ? 'unpublish' : 'publish';
	
		$xhtml			= '<a class="jgrid" id="group-acp-'.$id.'" href="javascript:changeGroupACP(\''.$link.'\');">
								<span class="state '.$strGroupACP.'"></span>
							</a>';
		return $xhtml;
	}

      //Create title sort
    public static function cmsLinkSort  ($name , $column, $columnPost, $orderPost){
        $img    = '';
        $order  = ($orderPost == 'desc') ? 'asc' : 'desc';
        if($column == $columnPost){
           $img    = '<img src="'.TEMPLATE_URL.'admin/main/images/admin/sort_'.$orderPost.'.png" alt="">';
        }
        $xhtml = '<a href="#" onclick="javascript:sortList(this,\''.$column.'\',\''.$order.'\')">'.$name. $img.'</a>';
        return $xhtml;
    }

      //Create Message
    public static function cmsMessage($message){
        $xhtml = '';
        if(!empty($message)){
            $xhtml = '<dl id="system-message">
                                <dt class="'.$message['class'].'">'.ucfirst($message['class']).'</dt>
                                <dd class="'.$message['class'].'">
                                    <ul>
                                        <li>'.$message['content'].'</li>
                                    </ul>
                                </dd>
                            </dl>   ';
        }
        return $xhtml;
    }


      //Create select box
    public static function cmsSelectbox  ($name , $class, $arrValue, $keySelect = 'default', $style = null, $id = ''){
       
        $xhtml      = '<select id="'.$id.'" style="'.$style.'" name="'.$name.'" class="'.$class.'" >';
        foreach($arrValue as $key => $value){
            // print_r($arrValue);
            // print_r($key);
            if($key == $keySelect && is_numeric($keySelect)){
                $xhtml  .= '<option selected="selected" value = "'.$key.'">'.$value.'</option>';
            }else{
                $xhtml  .= '<option  value = "'.$key.'">'.$value.'</option>';
            }
           
        }  
        $xhtml      .= '</select>';
        return $xhtml;
       
    }

      //Create Input
      public static function cmsInput($type, $name, $id, $value, $class = null, $size = null){
		$strSize	=	($size==null) ? '' : "size='$size'";
		$strClass	=	($class==null) ? '' : "class='$class'";

		 $xhtml = "<input type='$type' name='$name' id='$id' value='$value' $strClass $strSize>";
		
		return $xhtml;
	}

      //Create Row - ADMIN
    public static function cmsRowForm($lblName, $input, $require =false ){
        $strRequired = '';
        if($require == true)$strRequired = '<span class="star">&nbsp;*</span>';
        $xhtml      = '<li> <label>'.$lblName.$strRequired.'</label>'.$input.'</li>';
        return $xhtml;
       
    }

      //Create Row - PUBLISH
    public static function cmsRow($lblName, $input, $submid = false){
        if($submid ==false){
            $xhtml      =   '<div class="form_row"><label class="contact"><strong>'.$lblName.':</strong></label>'.$input.'</div> ';
        }else{
            $xhtml      =   '<div class="form_row">'.$input.'</div> ';
        }        
        return $xhtml;
       
    }

    //Formate Date
    public static function formatDate($format, $value){
        $result = '';
        if(!empty($value) && $value  != '0000-00-00'){
            $result = date($format, strtotime($value));
           
        }
        return $result;
    }
    
}
?>