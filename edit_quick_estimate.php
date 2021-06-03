<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
$dbServices = getDbInstance();
$services = $dbServices->get("services");


// Sanitize if you want
$quick_estimate_id = filter_input(INPUT_GET, 'quick_estimate_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method,
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Get customer id form query string parameter.
    $quick_estimate_id = filter_input(INPUT_GET, 'quick_estimate_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);


    $db = getDbInstance();
    $db->where('id',$quick_estimate_id);
    $stat = $db->update('quick_estimates', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Quick Estimate updated successfully!";
        //Redirect to the listing page,
        header('location: quick_estimates.php');
        //Important! Don't execute the rest put the exit/die.
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $quick_estimate_id);
    //Get data to pre-populate the form.
    $quickEstimate = $db->getOne("quick_estimates");

    $dbServices = getDbInstance();
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Quick Estimate</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">

        <?php
            //Include the common form for add and edit
            require_once('./forms/quick_estimate_form.php');
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>
