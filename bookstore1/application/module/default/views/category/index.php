<?php
    $xhtml = '';
    if(!empty($this->Items)){
	
        foreach($this->Items as $key => $value){
			
			$name	= $value['name'];
			$nameURL		= URL::filterURL($name);
			$link	=URL::createLink('default', 'book', 'list', array('category_id' => $value['id']));
			$picturePath	= UPLOAD_PATH . 'category' . DS . '60x90-' . $value['picture'];
			if(file_exists($picturePath)==true){
				$picture	= '<img class="thumb" src="'.UPLOAD_URL . 'category' . DS . '60x90-' . $value['picture'].'">';
			}else{
				$picture	= '<img class="thumb" src="'.UPLOAD_URL . 'category' . DS . '60x90-default.jpg' .'">';
			}
			
			$xhtml 	.= '<div class="new_prod_box">
							<a href="'.$link.'">'.$name.'</a>
							<div class="new_prod_bg">
								<a href="'.$link.'">'.$picture.'</a>
							</div>           
						</div>';
        }
	}
	
?>


<!-- TITLE -->
    <div class="title">
        <span class="title_icon">
            <img src="<?php echo $imageURL;?>/bullet1.gif" alt="" title="">
        </span>Category books
    </div>

<!-- LIST CATEGORIES -->
<div class="new_products">
	<?php echo $xhtml;?>
</div>