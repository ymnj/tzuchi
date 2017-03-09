<?php 
$obj_invoice= new Hmgtinvoice();
$active_tab=isset($_REQUEST['tab'])?$_REQUEST['tab']:'invoicelist';
	if(isset($_POST['save_invoice']))
	{
			if($_REQUEST['action']=='edit')
			{
			
				$result=$obj_invoice->hmgt_add_invoice($_POST);
				if($result)
				{
					wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=invoicelist&message=2');
				}
			
			
			}
			else
			{
				$result=$obj_invoice->hmgt_add_invoice($_POST);
					if($result)
					{
						wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=invoicelist&message=1');
					}
			}
		 	
		 
			 
			
			
			
	}
	//--------save income-------------
		if(isset($_POST['save_income']))
		{
			
			if($_REQUEST['action']=='edit')
			{
			
				$result=$obj_invoice->add_income($_POST);
				if($result)
				{
					wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=incomelist&message=2');
				}
			}
			else
			{
				$result=$obj_invoice->add_income($_POST);
				if($result)
				{
					wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=incomelist&message=1');
				}
			}
			
		}
		//--------save Expense-------------
		if(isset($_POST['save_expense']))
		{
			
			if($_REQUEST['action']=='edit')
			{
			
				$result=$obj_invoice->add_expense($_POST);
				if($result)
				{
					wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=expenselist&message=2');
				}
			}
			else
			{
				$result=$obj_invoice->add_expense($_POST);
				if($result)
				{
					wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=expenselist&message=1');
				}
			}
			
		}

	
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
		{
			
			
			if(isset($_REQUEST['invoice_id'])){
			$result=$obj_invoice->delete_invoice($_REQUEST['invoice_id']);
				if($result)
				{
					wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=invoicelist&message=3');
				}
			}
			if(isset($_REQUEST['income_id'])){
			$result=$obj_invoice->delete_income($_REQUEST['income_id']);
				if($result)
				{
					wp_redirect ( home_url() . '?dashboard=user&page=invoice&tab=incomelist&message=3');
				}
			}
			if(isset($_REQUEST['expense_id'])){
			$result=$obj_invoice->delete_expense($_REQUEST['expense_id']);
				if($result)
				{
					wp_redirect (  home_url() . '?dashboard=user&page=invoice&tab=expenselist&message=3');
				}
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
				_e("Record updated successfully.",'hospital_mgt');
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

<script type="text/javascript">
$(document).ready(function() {
	//jQuery('#invoice').DataTable();
	//jQuery('#income').DataTable();
	//jQuery('#expense').DataTable();
	$('#invoice_form').validationEngine();
	$('#income_form').validationEngine();
	$('#expense_form').validationEngine();	
	
	$('#invoice_date').datepicker({
		  changeMonth: true,
	        changeYear: true,
	        dateFormat: 'yy-mm-dd',
	        yearRange:'-65:+0',
	        onChangeMonthYear: function(year, month, inst) {
	            $(this).val(month + "/" + year);
	        }
                    
                }); 
} );
</script>
<!-- POP up code -->
<div class="popup-bg">
    <div class="overlay-content">
    <div class="modal-content">
    <div class="invoice_data">
     </div>
     
    </div>
    </div> 
    
</div>
<!-- End POP-UP Code -->
<div class="panel-body panel-white">
 <ul class="nav nav-tabs panel_tabs" role="tablist">
      <li class="<?php if($active_tab=='invoicelist'){?>active<?php }?>">
			<a href="?dashboard=user&page=invoice&tab=invoicelist" class="tab <?php echo $active_tab == 'invoicelist' ? 'active' : ''; ?>">
             <i class="fa fa-align-justify"></i> <?php _e('Invoice List', 'hospital_mgt'); ?></a>
          </a>
      </li>
       <li class="<?php if($active_tab=='addinvoice'){?>active<?php }?>">
		  <?php  if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && isset($_REQUEST['invoice_id']))
			{?>
			<a href="?dashboard=user&page=invoice&tab=addinvoice&action=edit&invoice_id=<?php if(isset($_REQUEST['invoice_id'])) echo $_REQUEST['invoice_id'];?>"" class="tab <?php echo $active_tab == 'addinvoice' ? 'active' : ''; ?>">
             <i class="fa fa"></i> <?php _e('Edit Invoice', 'hospital_mgt'); ?></a>
			 <?php }
			else
			{?>
				<a href="?dashboard=user&page=invoice&tab=addinvoice" class="tab <?php echo $active_tab == 'addinvoice' ? 'active' : ''; ?>">
				<i class="fa fa-plus-circle"></i> <?php _e('Add Invoice', 'hospital_mgt'); ?></a>
	  <?php } ?>
	  
	</li>
	<li class="<?php if($active_tab=='incomelist'){?>active<?php }?>">
			<a href="?dashboard=user&page=invoice&tab=incomelist" class="tab <?php echo $active_tab == 'incomelist' ? 'active' : ''; ?>">
             <i class="fa fa-align-justify"></i> <?php _e('Income List', 'hospital_mgt'); ?></a>
          </a>
      </li>
       <li class="<?php if($active_tab=='addincome'){?>active<?php }?>">
		  <?php  if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && isset($_REQUEST['invoice_id']))
			{?>
			<a href="?dashboard=user&page=invoice&tab=addincome&action=edit&income_id=<?php if(isset($_REQUEST['income_id'])) echo $_REQUEST['income_id'];?>"" class="tab <?php echo $active_tab == 'addincome' ? 'active' : ''; ?>">
             <i class="fa fa"></i> <?php _e('Edit Income', 'hospital_mgt'); ?></a>
			 <?php }
			else
			{?>
				<a href="?dashboard=user&page=invoice&tab=addincome" class="tab <?php echo $active_tab == 'addincome' ? 'active' : ''; ?>">
				<i class="fa fa-plus-circle"></i> <?php _e('Add Income', 'hospital_mgt'); ?></a>
	  <?php } ?>
	  
	</li>
	<li class="<?php if($active_tab=='expenselist'){?>active<?php }?>">
			<a href="?dashboard=user&page=invoice&tab=expenselist" class="tab <?php echo $active_tab == 'expenselist' ? 'active' : ''; ?>">
             <i class="fa fa-align-justify"></i> <?php _e('Expense List', 'hospital_mgt'); ?></a>
          </a>
      </li>
       <li class="<?php if($active_tab=='addexpense'){?>active<?php }?>">
		  <?php  if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && isset($_REQUEST['expense_id']))
			{?>
			<a href="?dashboard=user&page=invoice&tab=addexpense&action=edit&expense_id=<?php if(isset($_REQUEST['expense_id'])) echo $_REQUEST['expense_id'];?>"" class="tab <?php echo $active_tab == 'addexpense' ? 'active' : ''; ?>">
             <i class="fa fa"></i> <?php _e('Edit Expense', 'hospital_mgt'); ?></a>
			 <?php }
			else
			{?>
				<a href="?dashboard=user&page=invoice&tab=addexpense" class="tab <?php echo $active_tab == 'addexpense' ? 'active' : ''; ?>">
				<i class="fa fa-plus-circle"></i> <?php _e('Add Expense', 'hospital_mgt'); ?></a>
	  <?php } ?>
	  
	</li>
</ul>
<?php if($active_tab=='invoicelist'){?>
<script type="text/javascript">
$(document).ready(function() {
	jQuery('#tblinvoice').DataTable({
		
		 "aoColumns":[
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true}, 
	                  {"bSortable": true},                        
	                  {"bSortable": false}
	               ]
		});
		
	
} );
</script>
	<div class="tab-content">
    	 
		<div class="panel-body">
        <div class="table-responsive">
        <table id="tblinvoice" class="display dataTable" cellspacing="0" width="100%">
        	<thead>
            <tr>
			
              <th><?php _e( 'Title', 'hospital_mgt' ) ;?></th>
			  <th> <?php _e( 'Patient', 'hospital_mgt' ) ;?></th>
				
				
				<th> <?php _e( 'Vat Percentage', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Discount Amount', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Status', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
			
              <th><?php _e( 'Title', 'hospital_mgt' ) ;?></th>
			  <th> <?php _e( 'Patient', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Vat Percentage', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Discount Amount', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Status', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
		
		 	foreach ($obj_invoice->get_all_invoice_data() as $retrieved_data){ 
			
			
		 ?>
            <tr>
				
                <td class="title"><a href="?dashboard=user&page=invoice&tab=addinvoice&action=edit&invoice_id=<?php echo $retrieved_data->invoice_id;?>"><?php echo $retrieved_data->invoice_title; ?></a></td>
                <td class="patient"><?php echo $patient_id=get_user_meta($retrieved_data->patient_id, 'patient_id', true);?></td>
				<td class="vat_percentage"><?php echo $retrieved_data->vat_percentage;?></td>
				<td class="discount"><?php echo $retrieved_data->discount;?></td>
                <td class="email"><?php echo $retrieved_data->status;?></td>
                
               	<td class="action">
				<a  href="#" class="show-invoice-popup btn btn-default" idtest="<?php echo $retrieved_data->invoice_id; ?>" invoice_type="invoice">
				<i class="fa fa-eye"></i> <?php _e('View Invoice', 'hospital_mgt');?></a>
				<a href="?dashboard=user&page=invoice&tab=addinvoice&action=edit&invoice_id=<?php echo $retrieved_data->invoice_id;?>" class="btn btn-info"> <?php _e('Edit', 'hospital_mgt' ) ;?></a>
                <a href="?dashboard=user&page=invoice&tab=invoicelist&action=delete&invoice_id=<?php echo $retrieved_data->invoice_id;?>" class="btn btn-danger" 
                onclick="return confirm('<?php _e('Are you sure you want to delete this record?','hospital_mgt');?>');">
                <?php _e( 'Delete', 'hospital_mgt' ) ;?> </a>
                
                </td>
               
            </tr>
            <?php } 
			
		?>
     
        </tbody>
        
        </table>
        </div>
        </div>
<?php }
	if($active_tab == 'addinvoice'){
		$invoice_id=0;
			if(isset($_REQUEST['invoice_id']))
				$invoice_id=$_REQUEST['invoice_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
					
					$edit=1;
					$result = $obj_invoice->hmgt_get_invoice_data($invoice_id);
					
				
				}?>
		
       <div class="panel-body">
        <form name="invoice_form" action="" method="post" class="form-horizontal" id="invoice_form">
         <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<input type="hidden" name="invoice_id" value="<?php echo $invoice_id;?>">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="invoice_number"><?php _e('Invoice ID','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="invoice_number" class="form-control validate[required] text-input" type="text" readonly value="<?php if($edit){ echo $result->invoice_number;} else echo $obj_invoice->generate_invoce_number();?>" name="invoice_number" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="invice_title"><?php _e('Invoice Title','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="invice_title" class="form-control validate[required,custom[onlyLetterSp]] text-input" type="text" value="<?php if($edit){ echo $result->invoice_title;}elseif(isset($_POST['invice_title'])) echo $_POST['invice_title'];?>" name="invice_title">
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="patient"><?php _e('Patient','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				
				<?php if($edit){ $patient_id1=$result->patient_id; }elseif(isset($_POST['patient'])){$patient_id1=$_POST['patient'];}else{ $patient_id1="";}?>
				<select name="patient" class="form-control">
				<option value=""><?php _e('select Patient','hospital_mgt');?></option>
				<?php 
					
					$patients = hmgt_patientid_list();
					//print_r($patient);
					if(!empty($patients))
					{
					foreach($patients as $patient)
					{
						echo '<option value="'.$patient['id'].'" '.selected($patient_id1,$patient['id']).'>'.$patient['patient_id'].' - '.$patient['first_name'].' '.$patient['last_name'].'</option>';
					}
					}?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="vat_percentage"><?php _e('Total Amount','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="invoice_amount" class="form-control validate[required] text-input" type="text" value="<?php if($edit){ echo $result->invoice_amount;}elseif(isset($_POST['invoice_amount'])) echo $_POST['invoice_amount'];?>" name="invoice_amount">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="vat_percentage"><?php _e('Vat Percentage','hospital_mgt');?></label>
			<div class="col-sm-8">
				<input id="vat_percentage" class="form-control " type="text" value="<?php if($edit){ echo $result->vat_percentage;}elseif(isset($_POST['vat_percentage'])) echo $_POST['vat_percentage'];?>" name="vat_percentage">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="discount"><?php _e('Discount Amount','hospital_mgt');?></label>
			<div class="col-sm-8">
				<input id="vat_percentage" class="form-control " type="text" value="<?php if($edit){ echo $result->discount;}elseif(isset($_POST['discount'])) echo $_POST['discount'];?>" name="discount">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="payment_status"><?php _e('Status','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<select name="payment_status" id="payment_status" class="form-control validate[required]">
					<option value="Paid"
						<?php if($edit)selected('Paid',$result->status);?> ><?php _e('Paid','hospital_mgt');?></option>
					<option value="Part Paid"
						<?php if($edit)selected('Part Paid',$result->status);?>><?php _e('Part Paid','hospital_mgt');?></option>
						<option value="Unpaid"
						<?php if($edit)selected('Unpaid',$result->status);?> ><?php _e('Unpaid','hospital_mgt');?></option>
			</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="invoice_date"><?php _e('Date','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="invoice_date" class="form-control " type="text"  value="<?php if($edit){ echo $result->invoice_create_date;}elseif(isset($_POST['invoice_date'])){ echo $_POST['invoice_date'];}else{ echo date("Y-m-d");}?>" name="invoice_date">
			</div>
		</div>
		
		<div class="col-sm-offset-2 col-sm-8">
        	<input type="submit" value="<?php if($edit){ _e('Save Invoice','hospital_mgt'); }else{ _e('Create invoice Entry','hospital_mgt');}?>" name="save_invoice" class="btn btn-success"/>
        </div>
        </form>
        </div>
       <script>

   
   
   	
  
   	// CREATING BLANK INVOICE ENTRY
   	var blank_invoice_entry ='';
   	$(document).ready(function() { 
   		blank_invoice_entry = $('#invoice_entry').html();
   		//alert("hello" + blank_invoice_entry);
   	}); 

   	function add_entry()
   	{
   		$("#invoice_entry").append(blank_invoice_entry);
   		//alert("hellooo");
   	}
   	
   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
       </script> 
     <?php 
	 }
	if($active_tab == 'incomelist')
	 {
        	$invoice_id=0;
			if(isset($_REQUEST['income_id']))
				$invoice_id=$_REQUEST['income_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
					
					$edit=1;
					$result = $obj_invoice->hmgt_get_invoice_data($invoice_id);
				}?>
		  <script type="text/javascript">
$(document).ready(function() {
	jQuery('#tblincome').DataTable({
		 "order": [[ 3, "Desc" ]],
		 "aoColumns":[
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true}, 
	                                   
	                  {"bSortable": false}
	               ]
		});
		
	
} );
</script>
     <div class="panel-body">
        	<div class="table-responsive">
        <table id="tblincome" class="display dataTable" cellspacing="0" width="100%">
        	 <thead>
            <tr>
				<th> <?php _e( 'Patient Id', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Patient Name', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Amount', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Date', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th> <?php _e( 'Patient Id', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Patient Name', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Amount', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Date', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
		
		 	foreach ($obj_invoice->get_all_income_data() as $retrieved_data){ 
				$all_entry=json_decode($retrieved_data->income_entry);
				$total_amount=0;
				foreach($all_entry as $entry){
					$total_amount+=$entry->amount;
				}
		 ?>
            <tr>
				<td class="patient"><?php echo $patient_id=get_user_meta($retrieved_data->party_name, 'patient_id', true);?></td>
				<td class="patient_name"><?php $user=get_userdata($retrieved_data->party_name);
								echo $user->display_name;?></td>
				<td class="income_amount"><?php echo $total_amount;?></td>
                <td class="status"><?php echo $retrieved_data->income_create_date;?></td>
                
               	<td class="action">
				<a  href="#" class="show-invoice-popup btn btn-default" idtest="<?php echo $retrieved_data->income_id; ?>" invoice_type="income">
				<i class="fa fa-eye"></i> <?php _e('View Income', 'hospital_mgt');?></a>
				<a href="?dashboard=user&page=invoice&tab=addincome&action=edit&income_id=<?php echo $retrieved_data->income_id;?>" class="btn btn-info"> <?php _e('Edit', 'hospital_mgt' ) ;?></a>
                <a href="?dashboard=user&page=invoice&tab=incomelist&action=delete&income_id=<?php echo $retrieved_data->income_id;?>" class="btn btn-danger" 
                onclick="return confirm('<?php _e('Are you sure you want to delete this record?','hospital_mgt');?>');">
                <?php _e( 'Delete', 'hospital_mgt' ) ;?> </a>
                </td>
            </tr>
            <?php } 
			
		?>
     
        </tbody>
        
        </table>
        </div>
        </div>
	 <?php  }
		if($active_tab == 'addincome')
	 {
        	$income_id=0;
			if(isset($_REQUEST['income_id']))
				$income_id=$_REQUEST['income_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
					
					$edit=1;
					$result = $obj_invoice->hmgt_get_income_data($income_id);
					//var_dump($result);
				
				}?>
		
       <div class="panel-body">
        <form name="income_form" action="" method="post" class="form-horizontal" id="income_form">
         <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<input type="hidden" name="income_id" value="<?php echo $income_id;?>">
		<input type="hidden" name="invoice_type" value="income">
		
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="patient"><?php _e('Patient','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				
				<?php if($edit){ $patient_id1=$result->party_name; }elseif(isset($_POST['patient'])){$patient_id1=$_POST['patient'];}else{ $patient_id1="";}?>
				<select name="party_name" class="form-control validate[required]">
				<option value=""><?php _e('Select Patient','hospital_mgt');?></option>
				<?php 
					
					$patients = hmgt_patientid_list();
					//print_r($patient);
					if(!empty($patients))
					{
					foreach($patients as $patient)
					{
						echo '<option value="'.$patient['id'].'" '.selected($patient_id1,$patient['id']).'>'.$patient['patient_id'].' - '.$patient['first_name'].' '.$patient['last_name'].'</option>';
					}
					}?>
				</select>
			</div>
		</div>
		
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="payment_status"><?php _e('Status','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<select name="payment_status" id="payment_status" class="form-control validate[required]">
					<option value="Paid"
						<?php if($edit)selected('Paid',$result->payment_status);?> ><?php _e('Paid','hospital_mgt');?></option>
					<option value="Part Paid"
						<?php if($edit)selected('Part Paid',$result->payment_status);?> ><?php _e('Part Paid','hospital_mgt');?></option>
						<option value="Unpaid"
						<?php if($edit)selected('Unpaid',$result->payment_status);?>><?php _e('Unpaid','hospital_mgt');?></option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="invoice_date"><?php _e('Date','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="invoice_date" class="form-control validate[required]" type="text"  value="<?php if($edit){ echo $result->income_create_date;}elseif(isset($_POST['invoice_date'])){ echo $_POST['invoice_date'];}else{ echo date("Y-m-d");}?>" name="invoice_date">
			</div>
		</div>
		<hr>
		
		<?php 
			
			if($edit){
				$all_entry=json_decode($result->income_entry);
			}
			else
			{
				if(isset($_POST['income_entry'])){
					
					$all_data=$obj_invoice->get_entry_records($_POST);
					$all_entry=json_decode($all_data);
				}
				
					
			}
			if(!empty($all_entry))
			{
					foreach($all_entry as $entry){
					?>
					<div id="income_entry">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="income_entry"><?php _e('Income Entry','hospital_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-2">
							<input id="income_amount" class="form-control validate[required] text-input" type="text" value="<?php echo $entry->amount;?>" name="income_amount[]">
						</div>
						<div class="col-sm-4">
							<input id="income_entry" class="form-control validate[required] text-input" type="text" value="<?php echo $entry->entry;?>" name="income_entry[]">
						</div>						
						<div class="col-sm-2">
						<button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
						<i class="entypo-trash"><?php _e('Delete','hospital_mgt');?></i>
						</button>
						</div>
						</div>	
					</div>
					<?php }
				
			}
			else
			{?>
					<div id="income_entry">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="income_entry"><?php _e('Income Entry','hospital_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-2">
							<input id="income_amount" class="form-control validate[required] text-input" type="text" value="" name="income_amount[]" placeholder="Income Amount">
						</div>
						<div class="col-sm-4">
							<input id="income_entry" class="form-control validate[required] text-input" type="text" value="" name="income_entry[]" placeholder="Income Entry Label">
						</div>
						<div class="col-sm-2">
						<button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
						<i class="entypo-trash"><?php _e('Delete','hospital_mgt');?></i>
						</button>
						</div>
						</div>	
					</div>
					
		<?php }?>
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="income_entry"></label>
			<div class="col-sm-3">
				
				<button id="add_new_entry" class="btn btn-default btn-sm btn-icon icon-left" type="button"   name="add_new_entry" onclick="add_entry()"><?php _e('Add Income Entry','hospital_mgt'); ?>
				</button>
			</div>
		</div>
		<hr>
		<div class="col-sm-offset-2 col-sm-8">
        	<input type="submit" value="<?php if($edit){ _e('Save Income','hospital_mgt'); }else{ _e('Create Income Entry','hospital_mgt');}?>" name="save_income" class="btn btn-success"/>
        </div>
        </form>
        </div>
       <script>

   
   
   	
  
   	// CREATING BLANK INVOICE ENTRY
   	var blank_income_entry ='';
   	$(document).ready(function() { 
   		blank_income_entry = $('#income_entry').html();
   		//alert("hello" + blank_invoice_entry);
   	}); 

   	function add_entry()
   	{
   		$("#income_entry").append(blank_income_entry);
   		//alert("hellooo");
   	}
   	
   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
       </script> 
     <?php 
	 }
	 if($active_tab == 'expenselist')
	 {
        	$invoice_id=0;
			if(isset($_REQUEST['income_id']))
				$invoice_id=$_REQUEST['income_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
					
					$edit=1;
					$result = $obj_invoice->hmgt_get_invoice_data($invoice_id);
				}?>
		<script type="text/javascript">
$(document).ready(function() {
	jQuery('#tblexpence').DataTable({
		 "order": [[ 2, "Desc" ]],
		 "aoColumns":[
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  
	                                   
	                  {"bSortable": false}
	               ]
		});
		
	
} );
</script>
     <div class="panel-body">
        	<div class="table-responsive">
        <table id="tblexpence" class="display dataTable" cellspacing="0" width="100%">
        	 <thead>
            <tr>
				<th> <?php _e( 'Supplier Name', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Amount', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Date', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th> <?php _e( 'Supplier Name', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Amount', 'hospital_mgt' ) ;?></th>
				<th> <?php _e( 'Date', 'hospital_mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'hospital_mgt' ) ;?></th>
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
		
		 	foreach ($obj_invoice->get_all_expense_data() as $retrieved_data){ 
				$all_entry=json_decode($retrieved_data->income_entry);
				$total_amount=0;
				foreach($all_entry as $entry){
					$total_amount+=$entry->amount;
				}
		 ?>
            <tr>
				
				<td class="patient_name"><?php echo $retrieved_data->party_name;?></td>
				<td class="income_amount"><?php echo $total_amount;?></td>
                <td class="status"><?php echo $retrieved_data->income_create_date;?></td>
                
               	<td class="action">
				<a  href="#" class="show-invoice-popup btn btn-default" idtest="<?php echo $retrieved_data->income_id; ?>" invoice_type="expense">
				<i class="fa fa-eye"></i> <?php _e('View Expense', 'hospital_mgt');?></a>
				<a href="?dashboard=user&page=invoice&tab=addexpense&action=edit&expense_id=<?php echo $retrieved_data->income_id;?>" class="btn btn-info"> <?php _e('Edit', 'hospital_mgt' ) ;?></a>
                <a href="?dashboard=user&page=invoice&tab=expenselist&action=delete&expense_id=<?php echo $retrieved_data->income_id;?>" class="btn btn-danger" 
                onclick="return confirm('<?php _e('Are you sure you want to delete this record?','hospital_mgt');?>');">
                <?php _e( 'Delete', 'hospital_mgt' ) ;?> </a>
                </td>
            </tr>
            <?php } 
			
		?>
     
        </tbody>
        
        </table>
        </div>
        </div>
	 <?php  }
		if($active_tab == 'addexpense')
	 {
        	$expense_id=0;
			if(isset($_REQUEST['expense_id']))
				$expense_id=$_REQUEST['expense_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
					
					$edit=1;
					$result = $obj_invoice->hmgt_get_income_data($expense_id);
					//var_dump($result);
				
				}?>
		
       <div class="panel-body">
        <form name="expense_form" action="" method="post" class="form-horizontal" id="expense_form">
         <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<input type="hidden" name="expense_id" value="<?php echo $expense_id;?>">
		<input type="hidden" name="invoice_type" value="expense">
		
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="patient"><?php _e('Supplier Name','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="party_name" class="form-control validate[required] text-input" type="text" value="<?php if($edit){ echo $result->party_name;}elseif(isset($_POST['party_name'])) echo $_POST['party_name'];?>" name="party_name">
			</div>
		</div>
		
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="payment_status"><?php _e('Status','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<select name="payment_status" id="payment_status" class="form-control validate[required]">
					<option value="Paid"
						<?php if($edit)selected('Paid',$result->payment_status);?>  "><?php _e('Paid','hospital_mgt');?></option>
					<option value="Part Paid"
						<?php if($edit)selected('Part Paid',$result->payment_status);?>  "><?php _e('Part Paid','hospital_mgt');?></option>
						<option value="Unpaid"
						<?php if($edit)selected('Unpaid',$result->payment_status);?>  "><?php _e('Unpaid','hospital_mgt');?></option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="invoice_date"><?php _e('Date','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="invoice_date" class="form-control validate[required]" type="text"  value="<?php if($edit){ echo $result->income_create_date;}elseif(isset($_POST['invoice_date'])){ echo $_POST['invoice_date'];}else{ echo date("Y-m-d");}?>" name="invoice_date">
			</div>
		</div>
		<hr>
		
		<?php 
			
			if($edit){
				$all_entry=json_decode($result->income_entry);
			}
			else
			{
				if(isset($_POST['income_entry'])){
					
					$all_data=$obj_invoice->get_entry_records($_POST);
					$all_entry=json_decode($all_data);
				}
				
					
			}
			if(!empty($all_entry))
			{
					foreach($all_entry as $entry){
					?>
					<div id="expense_entry">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="income_entry"><?php _e('Expense Entry','hospital_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-2">
							<input id="income_amount" class="form-control validate[required] text-input" type="text" value="<?php echo $entry->amount;?>" name="income_amount[]">
						</div>
						<div class="col-sm-4">
							<input id="income_entry" class="form-control validate[required] text-input" type="text" value="<?php echo $entry->entry;?>" name="income_entry[]">
						</div>
						
						<div class="col-sm-2">
						<button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
						<i class="entypo-trash"><?php _e('Delete','hospital_mgt');?></i>
						</button>
						</div>
						</div>	
					</div>
					<?php }
				
			}
			else
			{?>
					<div id="expense_entry">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="income_entry"><?php _e('Expense Entry','hospital_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-2">
							<input id="income_amount" class="form-control validate[required] text-input" type="text" value="" name="income_amount[]" placeholder="Expense Amount">
						</div>
						<div class="col-sm-4">
							<input id="income_entry" class="form-control validate[required] text-input" type="text" value="" name="income_entry[]" placeholder="Expense Entry Label">
						</div>
						<div class="col-sm-2">
						<button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
						<i class="entypo-trash"><?php _e('Delete','hospital_mgt');?></i>
						</button>
						</div>
						</div>	
					</div>
					
		<?php }?>
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="expense_entry"></label>
			<div class="col-sm-3">
				
				<button id="add_new_entry" class="btn btn-default btn-sm btn-icon icon-left" type="button"   name="add_new_entry" onclick="add_entry()"><?php _e('Add Expense Entry','hospital_mgt'); ?>
				</button>
			</div>
		</div>
		<hr>
		<div class="col-sm-offset-2 col-sm-8">
        	<input type="submit" value="<?php if($edit){ _e('Save Expense','hospital_mgt'); }else{ _e('Create Expense Entry','hospital_mgt');}?>" name="save_expense" class="btn btn-success"/>
        </div>
        </form>
        </div>
       <script>

   
   
   	
  
   	// CREATING BLANK INVOICE ENTRY
   	var blank_income_entry ='';
   	$(document).ready(function() { 
   		blank_expense_entry = $('#expense_entry').html();
   		//alert("hello" + blank_invoice_entry);
   	}); 

   	function add_entry()
   	{
   		$("#expense_entry").append(blank_expense_entry);
   		//alert("hellooo");
   	}
   	
   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
       </script> 
     <?php 
	 }
	 ?>
	

	</div>
</div>

<?php ?>