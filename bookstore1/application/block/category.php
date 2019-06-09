<?php
	$model 	= new Model();
	//$cateID = '';
	if(isset($this->arrParam['category_id'])){
		$cateID	= $this->arrParam['category_id'];
	}
	
	$query	= "SELECT `id`, `name` FROM `".TBL_CATEGORY."` WHERE `status`  = 1 ORDER BY `ordering` ASC";

	$listCats	= $model->fetchAll($query);
	
    $xhtml		= '';
    $cateID     = '';
	if(!empty($listCats)){
		foreach($listCats as $key => $value){
			$link	= URL::createLink('default', 'book', 'list', array('category_id' => $value['id']));
			$name	 = $value['name'];
			if($cateID == $value['id']){
				$xhtml	.= '<li><a class="active" title="'.$name.'" href="'.$link.'">'.$name.'</a></li>';
			}else{
				$xhtml	.= '<li><a title="'.$name.'" href="'.$link.'">'.$name.'</a></li>';
			}
		}
	}
?>
<div class="right_box">

	<div class="title">
		<span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet5.gif" alt="" title="" /></span>Categories
	</div>

	<ul class="list">
		<?php echo $xhtml;?>
	</ul>
</div>
<div class="clear"></div>