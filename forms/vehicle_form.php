<?php
$db = getDbInstance();
$select = array('id','f_name', 'l_name');
$customers = $db->get ("customers", null, $select);
?>

<fieldset>
    <div class="form-group">
        <label for="vehicle_make">Vehicle Make *</label>
          <input type="text" name="vehicle_make" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_make'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Make" class="form-control" required="required" id = "vehicle_make" >
    </div>

    <div class="form-group">
        <label for="vehicle_model">Vehicle Model *</label>
        <input type="text" name="vehicle_model" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_model'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Model" class="form-control" required="required" id="vehicle_model">
    </div>



    <div class="form-group">
        <label for="vehicle_year">Vehicle Year</label>
            <input  type="text" name="vehicle_year" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_year'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Year" class="form-control" id="vehicle_year">
    </div>

    <div class="form-group">
        <label for="vehicle_kms">Vehicle KMs</label>
            <input name="vehicle_kms" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_kms'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Kilometers" class="form-control"  type="text" id="vehicle_kms">
    </div>

    <div class="form-group">
        <label for="vehicle_engine">Vehicle Engine</label>
            <input name="vehicle_engine" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_engine'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Engine" class="form-control"  type="text" id="vehicle_engine">
    </div>

    <div class="form-group">
        <label for="vehicle_vin">VIN No.</label>
            <input name="vehicle_vin" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_vin'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="VIN No." class="form-control"  type="text" id="vehicle_vin">
    </div>

    <div class="form-group">
        <label for="vehicle_lic">License Plate Number</label>
            <input name="vehicle_lic" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_lic'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="License Plate Number" class="form-control"  type="text" id="vehicle_lic">
    </div>

    <div class="form-group">
        <label for="vehicle_color">Vehicle Color</label>
            <input name="vehicle_color" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_color'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Color" class="form-control"  type="text" id="vehicle_color">
    </div>

    <div class="form-group">
        <label for="vehicle_owner_id">Vehicle Owner</label>
        <select name="vehicle_owner_id"  class="form-control" >
          <option value="">Select one</option>
        <?php foreach($customers as $key => $customer) : ?>
          <?php $selected = ($key == $customer['f_name'] ? 'selected' : '') ?>
          <option value = "<?php echo($customer['id']); ?>" <?php echo($selected); ?>>
            <?php echo($customer['f_name']. ' ' .$customer['l_name']); ?>
          </option>

        <?php endforeach; ?>

</select>


    </div>
    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>
</fieldset>
