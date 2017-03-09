<?php 
	//This is Dashboard at admin side
	$obj_invoice= new Hmgtinvoice();
	?>
	<script type="text/javascript">

$(document).ready(function() {
	$('#invoice_form').validationEngine();
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
	
     <?php 	

	if($active_tab == 'addinvoice')
	 {
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
			<label class="col-sm-2 control-label" for="vat_percentage"><?php _e('Vat Percentage','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="vat_percentage" class="form-control validate[required] text-input" type="text" value="<?php if($edit){ echo $result->vat_percentage;}elseif(isset($_POST['vat_percentage'])) echo $_POST['vat_percentage'];?>" name="vat_percentage">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="discount"><?php _e('Discount Amount','hospital_mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="vat_percentage" class="form-control validate[required] text-input" type="text" value="<?php if($edit){ echo $result->discount;}elseif(isset($_POST['discount'])) echo $_POST['discount'];?>" name="discount">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="payment_status"><?php _e('Status','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<select name="payment_status" id="payment_status" class="form-control">
					<option value="Paid"
						<?php if($edit)selected('Paid',$result->status);?> class="validate[required]"><?php _e('Paid','hospital_mgt');?></option>
					<option value="Part Paid"
						<?php if($edit)selected('Part Paid',$result->status);?> class="validate[required]"><?php _e('Part Paid','hospital_mgt');?></option>
						<option value="Unpaid"
						<?php if($edit)selected('Unpaid',$result->status);?> class="validate[required]"><?php _e('Unpaid','hospital_mgt');?></option>
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
	 ?>