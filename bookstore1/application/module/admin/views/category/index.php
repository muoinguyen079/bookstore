
<?php   include_once (MODULE_PATH . 'admin/views/toolbar.php') ;
        include_once 'submenu/index.php' ;

    // COLUMN
    $columnPost     = isset($this->arrParam['filter_column']) ? $this->arrParam['filter_column'] : null;
    $orderPost      = isset($this->arrParam['filter_column_dir']) ? $this->arrParam['filter_column_dir'] : null;
    $lblName        = Helper::cmsLinkSort('Name', 'name',$columnPost, $orderPost );
    $lblPicture     = Helper::cmsLinkSort('Picture', 'picture',$columnPost, $orderPost );
    $lblStatus      = Helper::cmsLinkSort('Status', 'status',$columnPost, $orderPost );     
     
    $lblOrdering    = Helper::cmsLinkSort('Ordering', 'ordering',$columnPost, $orderPost );     
    $lblCreated     = Helper::cmsLinkSort('Created', 'created',$columnPost, $orderPost );     
    $lblCreatedBy   = Helper::cmsLinkSort('Created By', 'created_by',$columnPost, $orderPost );     
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified',$columnPost, $orderPost );     
    $lblModifiedBy  = Helper::cmsLinkSort('Modified By', 'modified_by',$columnPost, $orderPost );     
    $lblID          = Helper::cmsLinkSort('ID', 'id',$columnPost, $orderPost );    
    
    // SELECT
    $arrStatus          = array('default' => '- Select Status -', 1 => 'Publish',  0 => 'Unpublish',  );
    $selectboxStatus    = Helper::cmsSelectbox('filter_state','inputbox', $arrStatus, isset($this->arrParam['filter_state']) ? $this->arrParam['filter_state'] : null  );
    

    //Pagination
    $paginationHTML     = $this->pagination->showPagination(URL::createLink('admin', 'category', 'index'));

    //MESSAGE
    $message    =  Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);
    
?>
        <div id="system-message-container"><?php echo $strMessage; ?> </div>
            
        
        
		<div id="element-box">
			<div class="m">
				<form action="#" method="post" name="adminForm" id="adminForm">
                	<!-- FILTER -->
                    <fieldset id="filter-bar">
                        <div class="filter-search fltlft">
                            <label class="filter-search-lbl" for="filter_search">Filter:</label>
                            <input type="text" name="filter_search" id="filter_search" value="<?php echo isset($this->arrParam['filter_search']) ? $this->arrParam['filter_search'] : '' ; ?>">
                            <button type="submit" name="submit-keyword">Search</button>
                            <button type="button" name="clear-keyword">Clear</button>
                        </div>
                        <div class="filter-select fltrt">
                           <?php echo  $selectboxStatus;   ?>
                        </div>
                    </fieldset>
					<div class="clr"> </div>

                    <table class="adminlist" id="modules-mgr">
                    	<!-- HEADER TABLE -->
                        <thead>
                            <tr>
                                <th width="1%"><input type="checkbox" name="checkall-toggle"></th>
                                <th class="title"><?php echo $lblName;  ?></th>
                                <th width="10%"><?php   echo $lblPicture;  ?></th>
                                <th width="10%"><?php   echo $lblStatus;  ?></th>
                                
                                <th width="10%"><?php   echo $lblOrdering;  ?></th>
                                <th width="10%"><?php   echo $lblCreated;  ?></th>
                                <th width="10%"><?php   echo $lblCreatedBy;  ?></th>
                                <th width="10%"><?php   echo $lblModified;  ?></th>
                                <th width="10%"><?php   echo $lblModifiedBy;  ?></th>
                                <th width="1%" class="nowrap"><?php echo $lblID ;  ?></th>
                            </tr>
                        </thead>
                        <!-- FOOTER TABLE -->
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <!-- PAGINATION -->
                                    <div class="container">
                                      <?php echo $paginationHTML; ?>
                                    </div>				
                                </td>
                            </tr>
                        </tfoot>
                        <!-- BODY TABLE -->
						<tbody>
                            <?php
                                if(!empty($this->Items)){
                                    $i = 0;
                                    foreach($this->Items as $key => $value){
                                        $id         =  $value['id'];
                                        $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                        $name        = $value['name'];

                                        $picturePath    = UPLOAD_PATH . 'category' . DS . '60x90-' . $value['picture'];
                                        if(file_exists($picturePath) == true){
                                            $picture     = '<img src="'.UPLOAD_URL . 'category' . DS .  '60x90-' . $value['picture'].'">';
                                        }else{
                                            $picture	= '<img  src="'.UPLOAD_URL . 'category' . DS . '60x90-default.jpg' .'">';
                                        }
                                        //$picture     = '<img src="'.UPLOAD_URL . 'category' . DS .  '60x90-' . $value['picture'].'">';

                                        $row         = ($i % 2 == 0) ? 'row0' : 'row1';
                                        $status      = Helper::cmsStatus($value['status'], URL::createLink('admin','category', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);
                                       
                                        $odering     = '<input type="text" name="order['.$id.']" size="5" value="'.$value['ordering'].'"class="text-area-order">';
                                        $created     = Helper::formatDate('d-m-Y',$value['created']);
                                        $created_by  = $value['created_by'];
                                        $modified    = Helper::formatDate('d-m-Y',$value['modified']);
                                        $modified_by  = $value['modified_by'];
                                        $linkEdit  = URL::createLink('admin', 'category', 'form', array('id' => $id));
                                        
                            
                      
                                   echo  '<tr class="'.$row.'">
                                        <td class="center">'.$ckb.'</td>
                                        <td><a href="'.$linkEdit.'">'.$name.'</td>

                                        <td class="center">'.$picture.'</td>
                                        <td class="center">'.$status.'</td>
                                       
                                        <td class="center">'.$odering.'</td>
                                        <td class="center">'.$created.'</td>
                                        <td class="center">'.$created_by.'</td>
                                        <td class="center">'.$modified.'</td>
                                        <td class="center">'.$modified_by.'</td>
                                        <td class="center">'.$id.'</td>
                                    </tr>';
                        
                                    $i++;
                                }
                            }
                        ?>
						</tbody>
					</table>

                    <div>
                        <input type="hidden" name="filter_column" value="name">
                        <input type="hidden" name="filter_page" value="1">
                        <input type="hidden" name="filter_column_dir" value="asc">
                    </div>
                </form>

				<div class="clr"></div>
			</div>
		</div>
	</div>