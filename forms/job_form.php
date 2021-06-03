  <script>
  // var selectedServices = [];
  // var total =[];
  $(document).ready(function() {
      $('.cust').select2();
  });

  $("#cust").change(function() {
      $('#cust-name').val($('option:selected').attr('data-name'));
      $('#cust-phone').val($('option:selected').attr('data-phone'));
      $('#cust-email').val($('option:selected').attr('data-email'));
  }).change();


  $("#vehic").change(function() {
      $('#vehicle-name').val($('option:selected').attr('data-name'));
      $('#vehicle-vin').val($('option:selected').attr('data-vin'));
      $('#vehicle-lic').val($('option:selected').attr('data-lic'));
  }).change();

  function showUser(str, vehi_id){
  if (str == "") {
    document.getElementById("vehicle").innerHTML;
  return;
  } else {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("vehicle").innerHTML = this.responseText;
  }
  };
  xmlhttp.open("GET","getvehicle.php?q="+str+"&vehi_id="+vehi_id,true);
  xmlhttp.send();
  }
  }


  function showVehicle(vinfo){
  if (vinfo == "") {
    document.getElementById("vehicleinfo").innerHTML = "";
  return;
  } else {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("vehicleinfo").innerHTML = this.responseText;

  }
  };
  xmlhttp.open("GET","getvehicleinfo.php?p="+vinfo,true);
  xmlhttp.send();
  }
  }

  // function showService(scode){
  // if (scode == "") {
  //   document.getElementById("s-btn").innerHTML = "";
  // return;
  // } else {
  //   var xmlhttp = new XMLHttpRequest();
  //   xmlhttp.onreadystatechange = function() {
  //   if (this.readyState == 4 && this.status == 200) {
  //     document.getElementById("s-btn").innerHTML = this.responseText;
  //   }
  //   };
  //   xmlhttp.open("GET","getservice.php?r="+scode,true);
  //   xmlhttp.send();
  //   }
  // }

  // function delService(scode){
  // if (scode == "") {
  //   document.getElementById("s-btn").innerHTML = "";
  // return;
  // } else {
  //   var xmlhttp = new XMLHttpRequest();
  //   xmlhttp.onreadystatechange = function() {
  //   if (this.readyState == 4 && this.status == 200) {
  //     document.getElementById("s-btn").innerHTML = this.responseText;
  //   }
  //   };
  //   xmlhttp.open("GET","getservice.php?r="+scode,true);
  //   xmlhttp.send();
  //   }
  // }

  // function showServiceInfo(sinfo){
  // if (sinfo == "") {
  //   document.getElementById("serviceTable").innerHTML = "";
  // return;
  // } else {
  // var xmlhttp = new XMLHttpRequest();
  // xmlhttp.onreadystatechange = function() {
  // if (this.readyState == 4 && this.status == 200) {
  //   selectedServices.push(this.responseText);
  //   document.getElementById("serviceTable").innerHTML = selectedServices.join("");
  // console.log(selectedServices);
  //
  // }
  // };
  //
  // xmlhttp.open("GET","getserviceinfo.php?s="+sinfo,true);
  // xmlhttp.send();
  // }
  // }


  // function getTotal(sinfo){
  // if (sinfo == "") {
  //   document.getElementById("serviceTotal").innerHTML = "";
  // return;
  // } else {
  // var xmlhttp = new XMLHttpRequest();
  // xmlhttp.onreadystatechange = function() {
  // if (this.readyState == 4 && this.status == 200) {
  //   total.push(parseInt(this.responseText));
  //   var ftotal = 0;
  //   for(var i in total){
  //     ftotal += parseInt(total[i]);
  //   }
  //   document.getElementById("subamount").innerHTML = ftotal;
  //   var tax = ftotal*0.13;
  //   ftotal = ftotal + tax;
  //   document.getElementById("serviceTotal").innerHTML = ftotal;
  //   document.getElementById("taxamount").innerHTML = Math.round(tax*100)/100;
  //   console.log(ftotal);
  //
  // }
  // };
  //
  // xmlhttp.open("GET","gettotal.php?s="+sinfo,true);
  // xmlhttp.send();
  // }
  // }


  var selectedServices = [];
  var total =[];

  function showService(scode, job_id){
  if (scode == "") {
    document.getElementById("s-btn").innerHTML = "";
  return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("s-btn").innerHTML = this.responseText;
    }
    };
    xmlhttp.open("GET","getservice.php?r="+scode+"&job_id="+job_id,true);
    xmlhttp.send();
    }
  }



  function showServiceInfo(sinfo, job_id){
  if (sinfo == "") {
    document.getElementById("serviceTable").innerHTML = "";
  return;
  } else {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    selectedServices.push(this.responseText);
    document.getElementById("serviceTable").innerHTML = selectedServices.join("");
  console.log(selectedServices);

  }
  };

  xmlhttp.open("GET","getserviceinfo.php?s="+sinfo+"&job_id="+job_id,true);
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
    console.log(this.responseText);
    var index = selectedServices.indexOf(this.responseText);
    if (index !== -1) {
    selectedServices.splice(index, 1);
  }
    document.getElementById("serviceTable").innerHTML = selectedServices.join("");


  }
  };

  xmlhttp.open("GET","delserviceinfo.php?s="+sid,true);
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
    var index = total.indexOf(parseInt(this.responseText));
    if (index !== -1) {
    total.splice(index, 1);
  }

    var ftotal = 0;
    for(var i in total){
      ftotal += parseInt(total[i]);
    }
    document.getElementById("subamount").innerHTML = ftotal;
    var tax = ftotal*0.13;
    ftotal = ftotal + tax;
    document.getElementById("serviceTotal").innerHTML = ftotal;
    document.getElementById("taxamount").innerHTML = Math.round(tax*100)/100;
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
    total.push(parseInt(this.responseText));
    var ftotal = 0;
    for(var i in total){
      ftotal += parseInt(total[i]);
    }
    document.getElementById("subamount").innerHTML = ftotal;
    var tax = ftotal*0.13;
    ftotal = ftotal + tax;
    document.getElementById("serviceTotal").innerHTML = ftotal;
    document.getElementById("taxamount").innerHTML = Math.round(tax*100)/100;
    console.log(ftotal);

  }
  };

  xmlhttp.open("GET","gettotal.php?s="+sinfo,true);
  xmlhttp.send();
  }
  }

  </script>







  <?php
  $db = getDbInstance();
  $select = array('id','f_name', 'l_name', 'phone','email');
  $customers = $db->get ("customers", null, $select);



  $dbVehicles = getDbInstance();
  $vehicles = $dbVehicles->get ("vehicles");

  $db = getDbInstance();
  $job_id = filter_input(INPUT_GET, 'job_id', FILTER_VALIDATE_INT);
  $db->where ('id', $job_id);
  $job = $db->getOne ("jobs");

  $dbvehicle = getDbInstance();
  $dbvehicle->where ('id', $job['vehicle_id']);
  $vehicle = $dbvehicle->getOne ("vehicles");


  $dbcustomer = getDbInstance();
  $dbcustomer->where ('id', $vehicle['vehicle_owner_id']);
  $customer = $dbcustomer->getOne ("customers");


  $dbServices = getDbInstance();
  $selectServices = array('id','service_code','service_name','service_desc','service_price');
  $services = $dbServices->get("services",null,$selectServices);


  ?>

  <style>
  table, th, td {
    border: 1px solid black;
  }

  th, td {
    padding: 5px;
  }
  .heading {
    background-color:#0075d4;
  }
  .wLabel{
    color:white;
  }

      </style>
  </head>

  <body>
      <div>
          <table width="100%" cellpadding="0" cellspacing="0">
              <tr  class="top">
                  <td width="100%" colspan="2">
                      <table width="100%">
                          <tr>
                              <td class="title" width="40%">
                                  <img src="assets/images/1.png" style="width:140px; max-width:140px; float: left;"><h5><br><br>24 Melham Ct UNIT 7,<br>
                                    Scarborough, ON M1B 2T8<br>
                                    +1 416 807 3444</h5></td>


                                <td width="20%" >
                                </td>
                              <td width="40%" style="text-align:center;">
                                <br>
                                EST001
                                <p id ="date" class="date">January 1, 2021</p>
                                <input type="radio" id="estimate" name="job_status" checked value="estimate" <?php echo ($edit && $job['job_status'] =='estimate') ? "checked": "" ; ?>>
                                <label for="estimate"> Estimate</label><br>
                                <input type="radio" id="repair" name="job_status" value="repair" <?php echo ($edit && $job['job_status'] =='repair') ? "checked": "" ; ?>>
                                <label for="repair"> Repair Order</label><br>
                                <input type="radio" id="Invoice" name="job_status" value="invoice" <?php echo ($edit && $job['job_status'] =='invoice') ? "checked": "" ; ?>>
                                <label for="invoice"> Invoice</label>


                              </td>
                          </tr>
                          <tr>
                              <td  style="text-align:left;">
                                <table width="100%">
                                  <tr>
                                    <td colspan="2" style="background-color:#FF0000">
                                <label style="color:white;" for="vehicle_owner_id">Customer Details</label><br>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <select id="cust" width="100%" class="form-control cust" onchange="showUser(this.value, <?php echo htmlspecialchars($edit ? $vehi['id'] : '', ENT_QUOTES, 'UTF-8'); ?>)">
                                  <option value="" selected="selected">Select Customer</option> <a href="add_job.php?operation=create" class="btn btn-success">
                                <?php foreach($customers as $key => $customer) : ?>
                                  <?php if($customer['id'] == $cust['id']): ?>
                                  <option value = "<?php echo($customer['id']); ?>" data-name = "<?php echo($customer['f_name']. ' ' .$customer['l_name']); ?>" data-phone = "<?php echo($customer['phone']); ?>" data-email = "<?php echo($customer['email']); ?>" selected="selected">
                                    <?php echo($customer['f_name']. ' ' .$customer['l_name']); ?>
                                  </option>
                                <?php else: ?>
                                  <?php $selected = ($key == $customer['f_name'] ? 'selected' : '') ?>
                                  <option value = "<?php echo($customer['id']); ?>" data-name = "<?php echo($customer['f_name']. ' ' .$customer['l_name']); ?>" data-phone = "<?php echo($customer['phone']); ?>" data-email = "<?php echo($customer['email']); ?>">
                                    <?php echo($customer['f_name']. ' ' .$customer['l_name']); ?>
                                  </option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                              </select></td><td style="text-align:left;">
                              <a class="btn btn-success" data-toggle="modal" data-target="#modalForm"> <i class="fa fa-user-plus"></i> Add</a> <a class="btn btn-success" data-toggle="modal" data-target="#modalForm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a><br>
                            </td>
                          </tr>
                          <tr>
                            <td style="background-color:#0075d4;"><label style="color:white">Customer Name</label></td>
                            <td style="text-align:left; background-color:#0075d4;"><label style="color:white">Customer Phone</label></td>

                          </tr>
                          <tr>
                            <td>
                              <input class="cust-label" style="border: 0; width:100%;"  id="cust-name">
                            </td>
                            <td style="text-align:left;">
                              <input style="border: 0; width:100%;" class="cust-label" for="phone" id="cust-phone">
                            </td>

                          </tr>
                          <tr>
                            <td colspan="2" style="background-color:#0075d4;"><label style="color:white">Customer Email</label></td>


                          </tr>
                            <tr>
                              <td colspan="2">

                              <input  class="cust-label" for="email" style="border: 0; width:100%;" id="cust-email">
                            </td>
                          </tr>
                            </table>
                          </td>

                            <td>


                                <table>
                                  <tr>
                                    <td style="background-color:#0075d4;">
                                      <label style="color:white">
                                      Estimate Date
                                    </label>


  </td>
  <td>

    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
    <label for="vehicle1"> Arrived</label><br>

  </td>
  </tr>
  <tr>
    <td>

  <input type="date" style="border: 0; width:100%;" class="cust-label" for="phone" id="cust-phone">
  </td>

  <td>
    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
    <label for="vehicle2"> Esti. Complete</label><br>


  </td>

  </tr>
  <tr>
    <td style="background-color:#0075d4;">
      <label style="color:white">
  Repair Order Date
  </label>

  </td>

  <td>
    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
    <label for="vehicle3"> Part Required</label><br>

  </td>

  </tr>
  <tr>
    <td>
  <input  type="date" style="border: 0; width:100%;" class="cust-label" for="phone" id="cust-phone">
</td>


  <td>
    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
    <label for="vehicle3"> In Shop</label><br>



  </td>

  </tr>
  <tr>
    <td style="background-color:#0075d4;">
      <label style="color:white">
  Invoice Date
  </label>

  </td>

  <td>
    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
    <label for="vehicle3"> Cust. Waiting</label><br>


  </td>

  </tr>
  <tr>
    <td>
  <input type="date" style="border: 0; width:100%;" class="cust-label" for="phone" id="cust-phone">

  </td>

  <td>
    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
    <label for="vehicle3"> Completed</label>

  </td>

  </tr>
  </table>



                              </td>


                              <td  style="text-align:center;">
                                <table width="100%">
                                  <tr>
                                    <td style="background-color:#FF0000;" colspan="3">
                                        <label  style="color:white;" for="vehicle_id">Vehicle Details</label>
                                    </td>

                                  </tr>


                                  <tr>
                                    <td>
                                      <!-- <a class="btn btn-success" data-toggle="modal" data-target="#modalForm1"><i class="glyphicon glyphicon-plus"></i> Existing Vehicle</a> -->
                                      <select name="vehicle_id" id="vehic" class="form-control" onchange="showVehicle(this.value)" >
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
                                    </td>
                                    <td>
                                      <a href="add_job.php?operation=create" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> New Vehicle</a>
                                    </td>
                                    <td>
                                      <a href="add_job.php?operation=create" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Remove Vehicle</a>
                                    </td>
                                  </tr>

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
                                      <input style="border: 0; width:100%;" class="cust-label" value="" placeholder="Year">
                                    </td>
                                    <td>
                                        <input style="border: 0; width:100%;" class="cust-label" value="" placeholder="Make">
                                    </td>
                                    <td>
                                      <input style="border: 0; width:100%;" class="cust-label" value="" placeholder="Model">
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
                                      <input style="border: 0; width:100%;" id="vehicle-vin" class="cust-label" value="" placeholder="V.I.N. Number"><br>
                                    </td>
                                    <td>
                                      <input style="border: 0; width:100%;" class="cust-label" value="" placeholder="License Plate">
                                    </td>
                                    <td>
                                      <input style="border: 0; width:100%;" class="cust-label" value="" placeholder="Kilometers">
                                    </td>
                                  </tr>
                                </table>




                                <!-- <div id="vehicle">








                                </div> -->



                              </td>


                          </tr>
                      </table>
                  </td>
              </tr>

              <tr class="information">
                  <td colspan="2">
                      <table width="100%">

                          <tr>
                          <td style="text-align:left; width: 25%;"><p>Job Status</p>

                       <br></td>
                       <td style="text-align:left; width: 50%;">
                         <div class="form-group">
                             <label for="notes">Notes</label>
                                 <textarea name="notes" value="" placeholder="Enter Notes Here" class="form-control" id="notes"><?php echo htmlspecialchars($edit ? $job['notes'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                         </div>

                       </td>
                          <td style="text-align:center; width: 25%;">
                             <label for="inspection_status"> Attach Inspection Sheet</label><br>
                            <input type="radio" id="inspection_status" required="" name="inspection_status" value="1" <?php echo ($edit && $job['inspection_status'] =='1') ? "checked": "" ; ?>>
                             <label for="yes"> Yes </label><br>
                             <input type="radio" id="inspection_status" required="" name="inspection_status" value="0" <?php echo ($edit && $job['inspection_status'] =='0') ? "checked": "" ; ?>>
                              <label for="no"> No </label><br>

                          </td>
                        </tr>


                      </table>

                  </td>
              </tr>

  </table>
  <br>
  <br>

          <table width="100%">
              <tr>
                <label for="add_services">Add Services</label> &nbsp &nbsp &nbsp<a class="btn btn-success" data-toggle="modal" data-target="#modalForm2"><i class="glyphicon glyphicon-plus"></i> Add New Service</a>
                  <td>

                    <select id="cust" class="form-control" onchange="showService(this.value, <?php echo $job_id; ?>)">
                      <option value="" selected="selected">Select Service</option>
                    <?php foreach($services as $key => $service) : ?>
                      <?php $selected = ($key == $service['service_code'] ? 'selected' : '') ?>
                      <option value = "<?php echo($service['id']); ?>" data-name = "<?php echo($service['service_code']. ' ' .$service['service_name']); ?>" data-desc = "<?php echo($service['service_desc']); ?>" data-price = "<?php echo($service['price']); ?>">
                        <?php echo($service['service_code']. ' ' .$service['service_name']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                  <div id="serviceinfo">


                  </div>



                  </td>

                  <td>
                    <div id="s-btn" name="s-btn"></div>


                  </td>
              </tr>


          </table>

          <br>
        </br>

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

          <tr>
            <td style="width:15%">

            </td>

            <td style="width:15%; text-align: left;">

            </td>
            <td style="width:40%">

            </td>


              <td style="width:10%">

              </td>
              <td style="width:10%">

              </td>
              <td style="width:10%">

              </td>
          </tr>
        </table>
<br>
<br>
  <table  cellpadding="0" cellspacing="0">
    <tbody id="serviceTable"></tbody>
  </table>
  <table width="50%">
    <tr>


        <td>
            <b>Sub-total</b>
        </td>

        <td class="sub">
        <p id="subamount"></p>
        </td>
    </tr>
                      <tr>


                          <td>
                              <b>Tax GST (13%)</b>
                          </td>

                          <td class="tax">
                          <p id="taxamount"></p>
                          </td>
                      </tr>
                      <tr>


                          <td>
                              <b>Total Amount</b>
                          </td>

                          <td class="total">
                          <p id="serviceTotal"></p>
                          </td>
                      </tr>
  </table>

    <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
      <div class="form-group text-center">
          <label></label>

      </div>
      <script>
      $("#cust").change(function() {
          $('#cust-name').val($('option:selected').attr('data-name'));
          $('#cust-phone').val($('option:selected').attr('data-phone'));
          $('#cust-email').val($('option:selected').attr('data-email'));
      }).change();




      n =  new Date();
      y = n.getFullYear();
      m = n.getMonth() + 1;
      d = n.getDate();
      document.getElementById("date").innerHTML =  m + "/" + d + "/" + y;

      </script>
