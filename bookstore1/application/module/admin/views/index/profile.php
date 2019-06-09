<?php 
    include_once (MODULE_PATH . 'admin/views/toolbar/index.php');
   
   
    
    //Input
    $dataForm           = isset($this->arrParam['form']) ? $this->arrParam['form'] : null;
    $inputFullName      = Helper::cmsInput('text','form[fullname]','name',isset($dataForm['fullname']) ? $dataForm['fullname'] : '','inputbox required',40);
    $inputEmail         = Helper::cmsInput('text','form[email]','name',isset($dataForm['email']) ? $dataForm['email'] : '','inputbox required',40);
   
  
    $inputID            = Helper::cmsInput('text','form[id]','id',$dataForm['id']);
    
   
    //Row
    $rowEmail           = Helper::cmsRowForm('Email', $inputEmail, true);
    $rowID              = Helper::cmsRowForm('ID', $inputID);
    $rowFullName        = Helper::cmsRowForm('FullName', $inputFullName);

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
                       <?php echo    $rowEmail . $rowFullName.  $rowID ; ?>
                       
                          
                    </ul>
                    <div class="clr"></div>
                    <div>
                        <!-- <?php echo $inputToken;   ?> -->
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





