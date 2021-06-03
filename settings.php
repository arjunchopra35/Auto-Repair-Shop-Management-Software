<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$setting_id = filter_input(INPUT_GET, 'setting_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method,
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Get customer id form query string parameter.
    $setting_id = filter_input(INPUT_GET, 'setting_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);


    $db = getDbInstance();
    $db->where('id',$setting_id);
    $stat = $db->update('settings', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Settings updated successfully!";
        //Redirect to the listing page,
        header('location: settings.php?setting_id=1&operation=edit');
        //Important! Don't execute the rest put the exit/die.
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $setting_id);
    //Get data to pre-populate the form.
    $settings = $db->getOne("settings");
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Settings</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="settings_form">

        <?php
            //Include the common form for add and edit
            require_once('./forms/settings_form.php');
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>
