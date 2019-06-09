
<?php
    $controller     = $this->arrParam['controller'];
    //NEW
    $linkNew    = URL::createLink('admin', $controller, 'form');
    $btnNew     = Helper::cmsButton('New','toolbar-popup-new',$linkNew, 'icon-32-new' );
  
    //Publish
    $linkPublish    = URL::createLink('admin', $controller, 'status', array('type' => 1));
    $btnPublish    = Helper::cmsButton('Publish','toolbar-publish',$linkPublish, 'icon-32-publish', 'submit' );
   
    //Unpublish
    $linkUnPublish   = URL::createLink('admin',$controller,  'status', array('type' => 0));
    $btnUnPublish    = Helper::cmsButton('Unpublish','toolbar-unpublish',$linkUnPublish, 'icon-32-unpublish', 'submit' );
   
    //Ordering
    $linkOrdering   = URL::createLink('admin', $controller, 'ordering',);
    $btnOrdering   = Helper::cmsButton('Ordering','toolbar-checkin',$linkOrdering, 'icon-32-checkin', 'submit' );
   
    //Trash
    $linkTrash   = URL::createLink('admin', $controller, 'trash');
    $btnTrash    = Helper::cmsButton('Trash','toolbar-trash', $linkTrash, 'icon-32-trash', 'submit' );
   
    //Save
    $linkSave   = URL::createLink('admin', $controller, 'form', array('type' => 'save'));
    $btnSave    = Helper::cmsButton('Save','toolbar-apply', $linkSave, 'icon-32-apply', 'submit' );
    
    //Save & Close
    $linkSaveClose   = URL::createLink('admin', $controller, 'form', array('type' => 'save-close'));
    $btnSaveClose    = Helper::cmsButton('Save & Close','toolbar-save', $linkSaveClose, 'icon-32-save', 'submit' );
    
    //Save & New
    $linkSaveNew   = URL::createLink('admin', $controller, 'form', array('type' => 'save-new'));
    $btnSaveNew    = Helper::cmsButton('Save & New','toolbar-save-new', $linkSaveNew, 'icon-32-save-new' , 'submit');
   
    //Cancel
    $linkCancel   = URL::createLink('admin', $controller, 'index');
    $btnCancel    = Helper::cmsButton('Cancel','toolbar-cancel', $linkCancel, 'icon-32-cancel' );

    
    
    switch($this->arrParam['action']){
        case 'index' :
            if($controller == 'group'){
                $strButton      =  $btnPublish . $btnUnPublish. $btnOrdering ;
            }else{
                $strButton      =  $btnNew  . $btnPublish . $btnUnPublish. $btnOrdering  . $btnTrash;
            }  
                break;
        case 'form' :  
             $strButton      =  $btnSave . $btnSaveClose  . $btnSaveNew . $btnCancel  ;
            break;
        case 'profile' :  
             $strButton      =  $btnSave . $btnSaveClose . $btnCancel  ;
            break;
    }
?>
<!-- TOOLBAR -->
<div id="toolbar-box">
    <div class="m">
        <!-- TITLE -->
        <div class="pagetitle icon-48-groups"><h2><?php echo $this->_title; ?></h2></div>
    </div>
</div>
<div class="toolbar-list" id="toolbar">
    <ul>
        <?php echo isset($strButton) ? $strButton : '';?>
        
    </ul>
    <div class="clr"></div>
</div>