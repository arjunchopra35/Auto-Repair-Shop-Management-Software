<script>
$(document).ready(function() {
    $('.province').select2();
});
</script>
<fieldset>
    <div class="form-group">
        <label for="f_name">First Name *</label>
          <input type="text" name="f_name" value="<?php echo htmlspecialchars($edit ? $customer['f_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="First Name" class="form-control" required="required" id = "f_name" >
    </div>

    <div class="form-group">
        <label for="l_name">Last name *</label>
        <input type="text" name="l_name" value="<?php echo htmlspecialchars($edit ? $customer['l_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Last Name" class="form-control" required="required" id="l_name">
    </div>

    <div class="form-group">
        <label for="address_1">Address</label>
        <input type="text" name="address_1" value="<?php echo htmlspecialchars($edit ? $customer['address_1'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Address Line 1" class="form-control"  id="address_1">
        <input type="text" name="address_2" value="<?php echo htmlspecialchars($edit ? $customer['address_2'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Address Line 2" class="form-control"  id="address_2">
    </div>

    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($edit ? $customer['city'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="city" class="form-control"  id="city">
    </div>

    <div class="form-group">
        <label for="postal">Postal Code</label>
        <input type="text" name="postal" value="<?php echo htmlspecialchars($edit ? $customer['postal'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Postal Code (M1G1X1)" class="form-control"  id="postal">

    </div>

    <div class="form-group">
        <label for="province">Province</label>
        <select class="province" name="province" id="province">
          <option value="Alberta">Alberta</option>
          <option value="British Columbia">British Columbia</option>
          <option value="Manitoba">Manitoba</option>
          <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
          <option value="Northwest Territories">Northwest Territories</option>
          <option value="Nova Scotia">Nova Scotia</option>
          <option value="Nunavut">Nunavut</option>
          <option value="Ontario" selected="selected">Ontario</option>
          <option value="Prince Edward Island">Prince Edward Island</option>
          <option value="Quebec">Quebec</option>
          <option value="Saskatchewan">Saskatchewan</option>
          <option value="Yukon">Yukon</option>

        </select>

    </div>


    <div class="form-group">
        <label for="email">Email</label>
            <input  type="email" name="email" value="<?php echo htmlspecialchars($edit ? $customer['email'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="E-Mail Address" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
            <input name="phone" value="<?php echo htmlspecialchars($edit ? $customer['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control"  type="text" id="phone">
    </div>

    <div class="form-group">
        <label for="bus_phone">Bussiness Phone</label>
            <input name="bus_phone" value="<?php echo htmlspecialchars($edit ? $customer['bus_phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control"  type="text" id="bus_phone">
    </div>

    <div class="form-group">
        <label for="mob_phone">Mobile Phone</label>
            <input name="mob_phone" value="<?php echo htmlspecialchars($edit ? $customer['mob_phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control"  type="text" id="mob_phone">
    </div>

    <div class="form-group">
        <label for="hom_phone">Home Phone</label>
            <input name="hom_phone" value="<?php echo htmlspecialchars($edit ? $customer['hom_phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control"  type="text" id="hom_phone">
    </div>

    <div class="form-group">
        <label for="fax">Fax</label>
            <input name="fax" value="<?php echo htmlspecialchars($edit ? $customer['fax'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Fax Number" class="form-control"  type="text" id="fax">
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit"  class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>
</fieldset>
