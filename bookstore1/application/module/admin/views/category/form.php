<?php 
    include_once 'toolbar/index.php';
    include_once 'submenu/index.php';
    //Input
    $dataForm           = isset($this->arrParam['form']) ? $this->arrParam['form'] : null;
    $inputName          = Helper::cmsInput('text','form[name]','name',isset($dataForm['name']) ? $dataForm['name'] : '','inputbox required',40);
    $inputOrdering      = Helper::cmsInput('text','form[ordering]','ordering',isset($dataForm['ordering']) ? $dataForm['ordering'] : '','inputbox',40);
    $inputToken         = Helper::cmsInput('hidden','form[token]','token',time());
    $selectStatus       = Helper::cmsSelectbox('form[status]', null ,array('default' => ' - Select Status - ', 1 => 'Publish', 0 => 'Unpublish'), isset($dataForm['status']) ? $dataForm['status'] : '', 'width: 150px');
    $inputPicture       = Helper::cmsInput('file', 'picture', 'picture', isset($dataForm['picture']) ? $dataForm['picture'] : '', 'inputbox', 40);
    
    $inputID            = '';
    $rowID              = '';
    $picture            = '';
    $inputPictureHidden = '';

    if(isset($this->arrParam['id'])){
        $inputID            = Helper::cmsInput('text','form[id]','id',$dataForm['id']);
        $rowID              = Helper::cmsRowForm('ID', $inputID);
        $picture            = '<img src="'.UPLOAD_URL . 'category' . DS .  '60x90-' . $dataForm['picture'].'">';
		$inputPictureHidden	= Helper::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden', $dataForm['picture'], 'inputbox', 40);


    }
    //Row
    $rowName            = Helper::cmsRowForm('Name', $inputName, true);
    $rowOrdering        = Helper::cmsRowForm('Ordering', $inputOrdering);
    $rowStatus          = Helper::cmsRowForm('Status', $selectStatus);
    $rowPicture         = Helper::cmsRowForm('Picture', $inputPicture . $picture . $inputPictureHidden);
   

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
                       <?php echo $rowName . $rowStatus . $rowOrdering .  $rowPicture  .  $rowID ; ?>
                       
                          
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





