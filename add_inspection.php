<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
$job_id = filter_input(INPUT_GET, 'job_id', FILTER_VALIDATE_INT);





//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    // $data_to_store = array_filter($_POST);

    //Insert timestamp
    // $data_to_store['date'] = date('Y-m-d H:i:s');
    //   $data_to_store['job_id'] = $job_id;

    $data_to_store = Array ('job_id' => $job_id,
    'date' => date('Y-m-d H:i:s'),
    'vin' => $_POST['vin'],
    'plate' => $_POST['plate'],
    'odo_in' => $_POST['odo_in'],
    'odo_out' => $_POST['odo_out']
  );

  $data_powertrain = Array ('job_id' => $job_id,
  'powertrain' => $_POST['powertrain'],
  'powertrain_comments' => $_POST['powertrain_comments']
);

$data_suspension = Array ('job_id' => $job_id,
'suspension' => $_POST['suspension'],
'suspension_comments' => $_POST['suspension_comments']
);

$data_brake = Array ('job_id' => $job_id,
'brake' => $_POST['brake'],
'lfp' => $_POST['lfp'],
'rfp' => $_POST['rfp'],
'lrp' => $_POST['lrp'],
'rrp' => $_POST['rrp'],
'frod' => $_POST['frod'],
'rrod' => $_POST['rrod'],
'fbs' => $_POST['fbs'],
'rbs' => $_POST['rbs'],
'lfp_inner' => $_POST['lfp_inner'],
'lfp_outer' => $_POST['lfp_outer'],
'lfp_com' => $_POST['lfp_com'],
'rfp_inner' => $_POST['rfp_inner'],
'rfp_outer' => $_POST['rfp_outer'],
'rfp_com' => $_POST['rfp_com'],
'lrp_inner' => $_POST['lrp_inner'],
'lrp_outer' => $_POST['lrp_outer'],
'lrp_com' => $_POST['lrp_com'],
'rrp_inner' => $_POST['rrp_inner'],
'rrp_outer' => $_POST['rrp_outer'],
'rrp_com' => $_POST['rrp_com'],
'frod_left' => $_POST['frod_left'],
'frod_right' => $_POST['frod_right'],
'frod_com' => $_POST['frod_com'],
'rrod_left' => $_POST['rrod_left'],
'rrod_right' => $_POST['rrod_right'],
'rrod_com' => $_POST['rrod_com'],
'fbs_left' => $_POST['fbs_left'],
'fbs_right' => $_POST['fbs_right'],
'fbs_com' => $_POST['fbs_com'],
'rbs_left' => $_POST['rbs_left'],
'rbs_right' => $_POST['rbs_right'],
'rbs_com' => $_POST['rbs_com']
);

$data_steering = Array ('job_id' => $job_id,
'steering' => $_POST['steering'],
'steering_comments' => $_POST['steering_comments']
);

$data_iaae = Array ('job_id' => $job_id,
'iaae' => $_POST['iaae'],
'iaae_comments' => $_POST['iaae_comments']
);

$data_lamp = Array ('job_id' => $job_id,
'lamp' => $_POST['lamp'],
'lamp_comments' => $_POST['lamp_comments']
);

$data_electrical = Array ('job_id' => $job_id,
'electrical' => $_POST['electrical'],
'electrical_comments' => $_POST['electrical_comments']
);

$data_body = Array ('job_id' => $job_id,
'body' => $_POST['body'],
'body_comments' => $_POST['body_comments'],
'tint' => $_POST['tint'],
'tint_com' => $_POST['tint_com']
);

$data_tire = Array ('job_id' => $job_id,
'tire' => $_POST['tire'],
'tire_comments' => $_POST['tire_comments'],
'ftd' => $_POST['ftd'],
'ftd_left' => $_POST['ftd_left'],
'ftd_right' => $_POST['ftd_right'],
'ftd_com' => $_POST['ftd_com'],
'rtd' => $_POST['rtd'],
'rtd_left' => $_POST['rtd_left'],
'rtd_right' => $_POST['rtd_right'],
'rtd_com' => $_POST['rtd_com'],
'tpfl_after' => $_POST['tpfl_after'],
'tpfl_before' => $_POST['tpfl_before'],
'tpfl_com' => $_POST['tpfl_com'],
'tpfr_after' => $_POST['tpfr_after'],
'tpfr_before' => $_POST['tpfr_before'],
'tpfr_com' => $_POST['tpfr_com'],
'tprl_after' => $_POST['tprl_after'],
'tprl_before' => $_POST['tprl_before'],
'tprl_com' => $_POST['tprl_com'],
'tprr_after' => $_POST['tprr_after'],
'tprr_before' => $_POST['tprr_before'],
'tprr_com' => $_POST['tprr_com']
);

$data_coupling = Array ('job_id' => $job_id,
'coupling' => $_POST['coupling'],
'coupling_comments' => $_POST['coupling_comments']
);

$data_road = Array ('job_id' => $job_id,
'road_test' => $_POST['road_test'],
'road_comments' => $_POST['road_comments'],
'abs' => $_POST['abs'],
'tpms' => $_POST['tpms'],
'check_engine' => $_POST['check_engine'],
'air_bags' => $_POST['air_bags'],
'esc' => $_POST['esc'],
'other_lights' => $_POST['other_lights']
);

$data_ministry = Array ('job_id' => $job_id,
'safety_cert_no' => $_POST['safety_cert_no'],
'add_inspec' => $_POST['add_inspec'],
'inspec_result' => $_POST['inspec_result']
);





    $db = getDbInstance();
    $dbpowertrain = getDbInstance();
    $dbsuspension = getDbInstance();
    $dbbrake = getDbInstance();
    $dbsteering = getDbInstance();
    $dbiaae = getDbInstance();
    $dblamp = getDbInstance();
    $dbelectrical = getDbInstance();
    $dbbody = getDbInstance();
    $dbtire = getDbInstance();
    $dbcoupling = getDbInstance();
    $dbroad= getDbInstance();
    $dbministry = getDbInstance();

    $last_id = $db->insert('inspection', $data_to_store);
    $last_id_powertrain = $dbpowertrain->insert('inspection_powertrain', $data_powertrain);
    $last_id_suspension = $dbsuspension->insert('inspection_suspension', $data_suspension);
    $last_id_brake = $dbbrake->insert('inspection_brake', $data_brake);
    $last_id_steering = $dbsteering->insert('inspection_steering', $data_steering);
    $last_id_iaae = $dbiaae->insert('inspection_iaae', $data_iaae);
    $last_id_lamp = $dblamp->insert('inspection_lamp', $data_lamp);
    $last_id_electrical = $dbelectrical->insert('inspection_electrical', $data_electrical);
    $last_id_body = $dbbody->insert('inspection_body', $data_body);
    $last_id_tire = $dbtire->insert('inspection_tire', $data_tire);
    $last_id_coupling = $dbcoupling->insert('inspection_coupling', $data_coupling);
    $last_id_road = $dbroad->insert('inspection_road', $data_road);
    $last_id_ministry = $dbministry->insert('ministry_req_info', $data_ministry);

    if($last_id && $last_id_powertrain && $last_id_suspension && $last_id_brake && $last_id_steering && $last_id_iaae && $last_id_lamp && $last_id_electrical && $last_id_body && $last_id_tire && $last_id_coupling && $last_id_road && $last_id_ministry)
    {
    	$_SESSION['success'] = "Inspection added successfully!";
    	header('location: edit_job.php?job_id='.$job_id.'&operation=edit');
    	exit();
    }
    else
    {
        echo 'insert failed: ' . $db->getLastError();
        exit();
    }
}



//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php';
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Add Inspection</h2>
        </div>


</div>
    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">
       <?php  include_once('./forms/inspection_form.php'); ?>
    </form>
</div>



<?php include_once 'includes/footer.php'; ?>
