<style>
.cust-label{
  font-weight:normal;
  margin-bottom: 0px;
}
</style>
<?php
require_once './config/config.php';
$db = getDbInstance();
$p = intval($_GET['p']);
$selectVehicles = array('id','vehicle_make','vehicle_model','vehicle_year','vehicle_owner_id');
$db->where ('id', $p);
$vehicles = $db->get ('vehicles');
?>
<?php foreach($vehicles as $key => $vehicle) : ?>

<table width="100%">
  <tr>
    <td style="background-color:#0075d4;">
    <label style="color:white">  Year </label>
    </td>
    <td style="background-color:#0075d4;">
    <label style="color:white">  Make </label>
    </td>
    <td style="background-color:#0075d4;">
    <label style="color:white">  Model </label>
    </td>
  </tr>

  <tr>
    <td>
      <input style="border: 0; width:100%;" class="cust-label" value="<?php echo($vehicle['vehicle_year']); ?>" placeholder="Year">
    </td>
    <td>
        <input style="border: 0; width:100%;" class="cust-label" value="<?php echo($vehicle['vehicle_make']); ?>" placeholder="Make">
    </td>
    <td>
      <input style="border: 0; width:100%;" class="cust-label" value="<?php echo($vehicle['vehicle_model']); ?>" placeholder="Model">
    </td>
  </tr>

  <tr>
    <td style="background-color:#0075d4;">
      <label style="color:white"> V.I.N </label>
    </td>
    <td style="background-color:#0075d4;">
      <label style="color:white"> Lic. Plate </label>
    </td>
    <td style="background-color:#0075d4;">
      <label style="color:white"> Kilometers </label>
    </td>
  </tr>

  <tr>
    <td>
      <input style="border: 0; width:100%;" id="vehicle-vin" class="cust-label" value="<?php echo($vehicle['vehicle_vin']); ?>" placeholder="V.I.N. Number"><br>
    </td>
    <td>
      <input style="border: 0; width:100%;" class="cust-label" value="<?php echo($vehicle['vehicle_lic']); ?>"placeholder="License Plate">
    </td>
    <td>
      <input style="border: 0; width:100%;" class="cust-label" value="<?php echo($vehicle['vehicle_kms']); ?>" placeholder="Kilometers">
    </td>
  </tr>
</table>


<?php endforeach; ?>


<!-- New Code -->
