<?php 
    include_once 'toolbar/index.php';
    include_once 'submenu/index.php';
    //Input
    $dataForm           = isset($this->arrParam['form']) ? $this->arrParam['form'] : null;
    $inputName          = Helper::cmsInput('text','form[name]','name',isset($dataForm['name']) ? $dataForm['name'] : '','inputbox required',40);
    $inputOrdering      = Helper::cmsInput('text','form[ordering]','ordering',isset($dataForm['ordering']) ? $dataForm['ordering'] : '','inputbox',40);
    $inputToken         = Helper::cmsInput('hidden','form[token]','token',time());
    $selectStatus       = Helper::cmsSelectbox('form[status]', null ,array('default' => ' - Select Status - ', 1 => 'Publish', 0 => 'Unpublish'), isset($dataForm['status']) ? $dataForm['status'] : '', 'width: 150px');
    $selectGroupACP     = Helper::cmsSelectbox('form[group_acp]', null ,array('default' => '-Select group acp- ', 1 => 'Yes', 0 => 'No'), isset($dataForm['group_acp']) ? $dataForm['group_acp'] : '', 'width: 150px');
   
    $inputID            = '';
    $rowID              = '';
    if(isset($this->arrParam['id'])){
        $inputID        = Helper::cmsInput('text','form[id]','id',$dataForm['id']);
        $rowID          = Helper::cmsRowForm('ID', $inputID);

    }
    //Row
    $rowName            = Helper::cmsRowForm('Name', $inputName, true);
    $rowOrdering        = Helper::cmsRowForm('Ordering', $inputOrdering);
    $rowStatus          = Helper::cmsRowForm('Status', $selectStatus);
    $rowGroupACP        = Helper::cmsRowForm('Group ACP', $selectGroupACP);

    //MESSAGE
    $message    =  Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);

   
?>

<div id="system-message-container"><?php echo $strMessage . (isset($this->errors) ? $this->errors : ''); ?> </div>
<div id="element-box">
    <div class="m">
        <form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
            <!-- FORM LEFT -->
            <div class="width-100 fltlft">
                <fieldset class="adminform">
                    <legend>Details</legend>
                    <ul class="adminformlist">
                       <?php echo $rowName . $rowStatus . $rowGroupACP . $rowOrdering . $rowID ; ?>
                       
                          
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





