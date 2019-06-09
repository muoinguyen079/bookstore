<?php
	$xhtml = '';
	if(!empty($this->Items)){
		
		foreach($this->Items as $key => $value){
			$link			= URL::createLink('default', 'book', 'detail', array('category_id' => $value['category_id'] ,'book_id' => $value['id']));
			$name			= $value['name'];
			$description	= substr($value['description'], 0, 200);
			
			$picturePath	= UPLOAD_PATH . 'book' . DS . '98x150-' . $value['picture'];
			if(file_exists($picturePath)==true){
				$picture	= '<img  src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $value['picture'].'">';
			}else{
				$picture	= '<img src="'.UPLOAD_URL . 'book' . DS . '98x150-default.jpg' .'">';
			}
			
			$xhtml 	.= '<div class="feat_prod_box">
							<div class="prod_img"><a href="'.$link.'">'.$picture.'</a></div>
					
							<div class="prod_det_box">
								<div class="box_top"></div>
								<div class="box_center">
									<div class="prod_title">'.$name.'</div>
									<p class="details">'.$description.'</p>
									<a href="'.$link.'" class="more">- more details -</a>
									<div class="clear"></div>
								</div>
								<div class="box_bottom"></div>
							</div>
							<div class="clear"></div>
						</div>';
		}
	}else{
		$xhtml 	= '<div class="feat_prod_box">Nội dung đang cập nhật!</div>';
	}
?>

<!-- TITLE -->
<div class="title">
	<span class="title_icon"> <img
		src="<?php echo $imageURL;?>/bullet1.gif" alt="" title="">
	</span><?php echo $this->categoryName;?>
</div>

<!-- LIST CATEGORIES -->
<?php echo $xhtml;?>
