
<!-- TITLE -->
<div class="title">
	<span class="title_icon"><img src="<?php echo $imageURL;?>/bullet1.gif"></span>My
	cart
</div>

<!-- LIST BOOKS -->
<div class="feat_prod_box_details">
<?php
	$linkCategory	= URL::createLink('default', 'category', 'index');
	$linkSubimtForm	= URL::createLink('default', 'user', 'buy');
	
	if(!empty($this->Items)){
		$xhtml = '';
		$totalPrice	= 0;
		foreach ($this->Items as $key => $value){
			$linkDetailBook	= URL::createLink('default', 'book', 'detail', array('book_id' => $value['id']));
			$name			= $value['name'];
			$price			= number_format($value['price']);
			$priceTotal		= number_format($value['totalprice']);
			$quantity		= $value['quantity'];
			$totalPrice		+= $value['totalprice'];
			
			$picturePath	= UPLOAD_PATH . 'book' . DS . '98x150-' . $value['picture'];
			if(file_exists($picturePath)==true){
				$picture	= '<img  width="30" width="45" src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $value['picture'].'">';
			}else{
				$picture	= '<img width="30" width="45" src="'.UPLOAD_URL . 'book' . DS . '98x150-default.jpg' .'">';
			}
			
			$inputBookID	= Helper::cmsInput('hidden', 'form[bookid][]', 'input_book_' . $value['id'],  $value['id']);
			$inputQuantity	= Helper::cmsInput('hidden', 'form[quantity][]', 'input_quantity_' . $value['id'],  $value['quantity']);
			$inputPrice		= Helper::cmsInput('hidden', 'form[price][]', 'input_price_' . $value['id'],  $value['price']);
			$inputName		= Helper::cmsInput('hidden', 'form[name][]', 'input_name_' . $value['id'],  $value['name']);
			$inputPicture	= Helper::cmsInput('hidden', 'form[picture][]', 'input_picture_' . $value['id'],  $value['picture']);
		
			$xhtml	.= '<tr>
							<td><a href="'.$linkDetailBook.'">'.$picture.'</a></td>
							<td>'.$name.'</td>
							<td>'.$price.'</td>
							<td>'.$quantity.'</td>
							<td>'.$priceTotal.'</td>
						</tr>';
			$xhtml	.= $inputBookID . $inputQuantity . $inputPrice . $inputName . $inputPicture;
		}
?>
<form action="<?php echo $linkSubimtForm;?>" method="POST" name="adminForm" id="adminForm">

<table class="cart_table">
	<tbody>
		<tr class="cart_title">
			<td>Item pic</td>
			<td>Book name</td>
			<td>Unit price</td>
			<td>Qty</td>
			<td>Total</td>
		</tr>
		<?php echo $xhtml;?>
		<tr>
			<td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
			<td><?php echo number_format($totalPrice)?></td>
		</tr>
	</tbody>
</table>
<a href="<?php echo $linkCategory;?>" class="continue">&lt; continue</a> <a onclick="javascript:submitForm('<?php echo $linkSubimtForm;?>')" href="#" class="checkout">checkout &gt;</a>
</form>
<?php 
	}else{
?>
<h3>Chưa có quyển sách nào trong giỏ hàng</h3>
<?php 
	}
?>
</div>


