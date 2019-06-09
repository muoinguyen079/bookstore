<?php 
    include_once (MODULE_PATH . 'admin/views/toolbar.php');
    include_once 'submenu/index.php';
    //Input
    $dataForm           = isset($this->arrParam['form']) ? $this->arrParam['form'] : null;
    $inputUserName      = Helper::cmsInput('text','form[username]','name',isset($dataForm['username']) ? $dataForm['username'] : '','inputbox required',40);
    $inputEmail         = Helper::cmsInput('text','form[email]','name',isset($dataForm['email']) ? $dataForm['email'] : '','inputbox required',40);
    $inputFullName      = Helper::cmsInput('text','form[fullname]','name',isset($dataForm['fullname']) ? $dataForm['fullname'] : '','inputbox',40);
    $inputPassword      = Helper::cmsInput('text','form[password]','name',isset($dataForm['password']) ? $dataForm['password'] : '','inputbox required',40);
    $inputOrdering      = Helper::cmsInput('text','form[ordering]','ordering',isset($dataForm['ordering']) ? $dataForm['ordering'] : '','inputbox',40);
    $inputToken         = Helper::cmsInput('hidden','form[token]','token',time());
    $slbStatus          = Helper::cmsSelectbox('form[status]', null ,array('default' => ' - Select Status - ', 1 => 'Publish', 0 => 'Unpublish'), isset($dataForm['status']) ? $dataForm['status'] : '', 'width: 150px');
    $slbGroup           = Helper::cmsSelectbox('form[group_id]','inputbox',$this->slbGroup,isset($dataForm['group_id']) ? $dataForm['group_id'] : '',null );
   
    $inputID            = '';
    $rowID              = '';
    if(isset($this->arrParam['id'])  || isset($dataForm['id']) ? $dataForm['id'] : '' ){
        $inputID            = Helper::cmsInput('text','form[id]','id',$dataForm['id'], 'inputbox readonly');
        $inputUserName      = Helper::cmsInput('text','form[username]','name',isset($dataForm['username']) ? $dataForm['username'] : '','inputbox readonly',40);

        $rowID              = Helper::cmsRowForm('ID', $inputID);

    }
    //Row
    $rowUserName        = Helper::cmsRowForm('UserName', $inputUserName, true);
    $rowEmail           = Helper::cmsRowForm('Email', $inputEmail, true);
    $rowFullName        = Helper::cmsRowForm('FullName', $inputFullName);
    $rowPassword        = Helper::cmsRowForm('Password', $inputPassword, true);
    $rowOrdering        = Helper::cmsRowForm('Ordering', $inputOrdering);
    $rowStatus          = Helper::cmsRowForm('Status', $slbStatus);
    $rowGroup           = Helper::cmsRowForm('Group', $slbGroup);

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
                       <?php echo $rowUserName .  $rowEmail . $rowFullName. $rowPassword  . $rowStatus . $rowGroup . $rowOrdering . $rowID ; ?>
                       
                          
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





