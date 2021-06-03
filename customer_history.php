<script>
function showHistory(vid){
if (vid == "") {
  document.getElementById("vehiclehistory").innerHTML = "";
return;
} else {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  document.getElementById("vehiclehistory").innerHTML = this.responseText;

}
};
xmlhttp.open("GET","getvehiclehistory.php?p="+vid,true);
xmlhttp.send();
}
}
</script>
<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$customer_id = intval($_GET['customer_id']);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING);
 $db = getDbInstance();
$db->where('id', $customer_id);
    //Get data to pre-populate the form.
$customer = $db->getOne("customers");

$dbVehicle = getDbInstance();
$selectVehicles = array('id','vehicle_make','vehicle_model','vehicle_year','vehicle_owner_id','','','');
$dbVehicle->where ('vehicle_owner_id', $customer_id);
$vehicles = $dbVehicle->get ("vehicles");
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Customer History</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="45%">Name</th>
                <th width="20%">Email</th>
                <th width="15%">Phone</th>
            </tr>
        </thead>
        <tbody>
          <tr>
<td><?php echo xss_clean($customer['f_name'] . ' ' . $customer['l_name']); ?> </td>
<td> <?php echo xss_clean($customer['phone']); ?> </td>
<td> <?php echo xss_clean($customer['email']); ?> </td>
</tr>
</tbody>
</table>
<h3>Vehicles</h3>
<select name="vehicle_id" id="vehic" class="form-control" onchange="showHistory(this.value)" >
  <option value="">Select Vehicle</option>
<?php foreach($vehicles as $key => $vehicle) : ?>
  <?php $selected = ($key == $vehicle['vehicle_make'] ? 'selected' : '') ?>
  <option value = "<?php echo($vehicle['id']); ?>" data-name = "<?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?>" data-vin = "<?php echo($vehicle['vehicle_vin']); ?>" data-lic = "<?php echo($vehicle['vehicle_lic']); ?>">
    <?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?>
  </option>
<?php endforeach; ?>
</select>
<h3>History</h3>
<div id="vehiclehistory"></div>
</div>




<?php include_once 'includes/footer.php'; ?>
