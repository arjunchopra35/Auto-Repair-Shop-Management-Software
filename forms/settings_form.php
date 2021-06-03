<fieldset>
    <div class="form-group">
        <label for="name">Name *</label>
          <input type="text" name="name" value="<?php echo htmlspecialchars($edit ? $settings['name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Name" class="form-control" required="required" id = "name" >
    </div>

    <div class="form-group">
        <label for="phone">Phone Number *</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($edit ? $settings['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Last Name" class="form-control" required="required" id="phone">
    </div>



    <div class="form-group">
        <label for="email">Email</label>
            <input  type="email" name="email" value="<?php echo htmlspecialchars($edit ? $settings['email'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="E-Mail Address" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="address">Address</label>
            <input name="address" value="<?php echo htmlspecialchars($edit ? $settings['address'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Address" class="form-control"  type="text" id="address">
    </div>

    <div class="form-group">
        <label for="hst">H.S.T.</label>
            <input name="hst" value="<?php echo htmlspecialchars($edit ? $settings['hst'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="hst number" class="form-control"  type="text" id="hst">
    </div>

    <div class="form-group">
        <label for="invoice_data">Invoice Description</label>
            <input name="invoice_data" value="<?php echo htmlspecialchars($edit ? $settings['invoice_data'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Invoice Description" class="form-control"  type="text" id="invoice_data">
    </div>

    <div class="form-group">
        <label for="repair_data">Repair Description</label>
            <input name="repair_data" value="<?php echo htmlspecialchars($edit ? $settings['repair_data'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Repair Description" class="form-control"  type="text" id="repair_data">
    </div>

    <div class="form-group">
        <label for="estimate_data">Estimate Description</label>
            <input name="estimate_data" value="<?php echo htmlspecialchars($edit ? $settings['estimate_data'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Estimate Description" class="form-control"  type="text" id="estimate_data">
    </div>

    <div class="form-group">
        <label for="nametech">Technician Name</label>
            <input name="nametech" value="<?php echo htmlspecialchars($edit ? $settings['nametech'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Tech Name" class="form-control"  type="text" id="nametech">
    </div>
    <div class="form-group">
        <label for="tcn">Trade Cert. Number</label>
            <input name="tcn" value="<?php echo htmlspecialchars($edit ? $settings['tcn'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Trade Cert Number" class="form-control"  type="text" id="tcn">
    </div>



    <div class="form-group text-center">
        <label></label>
        <button type="submit"  class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>
</fieldset>
