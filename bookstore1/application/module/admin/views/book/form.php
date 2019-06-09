<?php 
    include_once (MODULE_PATH . 'admin/views/toolbar.php');
    include_once 'submenu/index.php';
    //Input
    $dataForm           = isset($this->arrParam['form']) ? $this->arrParam['form'] : null;
    $inputName           = Helper::cmsInput('text','form[name]','name',isset($dataForm['name']) ? $dataForm['name'] : '','inputbox required',40);
    $inputDescription   = '<textarea name="form[description]">'.$dataForm['description'].'</textarea>'  ;
    $inputPrice         = Helper::cmsInput('text','form[price]','price',isset($dataForm['price']) ? $dataForm['price'] : '','inputbox required',40);
    $inputSaleOFF       = Helper::cmsInput('text','form[sale_off]','sale_off',isset($dataForm['sale_off']) ? $dataForm['sale_off'] : '','inputbox ',40);
    $inputOrdering      = Helper::cmsInput('text','form[ordering]','ordering',isset($dataForm['ordering']) ? $dataForm['ordering'] : '','inputbox',40);
    $inputToken         = Helper::cmsInput('hidden','form[token]','token',time());
    $slbStatus          = Helper::cmsSelectbox('form[status]', null ,array('default' => ' - Select Status - ', 1 => 'Publish', 0 => 'Unpublish'), isset($dataForm['status']) ? $dataForm['status'] : '', 'width: 150px');
    $slbSpecial          = Helper::cmsSelectbox('form[special]', null ,array('default' => ' - Select Special  - ', 1 => 'Yes', 0 => 'No'), isset($dataForm['special ']) ? $dataForm['special'] : '', 'width: 150px');
	$slbCategory		= Helper::cmsSelectbox('form[category_id]', 'inputbox', $this->slbCategory, isset($dataForm['category_id']) ? $dataForm['category_id'] : '' , 'width: 180px');
    $inputPicture       = Helper::cmsInput('file', 'picture', 'picture', isset($dataForm['picture']) ? $dataForm['picture'] : '', 'inputbox', 40);

    $inputID            = '';
    $rowID              = '';
    $picture            = '';
    $inputPictureHidden = '';
    if(isset($this->arrParam['id'])  || isset($dataForm['id']) ? $dataForm['id'] : '' ){
        $inputID            = Helper::cmsInput('text','form[id]','id',$dataForm['id'], 'inputbox readonly');
        $inputUserName      = Helper::cmsInput('text','form[username]','name',isset($dataForm['username']) ? $dataForm['username'] : '','inputbox readonly',40);
        $rowID              = Helper::cmsRowForm('ID', $inputID);
        $picture            = '<img src="'.UPLOAD_URL . 'book' . DS .  '98x150-' . $dataForm['picture'].'">';
		$inputPictureHidden	= Helper::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden', $dataForm['picture'], 'inputbox', 40);

    }
    //Row
    $rowName                  = Helper::cmsRowForm('Name', $inputName, true);
    $rowPicture              = Helper::cmsRowForm('Picture', $inputPicture . $picture . $inputPictureHidden);

    $rowDescription           = Helper::cmsRowForm('Description', $inputDescription);
    $rowPrice                 = Helper::cmsRowForm('Price', $inputPrice, true);
    $rowSaleOff               = Helper::cmsRowForm('Sale Off', $inputSaleOFF, true);
    $rowOrdering              = Helper::cmsRowForm('Ordering', $inputOrdering, true);
    $rowStatus                = Helper::cmsRowForm('Status', $slbStatus);
    $rowSpecial                = Helper::cmsRowForm('Special', $slbSpecial);
    $rowCategory              = Helper::cmsRowForm('Category ', $slbCategory);
    
    //MESSAGE
    $message    =  Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);

   
?>

<div id="system-message-container"><?php echo $strMessage . (isset($this->errors) ? $this->errors : ''); ?> </div>
<div id="element-box">
    <div class="m">
        <form action="#" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
            <!-- FORM LEFT -->
            <div class="width-100 fltlft">
                <fieldset class="adminform">
                    <legend>Details</legend>
                    <ul class="adminformlist">
                       <?php echo $rowName . $rowPicture .  $rowDescription . $rowPrice. $rowSaleOff  . $rowStatus . $rowSpecial  . $rowCategory . $rowOrdering . $rowID ; ?>
                       
                          
                    </ul>
                    <div class="clr"></div>
                    <div>
                        <?php echo $inputToken;   ?>
                    </div>
                </fieldset>
            </div>
            <div class="clr"></div>
            <div>
            </div>
        </form>
        <div class="clr"></div>
    </div>
</div>





