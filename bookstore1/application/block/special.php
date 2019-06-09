<?php
	$query	= "SELECT `id`, `name`, `picture`, `category_id` FROM `".TBL_BOOK."` WHERE `status`  = 1 AND `special` = 1 ORDER BY `ordering` ASC LIMIT 0,2";

	$listBooksSecial	= $model->fetchAll($query);
	$xhtmlSecial		= '';

	if(!empty($listBooksSecial)){
		foreach($listBooksSecial as $key => $value){
			$link	= URL::createLink('default', 'book', 'detail', array('category_id' => $value['category_id'] ,'book_id' => $value['id']));
			$name	 = $value['name'];
			
			$picturePath	= UPLOAD_PATH . 'book' . DS . '98x150-' . $value['picture'];
			if(file_exists($picturePath)==true){
				$picture	= '<img class="thumb" width="60" height="90" src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $value['picture'].'">';
			}else{
				$picture	= '<img class="thumb" width="60" height="90" src="'.UPLOAD_URL . 'book' . DS . '98x150-default.jpg' .'">';
			}
			
			$xhtmlSecial	.= '<div class="new_prod_box">
	                        <a href="'.$link.'">'.$name.'</a>
	                        <div class="new_prod_bg">
	                        <span class="new_icon"><img src="'.$imageURL.'/special_icon.gif" alt="" title="" /></span>
	                        <a href="'.$link.'">'.$picture.'</a>
	                        </div>           
	                    </div>';
		}
	}
?>
<div class="right_box">

	<div class="title">
		<span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet4.gif" alt="" title="" /></span>Specials
	</div>
	<?php echo $xhtmlSecial;?>
</div>