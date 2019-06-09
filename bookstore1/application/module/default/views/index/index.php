
<!-- SPECIAL BOOKS -->

<div class="title">
	<span class="title_icon"> <img
		src="<?php echo $imageURL;?>/bullet1.gif" alt="" title=""></span>Featured
	books
</div>

<?php
	$xhtml = '';
	if(!empty($this->SpecialBooks)){
		foreach($this->SpecialBooks as $key => $value){
			$link			= URL::createLink('default', 'book', 'detail', array('book_id' => $value['id']));
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
	}
	echo $xhtml;
?>

<!-- NEW BOOKS -->
<div class="title">
	<span class="title_icon"><img src="<?php echo $imageURL;?>/bullet2.gif"
		alt="" title=""> </span>New books
</div>
<div class="new_products">
<?php 
	$xhtmlNewBooks = '';
	if(!empty($this->newBooks)){
		foreach($this->newBooks as $key => $value){
			$link			= URL::createLink('default', 'book', 'detail', array('book_id' => $value['id']));
			$name			= substr($value['name'], 0, 20);
			$description	= substr($value['description'], 0, 200);
			
			$picturePath	= UPLOAD_PATH . 'book' . DS . '98x150-' . $value['picture'];
			if(file_exists($picturePath)==true){
				$picture	= '<img class="thumb" width="60" height="90" src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $value['picture'].'">';
			}else{
				$picture	= '<img class="thumb" width="60" height="90" src="'.UPLOAD_URL . 'book' . DS . '98x150-default.jpg' .'">';
			}
			
			$xhtmlNewBooks 	.= '<div class="new_prod_box">
									<a href="'.$link.'">'.$name.'</a>
									<div class="new_prod_bg">
										<a href="'.$link.'">'.$picture.'</a>
									</div>
								</div>';
		}
	}
	echo $xhtmlNewBooks;
?>
</div>




