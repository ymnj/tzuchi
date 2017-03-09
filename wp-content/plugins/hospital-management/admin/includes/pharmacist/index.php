<?php 
$role='pharmacist';
$user_object=new Hmgtuser();
	
$active_tab = isset($_GET['tab'])?$_GET['tab']:'pharmacistlist';
	?>


<div class="page-inner" style="min-height:1631px !important">
<div class="page-title">
		<h3><img src="<?php echo get_option( 'hmgt_hospital_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'hmgt_hospital_name' );?></h3>
	</div>
	<?php 
	if(isset($_POST['save_pharmacist']))
	{
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{
				
			$result=$user_object->hmgt_add_user($_POST);
			if($result)
			{
				wp_redirect ( admin_url() . 'admin.php?page=hmgt_pharmacist&tab=pharmacistlist&message=2');
			}
				
				
		}
		else
		{
			if( !email_exists( $_POST['email'] ) && !username_exists( $_POST['username'] )) {
					
				$result=$user_object->hmgt_add_user($_POST);
	
				if($result)
				{
					wp_redirect ( admin_url() . 'admin.php?page=hmgt_pharmacist&tab=pharmacistlist&message=1');
				}
			}
			else
				{?>
							<div id="message" class="updated below-h2">
							<p><?php _e('Username Or Emailid All Ready Exist.','hospital_mgt');?></p>
							</div>
							
		  <?php }
			}
			
	}
	
		
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
			{
				
				$result=$user_object->delete_usedata($_REQUEST['pharmacist_id']);
				if($result)
				{
					wp_redirect ( admin_url() . 'admin.php?page=hmgt_pharmacist&tab=pharmacistlist&message=3');
				}
			}
	if(isset($_REQUEST['message']))
	{
		$message =$_REQUEST['message'];
		if($message == 1)
		{?>
				<div id="message" class="updated below-h2 ">
				<p>
				<?php 
					_e('Record inserted successfully','hospital_mgt');
				?></p></div>
				<?php 
			
		}
		elseif($message == 2)
		{?><div id="message" class="updated below-h2 "><p><?php
					_e("Record updated successfully",'hospital_mgt');
					?></p>
					</div>
				<?php 
			
		}
		elseif($message == 3) 
		{?>
		<div id="message" class="updated below-h2"><p>
		<?php 
			_e('Record deleted successfully','hospital_mgt');
		?></div></p><?php
				
		}
	}
	?>
	<div id="main-wrapper">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-body">
	<h2 class="nav-tab-wrapper">
    	<a href="?page=hmgt_pharmacist&tab=pharmacistlist" class="nav-tab <?php echo $active_tab == 'pharmacistlist' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Pharmacist List', 'hospital_mgt'); ?></a>
    	
        <?php  if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
		{?>
        <a href="?page=hmgt_pharmacist&tab=addpharmacist&&action=edit&pharmacist_id=<?php echo $_REQUEST['pharmacist_id'];?>" class="nav-tab <?php echo $active_tab == 'addpharmacist' ? 'nav-tab-active' : ''; ?>">
		<?php _e('Edit pharmacist', 'hospital_mgt'); ?></a>  
		<?php 
		}
		else
		{?>
			<a href="?page=hmgt_pharmacist&tab=addpharmacist" class="nav-tab <?php echo $active_tab == 'addpharmacist' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-plus-alt"></span>'.__('Add New pharmacist', 'hospital_mgt'); ?></a>  
		<?php  }?>
       
    </h2>
     <?php 
	//Report 1 
	if($active_tab == 'pharmacistlist')
	{ ?>	
	  <script type="text/javascript">
$(document).ready(function() {
	jQuery('#pharmacist_list').DataTable({
		 "order": [[ 1, "asc" ]],
		 "aoColumns":[
	                  {"bSortable": false},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},	                             
	                  {"bSortable": false}	                 
	               ]
		 
		});
	
} );
</script>
    <form name="wcwm_report" action="" method="post">
    <div class="panel-body">
        	<div class="table-responsive">
        <table id="pharmacist_list" class="display" cellspacing="0" width="100%">
        	 <thead>
            <tr>
			<th style="width: 50px;height:50px;"><?php  _e( 'Photo', 'hospital_mgt' ) ;?></th>
              <th><?php _e( 'Pharmacist Name', 'hospital_mgt' ) ;?></th>
			  <th> <?php _e( 'Mobile No', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Pharmacist Email', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </thead>
		<tfoot>
            <tr>
			<th><?php  _e( 'Photo', 'hospital_mgt' ) ;?></th>
              <th><?php _e( 'Pharmacist Name', 'hospital_mgt' ) ;?></th>
			  <th> <?php _e( 'Mobile No', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Pharmacist Email', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
		//$pharmacistdata=get_usersdata('pharmacist');
		 $get_pharmacist = array('role' => 'pharmacist');
			$pharmacistdata=get_users($get_pharmacist);
		 if(!empty($pharmacistdata))
		 {
		 	foreach ($pharmacistdata as $retrieved_data){
		 ?>
            <tr>
				<td class="user_image"><?php $uid=$retrieved_data->ID;
				$userimage=get_user_meta($uid, 'hmgt_user_avatar', true);
							if(empty($userimage))
							{
								echo '<img src='.get_option( 'hmgt_pharmacist_thumb' ).' height="50px" width="50px" class="img-circle" />';
							}
							else	
							echo '<img src='.$userimage.' height="50px" width="50px" class="img-circle"/>';
				?></td>
                <td class="name"><a href="?page=hmgt_pharmacist&tab=addpharmacist&action=edit&pharmacist_id=<?php echo $retrieved_data->ID;?>"><?php echo $retrieved_data->display_name;?></a></td>
                <td class="class_name">
				<?php 
						echo get_user_meta($uid, 'mobile', true);
				?></td>
				
                <td class="email"><?php echo $retrieved_data->user_email;?></td>
               	<td class="action"> <a href="?page=hmgt_pharmacist&tab=addpharmacist&action=edit&pharmacist_id=<?php echo $retrieved_data->ID;?>" class="btn btn-info"> <?php _e('Edit', 'hospital_mgt' ) ;?></a>
                <a href="?page=hmgt_pharmacist&tab=pharmacistlist&action=delete&pharmacist_id=<?php echo $retrieved_data->ID;?>" class="btn btn-danger" 
                onclick="return confirm('<?php _e('Are you sure you want to delete this record?','hospital_mgt');?>');">
                <?php _e( 'Delete', 'hospital_mgt' ) ;?> </a>
                
                </td>
               
            </tr>
            <?php } 
			
		}?>
     
        </tbody>
        
        </table>
        </div>
        </div>
       
</form>
     <?php 
	 }
	
	if($active_tab == 'addpharmacist')
	 {
	require_once HMS_PLUGIN_DIR. '/admin/includes/pharmacist/add_pharmacist.php';
	 }
	 ?>
</div>
			
		</div>
	</div>
</div>


