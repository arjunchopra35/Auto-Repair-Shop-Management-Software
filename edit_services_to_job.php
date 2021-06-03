<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$job_id = filter_input(INPUT_GET, 'job_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();
  $dbVehicle = getDbInstance();
    $dbCustomer = getDbInstance();
    $dbServices = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method,
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Get customer id form query string parameter.
    // $job_id = filter_input(INPUT_GET, 'job_id', FILTER_SANITIZE_STRING);

    //Get input data
    // $data_to_update = filter_input_array(INPUT_POST);

    // $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    // $db = getDbInstance();
    // $db->where('id',$job_id);
    // $stat = $db->update('job_service', $data_to_update);


        $_SESSION['success'] = "Job updated successfully!";
        //Redirect to the listing page,
        header('location: jobs.php');
        //Important! Don't execute the rest put the exit/die.
        exit();

}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $job_id);
    //Get data to pre-populate the form.
    $job = $db->getOne("jobs");

    $dbVehicle->where('id', $job['vehicle_id']);
    //Get data to pre-populate the form.
    $vehi = $dbVehicle->getOne("vehicles");

    $dbCustomer->where('id', $vehi['vehicle_owner_id']);
    //Get data to pre-populate the form.
    $cust = $dbCustomer->getOne("customers");

    $dbServices->where('job_id', $job_id);
    //Get data to pre-populate the form.
    $services = $dbServices->get("job_service");



}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Job</h2>
    </div>
    <!-- Flash messages -->
    <?php include('./includes/flash_messages.php') ?>

    <form class="form" action="" method="post" enctype="multipart/form-data" id="services_to_job_form">
      <?php require_once('./edit_service_to_job_form.php'); ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>
