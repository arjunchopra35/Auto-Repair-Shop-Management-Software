<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
$status = filter_input(INPUT_GET, 'jobstat',FILTER_SANITIZE_STRING);

//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);


    $db = getDbInstance();


    $last_id = $db->insert('jobs', $data_to_store);

    if($last_id)
    {
    	$_SESSION['success'] = "Job Created successfully!";
    	header('location: edit_job.php?job_id='.$last_id.'&operation=edit');
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
    <form class="form" action="" method="post" name="job_form" id="job_form" enctype="multipart/form-data" > </form>
       <?php  include_once('./forms/jobForm.php'); ?>

</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#estimate_form").validate({
       rules: {
            f_name: {
                required: true,
                minlength: 3
            },
            l_name: {
                required: true,
                minlength: 3
            },
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>
