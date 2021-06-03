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

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method,
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Get customer id form query string parameter.
    $job_id = filter_input(INPUT_GET, 'job_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);



    // $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $db->where('id',$job_id);
    $stat = $db->update('jobs', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Job updated successfully!";
        //Redirect to the listing page,
        header('location: edit_job.php?job_id='.$job_id.'&operation=edit');
        //Important! Don't execute the rest put the exit/die.
        exit();
    }
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


}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <table width="100%">
          <tr>
            <td>
<a href="index.php" class="btn btn-success"> Back</a>

 <?php if ($edit): ?>
   <?php if ($job['job_status'] =='repair'): ?>
     <input form="job_form" type="hidden" id="job_status" name="job_status" value="repair">
     <p><h2 id="kst">REPAIR ORDER</h2></p> <a class="btn btn-success" onclick="updateInvJob();"> <i class="fa fa-user-plus"></i> Convert to Invoice</a>
   <?php elseif ($job['job_status'] =='invoice'): ?>
     <p><h2>INVOICE</h2></p>
     <?php if ($job['inspection_status'] == 1): ?>
       <p> <a class="btn btn-success" href="edit_inspection.php?job_id=<?php echo $job['id']; ?>&operation=edit"><i class="glyphicon glyphicon-edit"></i>Edit Inspection</a><a class="btn btn-success" href="print_inspection.php?job_id=<?php echo $job['id']; ?>&operation=edit"><i class="glyphicon glyphicon-edit"></i>Print Inspection</a></p>
     <?php else: ?>
       <p> Not Attached  <a class="btn btn-success" onclick="updateInspection();"><i class="glyphicon glyphicon-add"></i>Add Inspection</a></p>
     <?php endif; ?>
     <input form="job_form" type="hidden" id="job_status" name="job_status" value="invoice">
     <input form="job_form" type="hidden" name="paid" value="0" />
     <input form="job_form" type="checkbox" id="paid" name="paid" value="1" <?php echo ($edit && $job['paid'] =='1') ? "checked": "" ; ?>>
     <label for="paid"> PAID</label><br>

   <?php else: ?>
     <input form="job_form" id="job_status" type="hidden" name="job_status" value="estimate">
     <p><h2 id="jst">ESTIMATE</h2></p>
     <a class="btn btn-success" onclick="updateJob();"> <i class="fa fa-user-plus"></i> Convert to Repair Order</a>
   <?php endif; ?>
 <?php else: ?>
   <?php if ($status =='repair'): ?>
     <input form="job_form" type="hidden" id="job_status" name="job_status" value="repair">
     <p><h2>REPAIR ORDER</h2></p>
   <?php elseif ($status =='invoice'): ?>
     <p><h2>INVOICE</h2></p>
     <input form="job_form" type="hidden" id="job_status" name="job_status" value="invoice">
     <input form="job_form" type="hidden" name="paid" value="0" />
     <input form="job_form" type="checkbox" id="paid" name="paid" value="1" <?php echo ($edit && $job['paid'] =='1') ? "checked": "" ; ?>>
     <label for="paid"> PAID</label><br>

   <?php else: ?>
     <p><h2>ESTIMATE</h2></p>
     <input form="job_form" type="hidden" id="job_status" name="job_status" value="estimate">
   <?php endif; ?>
 <?php endif; ?>


           </td>
           <td style="text-align:right;">
 <a href="add_job.php" class="btn btn-success"> New</a>
  <a href="print_<?php echo $job['job_status']; ?>.php?job_id=<?php echo $job_id; ?>&operation=print" class="btn btn-success"> Print</a>
 <button type="submit" form="job_form" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
           </td>
         </tr>
         </table>
         </div>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" name="job_form" enctype="multipart/form-data" id="job_form"> </form>

        <?php
            //Include the common form for add and edit
            require_once('./forms/jobForm.php');
        ?>

</div>




<?php include_once 'includes/footer.php'; ?>
