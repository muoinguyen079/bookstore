<?php 
	$arrMenu	= array(
							array('Change Pass'	, 'changepass.png'	, URL::createLink('default', 'user', 'index')),
							array('View Cart'	, 'cart.png'		, URL::createLink('default', 'user', 'cart')),
							array('History'		, 'history.png'		, URL::createLink('default', 'user', 'history')),
							array('Logout'		, 'logout.png'		, URL::createLink('default', 'index', 'logout')),
					);
	
	$xhtml = '';
	foreach ($arrMenu as $value){
		$xhtml .= '<div class="new_prod_box">
					<a href="'.$value[2].'">'.$value[0].'</a>
					<div class="new_prod_bg">
						<a href="'.$value[2].'"><img class="thumb" src="'.$imageURL . DS . $value[1].'"></a>
					</div>
				</div>';
	}
?>

<div class="new_products">
	<?php echo $xhtml;?>
</div>