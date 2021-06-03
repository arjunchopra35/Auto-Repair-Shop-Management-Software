<script>
var selectedServices = [];
var totalArr =[];
var servArr = [];

function updateDisc(disc){
  ftotal=0;
  for(var i in totalArr){
    ftotal += parseFloat(totalArr[i]);
  }
  ftotal = ftotal - parseFloat(disc);
  document.getElementById("subamount").value = (Math.round(ftotal * 100) / 100).toFixed(2);
  var tax = ftotal*0.13;
  ftotal = ftotal + tax;
  document.getElementById("serviceTotal").value = (Math.round(ftotal * 100) / 100).toFixed(2);
  document.getElementById("taxamount").value = tax.toFixed(2);;

}



function showServiceInfo(sinfo){
if (sinfo == "") {
  document.getElementById("serviceTable").innerHTML = "";
return;
} else {
servArr.push(sinfo);
$('[name="serviceIds"]').val(servArr);
console.log(servArr);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  selectedServices.push(this.responseText);
  document.getElementById("serviceTable").innerHTML = selectedServices.join("");
console.log(selectedServices);

}
};

xmlhttp.open("GET","getserviceinfo.php?s="+sinfo,true);
xmlhttp.send();
}
}


function delService(sid){
if (sid == "") {
  document.getElementById("serviceTable").innerHTML = "";
return;
} else {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
console.log(selectedServices);
  var index = selectedServices.indexOf(this.responseText);
  var servIndex = servArr.indexOf(sid);
  if (index !== -1) {
  selectedServices.splice(index, 1);
  servArr.splice(index, 1);
  $('[name="serviceIds"]').val(servArr);
  console.log(servArr);

}
  document.getElementById("serviceTable").innerHTML = selectedServices.join("");


}
};

xmlhttp.open("GET","getserviceinfo.php?s="+sid,true);
xmlhttp.send();
}
}




function updateTotal(sinfo){
if (sinfo == "") {
  document.getElementById("serviceTotal").innerHTML = "";
return;
} else {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  var index = totalArr.indexOf(parseInt(this.responseText));
  if (index !== -1) {
  totalArr.splice(index, 1);
}

  var ftotal = 0;
  for(var i in totalArr){
    ftotal += parseFloat(totalArr[i]);
  }
    $('[name="total"]').val((Math.round(ftotal * 100) / 100).toFixed(2));

  document.getElementById("subamount").value = (Math.round(ftotal * 100) / 100).toFixed(2);
  var tax = ftotal*0.13;
  ftotal = ftotal + tax;
  document.getElementById("serviceTotal").value = (Math.round(ftotal * 100) / 100).toFixed(2);
  document.getElementById("taxamount").value = (Math.round(tax * 100) / 100).toFixed(2);
  console.log(ftotal);


}
};

xmlhttp.open("GET","gettotal.php?s="+sinfo,true);
xmlhttp.send();
}
}

function getTotal(sinfo){
if (sinfo == "") {
  document.getElementById("serviceTotal").innerHTML = "";
return;
} else {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  totalArr.push(parseInt(this.responseText));
  var ftotal = 0;
  for(var i in totalArr){
    ftotal += parseFloat(totalArr[i]);
  }
    $('[name="total"]').val((Math.round(ftotal * 100) / 100).toFixed(2));
  document.getElementById("subamount").value = (Math.round(ftotal * 100) / 100).toFixed(2);
  var tax = ftotal*0.13;
  ftotal = ftotal + tax;
  document.getElementById("serviceTotal").value = (Math.round(ftotal * 100) / 100).toFixed(2);
  document.getElementById("taxamount").value = (Math.round(tax * 100) / 100).toFixed(2);
  console.log(ftotal);



}
};

xmlhttp.open("GET","gettotal.php?s="+sinfo,true);
xmlhttp.send();
}
}
</script>


<fieldset>
    <div class="form-group">
        <label for="phone">Phone</label>
            <input name="phone_no" value="<?php echo htmlspecialchars($edit ? $quickEstimate['phone_no'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control"  type="text" id="phone">
    </div>

    <select id="cust" class="form-control" onchange="showServiceInfo(this.value); getTotal(this.value);">
      <option value="" selected="selected">Select Service</option>
    <?php foreach($services as $key => $service) : ?>
      <?php $selected = ($key == $service['service_code'] ? 'selected' : '') ?>
      <option value = "<?php echo($service['id']); ?>" data-name = "<?php echo($service['service_code']. ' ' .$service['service_name']); ?>" data-desc = "<?php echo($service['service_desc']); ?>" data-price = "<?php echo($service['price']); ?>">
        <?php echo($service['service_code']. ' ' .$service['service_name']); ?>
      </option>
    <?php endforeach; ?>
  </select>


    <div class="form-group text-center">
        <label></label>
        <table width="100%">
          <tr class="heading">
            <td style="width:15%">
              <label class="wLabel">  CODE </label>
            </td>

            <td style="width:15%; text-align: left;">
                <label class="wLabel">   Name </label>
            </td>
            <td style="width:40%">
              <label class="wLabel">     Description </label>
            </td>


              <td style="width:10%">
              <label class="wLabel">       Qty or Hrs </label>
              </td>
              <td style="width:10%">
                <label class="wLabel">     Price </label>
              </td>
              <td style="width:10%">
                <label class="wLabel">     Total Amount </label>
              </td>
          </tr>
        <tbody id="serviceTable">
          <?php $servicesArray = htmlspecialchars($edit ? $quickEstimate['serviceIds'] : '', ENT_QUOTES, 'UTF-8'); ?>
          <?php $currentServices = explode(',', $servicesArray); ?>
          <?php foreach ($currentServices as $currentService) : ?>

            <?php $dbServices->where ('id', $currentService);?>
            <?php $service = $dbServices->getOne("services");?>

            <tr class="item">
                  <td>
                      <?php echo($service['service_code']); ?><br>
                  </td>
                  <td style="text-align:left;">
                      <?php echo($service['service_name']); ?><br>
                  </td>
                  <td>
                    <textarea class="form-control"><?php echo($service['service_desc']); ?></textarea>
                  </td>
                  <td>
                      <input  value="1" required="required" id = "qty" >
                  </td>

                  <td class="price">
                      <?php echo($service['service_price']); ?>

                  </td>
                  <td class="price">
                      <?php echo($service['service_price']); ?>
                      <a href="#" id="d-btn" name="d-btn" value = "<?php echo($service['id']); ?>" onclick="delService(<?php echo($service['id']); ?>); updateTotal(<?php echo($service['id']); ?>); "><i class="fa fa-trash fa-fw"></i></a>
                  </td>

              </tr>


              <?php endforeach; ?>

          </tbody>
        </table>
        <input type="hidden" id="serviceIds" name="serviceIds" value="<?php echo htmlspecialchars($edit ? $quickEstimate['serviceIds'] : '', ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" id="total" name="total" value="<?php echo htmlspecialchars($edit ? $quickEstimate['total'] : '', ENT_QUOTES, 'UTF-8'); ?>">
        <table  cellpadding="0" cellspacing="0">

        </table>
        <br>
        <br>
        <br>
        <table width="50%">
          <tr>


              <td>
                  <b>Sub-total</b>
              </td>

              <td class="sub">
                <?php $subTotal = htmlspecialchars($edit ? $quickEstimate['total'] : '', ENT_QUOTES, 'UTF-8'); ?>
                <?php $discount = htmlspecialchars($edit ? $quickEstimate['discount'] : '', ENT_QUOTES, 'UTF-8'); ?>
              <input id="subamount" value="<?php echo htmlspecialchars($edit ? $quickEstimate['total'] : '', ENT_QUOTES, 'UTF-8'); ?>" disabled>
              </td>
          </tr>
          <tr>


              <td>
                  <b>Discount</b>
              </td>

              <td class="discount">

              <input id="discount" name="discount" onchange="updateDisc(this.value)" value="<?php echo htmlspecialchars($edit ? $quickEstimate['discount'] : '', ENT_QUOTES, 'UTF-8'); ?>">
              </td>
          </tr>

          <tr>


              <td>
                  <b>Total After Discount</b>
              </td>

              <td class="afterdiscount">

              <input id="afterdiscount"  onchange="updateDisc(this.value)" value="<?php echo htmlspecialchars($edit ? $subTotal - $discount : '', ENT_QUOTES, 'UTF-8'); ?>" disabled>
              </td>
          </tr>

                            <tr>


                                <td>
                                    <b>Tax GST (13%)</b>
                                </td>

                                <td class="tax">
                                  <input id="taxamount"  onchange="updateDisc(this.value)" value="<?php echo htmlspecialchars($edit ? ($subTotal - $discount)*0.13 : '', ENT_QUOTES, 'UTF-8'); ?>" disabled>
                                </td>
                            </tr>
                            <tr>


                                <td>
                                    <b>Total Amount</b>
                                </td>

                                <td class="total">
                                <input id="serviceTotal"  onchange="updateDisc(this.value)" value="<?php echo htmlspecialchars($edit ? ($subTotal - $discount) + ($subTotal - $discount)*0.13 : '', ENT_QUOTES, 'UTF-8'); ?>" disabled>
                                </td>
                            </tr>
        </table>
        <button type="submit"  class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>
</fieldset>
<script>
var total = document.getElementById("total").value;
console.log(total);
var servData = document.getElementById("serviceIds").value;
var servArr = eval("["+servData+"]");
console.log(serviceIds);
</script>
