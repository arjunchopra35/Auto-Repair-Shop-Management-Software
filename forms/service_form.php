<fieldset>
    <div class="form-group">
        <label for="service_code">Service Code *</label>
          <input type="text" name="service_code" value="<?php echo htmlspecialchars($edit ? $service['service_code'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Service Code" class="form-control" required="required" id = "service_code" >
    </div>

    <div class="form-group">
        <label for="service_name">Service name *</label>
        <input type="text" name="service_name" value="<?php echo htmlspecialchars($edit ? $service['service_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Service Name" class="form-control" required="required" id="service_name">
    </div>



    <div class="form-group">
        <label for="service_desc">Description</label>
            <input  type="textarea" name="service_desc" value="<?php echo htmlspecialchars($edit ? $service['service_desc'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Description" class="form-control" id="service_desc">
    </div>

    <div class="form-group">
        <label for="service_price">Price</label>
            <input name="service_price" value="<?php echo htmlspecialchars($edit ? $service['service_price'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Price" class="form-control"  type="text" id="service_price">
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>
</fieldset>
