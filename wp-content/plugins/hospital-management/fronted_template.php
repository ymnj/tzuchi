<?php
require_once(ABSPATH.'wp-admin/includes/user.php' );
$obj_hospital = new Hospital_Management(get_current_user_id());
if (! is_user_logged_in ()) {
	$page_id = get_option ( 'hmgt_login_page' );
	
	wp_redirect ( home_url () . "?page_id=" . $page_id );
}
if (is_super_admin ()) {
	wp_redirect ( admin_url () . 'admin.php?page=hospital' );
}
//var_dump($obj_hospital->patient);
//echo "patient =>".count($obj_hospital->patient);
//echo "<BR>";
//echo "Appointment => ".count($obj_hospital->appointment);
//echo "<BR>";
//echo "Event => ".count($obj_hospital->events);
//echo "<BR>";
//echo "notice => ".count($obj_hospital->notice);
$appointment_data = $obj_hospital->appointment;
$appointment_array = array ();
if (! empty ( $appointment_data )) {
	foreach ( $appointment_data as $appointment ) {
		$patient_data =	get_user_detail_byid($appointment->patient_id);
		$patient_name = $patient_data['first_name']." ".$patient_data['last_name']."(".$patient_data['patient_id'].")";
		$doctor_data =	get_user_detail_byid($appointment->doctor_id);
		$doctor_name = $doctor_data['first_name']." ".$doctor_data['last_name'];
		$appointment_start_date=date('Y-m-d H:i:s',strtotime($appointment->appointment_time_string));
		//$appointment_date=$appointment->appointment_time_string;
		$appointment_enddate = date('Y-m-d H:i:s',strtotime($appointment_start_date) + 900);
		$i=1;
			
		$appointment_array [] = array (
				'title' =>'Detail',
				'start' => $appointment_start_date,
				'end' =>$appointment_enddate,
				'patient_name' =>$patient_name,
				'doctor_name' =>$doctor_name
		);
			
	}
}
//echo json_encode($appointment_array);
//var_dump($obj_hospital->patient);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/dataTables.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/dataTables.editor.min.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/dataTables.tableTools.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/jquery-ui.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/font-awesome.min.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/popup.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/style.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/custom.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/fullcalendar.css'; ?>">

<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/bootstrap.min.css'; ?>">	
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/bootstrap-timepicker.min.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/bootstrap-multiselect.css'; ?>">	
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/white.css'; ?>">
    
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/hospitalmgt.min.css'; ?>">
<?php  if (is_rtl())
		 {?>
			<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/bootstrap-rtl.min.css'; ?>">
		<?php  } ?>

<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/simple-line-icons.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/lib/validationEngine/css/validationEngine.jquery.css'; ?>">
<link rel="stylesheet"	href="<?php echo HMS_PLUGIN_URL.'/assets/css/hospital-responsive.css'; ?>">


<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/jquery-1.11.1.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/jquery-ui.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/moment.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/fullcalendar.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/jquery.dataTables.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/dataTables.tableTools.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/dataTables.editor.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/bootstrap.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/bootstrap-timepicker.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/bootstrap-multiselect.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/assets/js/responsive-tabs.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/lib/validationEngine/js/languages/jquery.validationEngine-en.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo HMS_PLUGIN_URL.'/lib/validationEngine/js/jquery.validationEngine.js'; ?>"></script>
<script>
jQuery(document).ready(function() {
	
	jQuery('#calendar').fullCalendar({
			 header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
			editable: false,
			slotDuration:'00:15:00',			
			events:<?php echo json_encode($appointment_array);?>,
			eventRender: function(event, element) { 
	                        element.find('.fc-title').append(" Doctor :" + event.doctor_name +" Patient :" + event.patient_name + ", "); 
	                    } 
			
		});

		 
	});
</script>

</head>
<body class="hospital-management-content">
  <?php
		$user = wp_get_current_user ();
		?>
  <div class="container-fluid mainpage">
  <div class="navbar">
	
	<div class="col-md-8 col-sm-8 col-xs-6">
		<h3><img src="<?php echo get_option( 'hmgt_hospital_logo' ) ?>" class="img-circle head_logo" width="40" height="40" />
		<span><?php echo get_option( 'hmgt_hospital_name' );?></span>
		</h3></div>
		
		<ul class="nav navbar-right col-md-4 col-sm-4 col-xs-6">
				
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown"><a data-toggle="dropdown"
					class="dropdown-toggle" href="javascript:;">
						<?php
						$userimage = get_user_meta( $user->ID,'hmgt_user_avatar',true );
						if (empty ( $userimage )){
							echo '<img src='.get_default_userprofile($obj_hospital->role).' height="40px" width="40px" class="img-circle" />';
						}
						else	
							echo '<img src=' . $userimage . ' height="40px" width="40px" class="img-circle"/>';
						?>
							<span>	<?php echo $user->display_name;?> </span> <b class="caret"></b>
				</a>
					<ul class="dropdown-menu extended logout">
						<li><a href="?dashboard=user&page=account"><i class="fa fa-user"></i>
								<?php _e('My Profile','hospital_mgt');?></a></li>
						<li><a href="<?php echo wp_logout_url(home_url()); ?>"><i
								class="fa fa-sign-out m-r-xs"></i><?php _e('Log Out','hospital_mgt');?> </a></li>
					</ul></li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
	
	</div>
	</div>
	<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2 nopadding hospital_left">
			<!--  Left Side -->
 <?php
	
	$menu = hmgt_menu();
	
	$class = "";
	if (! isset ( $_REQUEST ['page'] ))	
		$class = 'class = "active"';
		 //print_r($menu); 	?>
  <ul class="nav nav-pills nav-stacked">
				<li><a href="<?php echo site_url();?>"><span class="icone"><img src="<?php echo plugins_url( 'hospital-management/assets/images/icon/home.png' )?>"/></span><span class="title"><?php _e('Home','hospital_mgt');?></span></a></li>
				<li <?php echo $class;?>><a href="?dashboard=user"><span class="icone"><img src="<?php echo plugins_url( 'hospital-management/assets/images/icon/dashboard.png' )?>"/></span><span
						class="title"><?php _e('Dashboard','hospital_mgt');?></span></a></li>
        <?php
								
								 $role = $obj_hospital->role;
								foreach ( $menu as $value ) {
									if ( isset($value[$role]) &&  $value[$role]) {
										if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $value ['page_link'])
											$class = 'class = "active"';
										else
											$class = "";
										echo '<li ' . $class . '><a href="?dashboard=user&page=' . $value ['page_link'] . '" class="left-tooltip" data-tooltip="'. $value ['menu_title'] . '" title="'. $value ['menu_title'] . '"><span class="icone"> <img src="' .$value ['menu_icone'].'" /></span><span class="title">'. $value ['menu_title'] . '</span></a></li>';
									}
									?>
									
        
        <?php
								}
								?>
								
      </ul>
		</div>
		<div class="page-inner" style="min-height:1050px;">
		<div class="right_side <?php if(isset($_REQUEST['page']))echo $_REQUEST['page'];?>">
		   <?php
		
		if (isset ( $_REQUEST ['page'] )) {
			require_once HMS_PLUGIN_DIR . '/template/' . $_REQUEST['page'] . '.php';
			return false;
		}
		
		?>
		<!---start new dashboard------>
			<div class="row">
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">			
			<a href="<?php echo home_url().'?dashboard=user&page=patient';?>">			
				<div class="panel info-box panel-white">
					<div class="panel-body patient">
						<div class="info-box-stats">
							<p class="counter"><?php echo count(get_users(array('role'=>'patient')));?></p>
							
							<span class="info-box-title"><?php echo esc_html( __( 'Patient', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/patient.png"?>" class="dashboard_background">
                        
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">			
			<a href="<?php echo home_url().'?dashboard=user&page=doctor';?>">			
				<div class="panel info-box panel-white">
					<div class="panel-body doctor">
						<div class="info-box-stats">
							<p class="counter"><?php echo count(get_users(array('role'=>'doctor')));?></p>
							<span class="info-box-title"><?php echo esc_html( __( 'Doctor', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/doctor.png"?>" class="dashboard_background">
                        
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=nurse';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body nurse">
						<div class="info-box-stats">
							<p class="counter"><?php echo count(get_users(array('role'=>'nurse')));?></p>
							<span class="info-box-title"><?php echo esc_html( __( 'Nurse', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/nurse.png"?>" class="dashboard_background">
                        
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=supportstaff';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body receptionist">
						<div class="info-box-stats">
							<p class="counter"><?php echo count(get_users(array('role'=>'receptionist')));?></p>
							
							<span class="info-box-title"><?php echo esc_html( __( 'Support Staff', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/support-staft.png"?>" class="dashboard_background">
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=message&tab=inbox';?>">	
				<div class="panel info-box panel-white">
					<div class="panel-body message">
						<div class="info-box-stats">
							<p class="counter"><?php 
							$obj_message = new Hmgt_message();
							$message = $obj_message->hmgt_count_inbox_item(get_current_user_id());
							echo count($message);
							?></p>
							
							<span class="info-box-title"><?php echo esc_html( __( 'Message', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/message.png"?>" class="dashboard_background">
						
					</div>
				</div>
			</a>
			</div>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=account';?>">	
				<div class="panel info-box panel-white">
					<div class="panel-body setting">
						<div class="info-box-stats">
							<p class="counter"> &nbsp;<?php //echo count(get_users(array('role'=>'laboratorist')));?></p>
							<span class="info-box-title"><?php echo esc_html( __( 'Setting', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/setting-image.png"?>" class="dashboard_background">
					</div>
				</div>
				</a>
			</div>
			
			<?php  if($obj_hospital->role == 'nurse' || $obj_hospital->role == 'doctor') {?>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=appointment';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body appointment">
						<div class="info-box-stats">
							<p class="counter"><?php hmgt_tables_rows('hmgt_appointment');?></p>
							<span class="info-box-title"><?php echo esc_html( __( 'Appointment', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/appointment-image.png"?>" class="dashboard_background">
					</div>
				</div>
			</a>
			</div>
			
			<?php } 
			if($obj_hospital->role == 'doctor') {?>
						<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
						<a href="<?php echo home_url().'?dashboard=user&page=prescription';?>">
							<div class="panel info-box panel-white">
								<div class="panel-body prescription">
									<div class="info-box-stats">
										<p class="counter"><?php hmgt_tables_rows('hmgt_priscription');?></p>
										
										<span class="info-box-title"><?php echo esc_html( __( 'Prescription', 'hospital_mgt' ) );?></span>
									</div>
									 <img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/preseription-image.png"?>" class="dashboard_background"> 
									
								</div>
							</div>
							</a>
						</div>
						<?php  } 

						if($obj_hospital->role == 'nurse' || $obj_hospital->role == 'doctor') {?>
									<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
									<a href="<?php echo home_url().'?dashboard=user&page=bedallotment&tab=bedassign';?>">
										<div class="panel info-box panel-white">
											<div class="panel-body assignbed">
												<div class="info-box-stats">
													<p class="counter"><?php hmgt_tables_rows('hmgt_bed_allotment');?></p>
													
													<span class="info-box-title"><?php echo _e( __( 'Assign <BR> Bed/Nurse', 'hospital_mgt' ) );?></span>
												</div>
												 <img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/assign-bed-image.png"?>" class="dashboard_background">   
												
											</div>
										</div>
									</a>
									</div>
									<?php }
									
									if($obj_hospital->role == 'doctor') {?>
												<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
												<a href="<?php echo home_url().'?dashboard=user&page=treatment';?>">
													<div class="panel info-box panel-white">
														<div class="panel-body treatment">
															<div class="info-box-stats">
																<p class="counter"><?php hmgt_tables_rows('hmgt_treatment');?></p>
																
																<span class="info-box-title"><?php echo esc_html( __( 'Treatment', 'hospital_mgt' ) );?></span>
															</div>
															  <img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/tretment-image.png"?>" class="dashboard_background">
															
														</div>
													</div>
													</a>
												</div>
												 <?php }
												 if($obj_hospital->role == 'pharmacist' || $obj_hospital->role == 'doctor') {?>
												 			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
												 			<a href="<?php echo home_url().'?dashboard=user&page=event';?>">
												 				<div class="panel info-box panel-white">
												 					<div class="panel-body eventnotice">
												 						<div class="info-box-stats">
												 							<p class="counter">
												 							<?php 
												 							$args['post_type'] = array('hmgt_event','hmgt_notice');
												 							$args['posts_per_page'] = -1;
												 							$args['post_status'] = 'public';
												 							$q = new WP_Query();
												 							$retrieve_class = $q->query( $args );
												 								echo count($retrieve_class);
												 							?></p>
												 							
												 							<span class="info-box-title"><?php echo _e( __( 'Events/ <BR> Notice', 'hospital_mgt' ) );?></span>
												 						</div>
												 						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/notice-event-image.png"?>" class="dashboard_background">
												 						
												 					</div>
												 				</div>
												 			</a>
												 			</div>
												 			<?php } 
			

			 if($obj_hospital->role == 'doctor') {?>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=report';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body operation_report">
						<div class="info-box-stats">
							<p class="counter">&nbsp;</p>
							
							<span class="info-box-title"><?php echo esc_html( __( 'Report', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/report.png"?>" class="dashboard_background">
					</div>
				</div>
				</a>
			</div>
			<?php } ?>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=pharmacist';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body pharmacist">
						<div class="info-box-stats">
							<p class="counter"><?php echo count(get_users(array('role'=>'pharmacist')));?></p>
							
							<span class="info-box-title"><?php echo esc_html( __( 'Pharmacist', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/pharmacist.png"?>" class="dashboard_background">
					</div>
				</div>
			</div>
			<?php 
			if($obj_hospital->role == 'pharmacist') {?>
						<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
						<a href="<?php echo home_url().'?dashboard=user&page=medicine';?>">
							<div class="panel info-box panel-white">
								<div class="panel-body medicine">
									<div class="info-box-stats">
										<p class="counter"><?php hmgt_tables_rows('hmgt_medicine');?></p>
										
										<span class="info-box-title"><?php echo esc_html( __( 'Medicine', 'hospital_mgt' ) );?></span>
									</div>
									<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/medicine.png"?>" class="dashboard_background"> 
								</div>
							</div>
							</a>
						</div>
						<?php } 
						?>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=laboratorystaff';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body laboratorist">
						<div class="info-box-stats">
							<p class="counter"><?php echo count(get_users(array('role'=>'laboratorist')));?></p>
							
							<span class="info-box-title"><?php echo _e( __( 'Laboratory <BR> Staff', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/laboratorist.png"?>" class="dashboard_background">
					</div>
				</div>
			</div>
			<?php 
			if($obj_hospital->role == 'doctor' || $obj_hospital->role == 'laboratorist') {?>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=diagnosis';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body diagnosis">
						<div class="info-box-stats">
							<p class="counter"><?php hmgt_tables_rows('hmgt_diagnosis');?></p>
							
							<span class="info-box-title"><?php echo _e( __( 'Diagnosis <BR> Report', 'hospital_mgt' ) );?></span>
						</div>
						<img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/diagnosis-image.png"?>" class="dashboard_background">
						
					</div>
				</div>
			</a>
			</div>
		<?php }?>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=accountant';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body accountant">
						<div class="info-box-stats">
							<p class="counter"><?php echo count(get_users(array('role'=>'accountant')));?></p>
							<span class="info-box-title"><?php echo esc_html( __( 'Accountant', 'hospital_mgt' ) );?></span>
						</div>
						 <img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/accountant.png"?>" class="dashboard_background">
                        
					</div>
				</div>
				</a>
			</div>
			<?php if($obj_hospital->role == 'accountant') {?>
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo home_url().'?dashboard=user&page=invoice';?>">
				<div class="panel info-box panel-white">
					<div class="panel-body invoice">
						<div class="info-box-stats">
							<p class="counter"><?php hmgt_tables_rows('hmgt_invoice');?></p>
							
							<span class="info-box-title"><?php echo esc_html( __( 'Invoice', 'hospital_mgt' ) );?></span>
						</div>
						 <img src="<?php echo HMS_PLUGIN_URL."/assets/images/dashboard/invoice.png"?>" class="dashboard_background"> 
					</div>
				</div>
				</a>
			</div>
			<?php } 
			
			?>
			
			
			
		</div>
	
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-white">
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<!--  Start Event Box -->
				<div class="panel panel-white">
					<div class="panel-heading">
						<h3 class="panel-title"><?php _e('Events','hospital_mgt');?></h3>						
					</div>
					<div class="panel-body">
						<div class="events">
						<?php
						if(!empty($obj_hospital->events))
						foreach ($obj_hospital->events as $retrieved_data){ ?>						
							<div class="calendar-event"> 
								<p>	<?php echo $retrieved_data->post_title;?> 	</p>
								<p>	<?php echo "<b>". __('Start Date: ','hospital_mgt')."</b>". get_post_meta($retrieved_data->ID,'start_date',true);?>	</p>								
								<p>	<?php echo "<b>". __('End Date: ','hospital_mgt')."</b>". get_post_meta($retrieved_data->ID,'end_date',true);?>	</p> 
							</div>						
						<?php }
						else 
						{?>
						<div class="calendar-event"> 
								<p>	<?php _e('No Event Found','hospital_mgt');?> 	</p>
								
							</div>	
						<?php }?>
						</div>
					</div>
				</div>
				<!-- End Event Box -->
				<!--  Start Notice box -->
				<div class="panel panel-white">
					<div class="panel-heading">
						<h3 class="panel-title"><?php _e('Notice','hospital_mgt');?></h3>						
					</div>
					<div class="panel-body">
						<div class="events">
						<?php		
						if(!empty($obj_hospital->notice))
						foreach ($obj_hospital->notice as $retrieved_data){ ?>					
							<div class="calendar-event"> 
								<p>	<?php echo $retrieved_data->post_title;?> 	</p>			
							</div>						
						<?php }
						else 
						{?>
						<div class="calendar-event"> 
								<p>	<?php _e('No Notice Found','hospital_mgt');?> 	</p>
								
							</div>	
						<?php }?>
						</div>
					</div>
				</div>
				<!--  End Notice box -->
			</div>
			
		</div>	
		<!---End new dashboard------>
		
 	
		
		
		</div>
		</div>
		
	</div>

</div>


</body>
</html>

<?php  ?>