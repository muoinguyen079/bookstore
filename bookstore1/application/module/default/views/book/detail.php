<?php 
	$bookInfo	= $this->bookInfo;
	$name		= $bookInfo['name'];
	
	$picturePath	= UPLOAD_PATH . 'book' . DS . '98x150-' . $bookInfo['picture'];
	$pictureFull	= '';
	if(file_exists($picturePath)==true){
		$picture		= '<img  src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $bookInfo['picture'].'">';
		$pictureFull	= UPLOAD_URL . 'book' . DS . $bookInfo['picture'];
	}else{
		$picture	= '<img src="'.UPLOAD_URL . 'book' . DS . '98x150-default.jpg' .'">';
	}
	
	$description	= substr($bookInfo['description'], 0, 400);
	
	$priceReal 		= 0;
	if($bookInfo['sale_off'] > 0){
		$priceReal 	= (100-$bookInfo['sale_off'])*$bookInfo['price']/100;
		$price	 	= ' <span class="red-through">'.number_format($bookInfo['price']).'</span>';
		$price		.= ' <span class="red">'.number_format($priceReal).'</span>';
	}else{
		$priceReal	= $bookInfo['price'];
		$price		= ' <span class="red">'.number_format($priceReal).'</span>';
	}

	$linkOrder		= URL::createLink('default', 'user', 'order', array('book_id' => $bookInfo['id'], 'price' => $priceReal));

?>

<!-- TITLE -->
<div class="title">
	<span class="title_icon"> <img
		src="<?php echo $imageURL;?>/bullet1.gif"></span><?php echo $name;?>
</div>

<!-- BOOK INFO -->
<div class="feat_prod_box_details">
	<div class="prod_img">
		<a href="#"><?php echo $picture;?></a> <br>
		<br> <a id="single_image" href="<?php echo $pictureFull;?>"
			rel="lightbox"> <img src="<?php echo $imageURL;?>/zoom.gif" alt=""
			title="" border="0"></a>
	</div>
	<div class="prod_det_box">
		<div class="box_top"></div>
		<div class="box_center">
			<div class="prod_title">Details</div>
			<p class="details"><?php echo $description;?></p>
			<div class="price">
				<strong>PRICE:</strong><?php echo $price;?>
			</div>
			<a href="<?php echo $linkOrder;?>" class="more"><img
				src="<?php echo $imageURL;?>/order_now.gif"></a>
			<div class="clear"></div>
		</div>
		<div class="box_bottom"></div>
	</div>
	<div class="clear"></div>
</div>

<?php
	$xhtmlRelateBooks = '';
	if(!empty($this->bookRelate)){
		foreach($this->bookRelate as $key => $value){
			$link			= URL::createLink('default', 'book', 'detail', array('book_id' => $value['id']));
			$name			= substr($value['name'], 0, 20);
			
			$picturePath	= UPLOAD_PATH . 'book' . DS . '98x150-' . $value['picture'];
			if(file_exists($picturePath)==true){
				$picture	= '<img class="thumb" width="60" height="90" src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $value['picture'].'">';
			}else{
				$picture	= '<img class="thumb" width="60" height="90" src="'.UPLOAD_URL . 'book' . DS . '98x150-default.jpg' .'">';
			}
			
			$xhtmlRelateBooks 	.= '<div class="new_prod_box">
									<a href="'.$link.'">'.$name.'</a>
									<div class="new_prod_bg">
										<a href="'.$link.'">'.$picture.'</a>
									</div>
								</div>';
		}
	}
?>
<!-- RELATE BOOK -->
<div id="demo" class="demolayout">

	<ul id="demo-nav" class="demolayout">
		<li><a class="tab1 active" href="#">More details</a></li>
		<li><a class="tab2" href="javascript:void(0)">Related books</a></li>
	</ul>

	<div class="tabs-container">

		<div style="display: block;" class="tab" id="tab1">
			<p class="more_details"><?php echo $bookInfo['description'];?></p>
		</div>

		<div style="display: none;" class="tab" id="tab2">
			<?php echo $xhtmlRelateBooks;?>
			<div class="clear"></div>
		</div>
	</div>
</div>