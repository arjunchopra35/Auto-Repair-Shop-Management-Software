<?php
require_once './config/config.php';
$db = getDbInstance();
$q = intval($_GET['q']);
$vehi_id = intval($_GET['vehi_id']);
$selectVehicles = array('id','vehicle_make','vehicle_model','vehicle_year','vehicle_owner_id','','','');
$db->where ('vehicle_owner_id', $q);
$vehicles = $db->get ("vehicles");
?>


<!-- New Code -->


      <!-- <a class="btn btn-success" data-toggle="modal" data-target="#modalForm1"><i class="glyphicon glyphicon-plus"></i> Existing Vehicle</a> -->
      <select name="vehicle_id" form="job_form" id="vehic" class="form-control" onchange="showVehicle(this.value)" >
        <option value="">Select Vehicle</option>
      <?php foreach($vehicles as $key => $vehicle) : ?>
        <?php if($vehicle['id'] == $vehi_id): ?>
        <option value = "<?php echo($vehicle['id']); ?>" data-name = "<?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?>" data-vin = "<?php echo($vehicle['vehicle_vin']); ?>" data-lic = "<?php echo($vehicle['vehicle_lic']); ?>" selected="selected">
          <?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?>
        </option>
      <?php else: ?>
        <?php $selected = ($key == $vehicle['vehicle_make'] ? 'selected' : '') ?>
        <option value = "<?php echo($vehicle['id']); ?>" data-name = "<?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?>" data-vin = "<?php echo($vehicle['vehicle_vin']); ?>" data-lic = "<?php echo($vehicle['vehicle_lic']); ?>">
          <?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?>
        </option>
      <?php endif; ?>
      <?php endforeach; ?>
      </select>
