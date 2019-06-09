<?php
	
	
	
	$inputSubmit 	=	Helper::cmsInput('submit', 'form[submit]', 'submit', 'login', 'register');
	$inputToken 	=	Helper::cmsInput('hidden', 'form[token]', 'token', time());

	
	$rowPassword  	=	Helper::cmsRow('Password ', Helper::cmsInput('text', 'form[password]', 'password', null, 'contact_input'));
	$rowEmail  		=	Helper::cmsRow('Email ', 	Helper::cmsInput('text', 'form[email]', 'email', null, 'contact_input'));
	$rowSubmit  	=	Helper::cmsRow('Submit ',$inputToken .  $inputSubmit, true);

	$linkAction		=	URL::createLink('default', 'index', 'login');


?>


<div class="title"><span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet1.gif"/></span>ĐĂNG NHẬP</div>
	<div class="feat_prod_box_details">
	<p class="details">
	</p>
		<div class="contact_form">
		<div class="form_subtitle">Login</div>
		<?php echo isset($this->errors) ? $this->errors : '';	 ?>
			<form name="admin form" action="<?php echo $linkAction; ?>" method="POST">  
				<?php echo $rowEmail . $rowPassword .  $rowSubmit ; ?>    
			</form>     
		</div>  
	</div>  
            
<div class="clear"></div>