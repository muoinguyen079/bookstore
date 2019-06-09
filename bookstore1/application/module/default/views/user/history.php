<?php 

	$xhtml = ''; 
	if(!empty($this->Items)){
		$tableHeader = '<tr class="cart_title"><td>Item pic</td><td>Book name</td><td>Unit price</td><td>Qty</td><td>Total</td></tr>';
		foreach($this->Items as $key => $value){
			$cartId			= $value['id'];
			$date			= date("H:i d/m/Y", strtotime($value['date']));
			$arrBookID		= json_decode($value['books']);
			$arrPrice		= json_decode($value['prices']);
			$arrName		= json_decode($value['names']);
			$arrQuantity	= json_decode($value['quantities']);
			$arrPicture		= json_decode($value['pictures']);
			$tableContent	= '';
			$totalPrice		= 0;
			
			foreach ($arrBookID as $keyB => $valueB){
				$linkDetail		= URL::createLink('default', 'book', 'detail', array('book_id' => $valueB));
				$picturePath	= UPLOAD_PATH . 'book' . DS . '98x150-' . $arrPicture[$keyB];
				if(file_exists($picturePath)==true){
					$picture	= '<img  width="30" height="45" src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $arrPicture[$keyB].'">';
				}else{
					$picture	= '<img width="30" height="45" src="'.UPLOAD_URL . 'book' . DS . '98x150-default.jpg' .'">';
				}
				$totalPrice		+= $arrQuantity[$keyB] * $arrPrice[$keyB];
				$tableContent .= '<tr>
								<td><a href="'.$linkDetail.'">'.$picture.'</a></td>
								<td class="name">'.$arrName[$keyB].'</td>
								<td>'.number_format($arrPrice[$keyB]).'</td>
								<td>'.$arrQuantity[$keyB].'</td>
								<td>'.number_format($arrQuantity[$keyB] * $arrPrice[$keyB]).'</td>
							</tr>';
			}
			
			$xhtml .= '<div class="history-cart">
							<h3>Mã đơn hàng:'.$cartId.' - Thời gian: '.$date.'</h3>
							<table class="cart_table">
								<tbody>
									'.$tableHeader.$tableContent.'
									<tr>
										<td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
										<td>'.number_format($totalPrice).'</td>
									</tr>
								</tbody>
							</table>
						</div>';
		}
	}else{
		$xhtml = '<h3>Chưa có đơn hàng nào!</h3>';
	}
?>

<!-- TITLE -->
<div class="title">
	<span class="title_icon"><img src="<?php echo $imageURL;?>/bullet1.gif"></span>History
</div>

<!-- LIST BOOKS -->
<div class="feat_prod_box_details">
	
	<?php echo $xhtml;?>
</div>


