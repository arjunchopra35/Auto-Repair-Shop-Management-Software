<script>
var selectedServices = [];
var total =[];
var servArr = [];
var edit = "<?php echo $edit; ?>";
$(document).ready(function() {
  $('.cust').select2();
});

$(document).ready(function() {
  $('.serv-code').select2();
});

$(document).ready(function() {
  $('.vehicle_id').select2();
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


$(document).ready(function(){
  $("#customer_form").submit(function(event){
    submitForm();
    return false;
  });
});
// function to handle form submit
function submitForm(){
  $.ajax({
    type: "POST",
    url: "add_customer.php",
    cache:false,
    data: $('form#customer_form').serialize(),
    success: function(response){
      $("#contact").html(response)
      $("#contact-modal").modal('hide');
    },
    error: function(){
      alert("Error");
    }
  });
}



$(document).ready(function(){
  $("#vehicle_form").submit(function(event){

    submitVehiForm();
    return false;
  });
});
// function to handle form submit
function submitVehiForm(){
  $.ajax({
    type: "POST",
    url: "add_vehicle.php",
    cache:false,
    data: $('form#vehicle_form').serialize(),
    success: function(response){
      $("#contact").html(response)
      $("#vehicle-modal").modal('hide');
    },
    error: function(){
      alert("Error");
    }
  });
}

$(document).ready(function(){
  $("#service_form").submit(function(event){
    submitServForm();

    return false;
  });
});
// function to handle form submit
function submitServForm(){
  $.ajax({
    type: "POST",
    url: "add_service.php",
    cache:false,
    data: $('form#service_form').serialize(),
    success: function(response){
      $("#contact").html(response)
      $("#service-modal").modal('hide');
    },
    error: function(){
      alert("Error");
    }
  });
}






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
    document.getElementById("vehicleinfo").innerHTML;
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

function updateDisc(disc){
  ftotal=0;
  for(var i in total){
    ftotal += parseFloat(total[i]);
  }
  ftotal = ftotal - parseFloat(disc);
  document.getElementById("subamount").innerHTML = ftotal.toFixed(2);
  var tax = ftotal*0.13;
  ftotal = ftotal + tax;
  document.getElementById("serviceTotal").innerHTML = ftotal.toFixed(2);
  document.getElementById("taxamount").innerHTML = tax.toFixed(2);
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
        var index = total.indexOf(parseFloat(this.responseText));
        if (index !== -1) {
          total.splice(index, 1);
        }

        var ftotal = 0;
        for(var i in total){
          ftotal += parseFloat(total[i]);
        }

        document.getElementById("subamount").innerHTML = ftotal.toFixed(2);
        var tax = ftotal*0.13;
        ftotal = ftotal + tax;
        document.getElementById("serviceTotal").innerHTML = ftotal.toFixed(2);
        document.getElementById("taxamount").innerHTML = tax.toFixed(2);
        console.log(ftotal);
        $('[name="total"]').val(ftotal);

      }
    };

    xmlhttp.open("GET","gettotal.php?s="+sinfo,true);
    xmlhttp.send();
  }
}

function updateJob()
{
    document.getElementById("job_status").value = "repair";
      document.getElementById("jst").innerText = "REPAIR ORDER";
      document.job_form.submit();
}

function updateInvJob()
{
    document.getElementById("job_status").value = "invoice";
      document.getElementById("kst").innerText = "INVOICE";
      document.job_form.submit();
}

function updateInspection()
{
  document.getElementById("inspection_status").value = "1";
  document.job_form.submit();
  location.href = "add_inspection.php?job_id=<?php echo $job['id']; ?>&operation=create";
}


function getTotal(sinfo){
  if (sinfo == "") {
    document.getElementById("serviceTotal").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        total.push(parseFloat(this.responseText));
        var ftotal = 0;
        for(var i in total){
          ftotal += parseFloat(total[i]);
        }
        document.getElementById("subamount").innerHTML = ftotal.toFixed(2);
        var tax = ftotal*0.13;
        ftotal = ftotal + tax;
        document.getElementById("serviceTotal").innerHTML = ftotal.toFixed(2);
        document.getElementById("taxamount").innerHTML = tax.toFixed(2);
        console.log(ftotal);
        $('[name="total"]').val(ftotal);


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

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
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
              <td class="title" width="30%">


                </td>


                  <td width="30%" >
                  </td>
                  <td width="40%" style="text-align:center;">
                    <br>

                    <!-- <p id ="date" class="date">
                      <?php #echo date("Y/m/d"); ?>
                    </p> -->

                    <!-- <input type="radio" form="job_form" id="estimate" name="job_status" checked value="estimate" <?php echo ($edit && $job['job_status'] =='estimate') ? "checked": "" ; ?>>
                    <label for="estimate"> Estimate</label><br>
                    <input type="radio" form="job_form" id="repair" name="job_status" value="repair" <?php echo ($edit && $job['job_status'] =='repair') ? "checked": "" ; ?>>
                    <label for="repair"> Repair Order</label><br>
                    <input type="radio" form="job_form" id="Invoice" name="job_status" value="invoice" <?php echo ($edit && $job['job_status'] =='invoice') ? "checked": "" ; ?>>
                    <label for="invoice"> Invoice</label> -->
                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                    <label for="job_comments">Comments:  </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input form="job_form" type="text" name="job_comments" value="<?php echo htmlspecialchars($edit ? $job['job_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control" id="job_comments">
                  </div>

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
                          <select form="job_form" id="cust" required width="100%" class="form-control cust" onchange="showUser(this.value, <?php echo htmlspecialchars($edit ? $vehi['id'] : '', ENT_QUOTES, 'UTF-8'); ?>)">
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
                              <a class="btn btn-success" data-toggle="modal" data-target="#contact-modal"> <i class="fa fa-user-plus"></i> Add</a> <br>
                              <div id="contact-modal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div style="padding:20px" class="modal-content">
                                    <div class="modal-header">
                                      <a class="close" data-dismiss="modal">×</a>
                                      <h3>Add New Customer</h3>
                                    </div>

                                    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">   </form>
                                    <div class="form-group">
                                      <label for="f_name">First Name *</label>
                                      <input type="text" form="customer_form" name="f_name" value="<?php echo htmlspecialchars($edit ? $customer['f_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="First Name" class="form-control" required="required" id = "f_name" >
                                    </div>

                                    <div class="form-group">
                                      <label for="l_name">Last name *</label>
                                      <input type="text" form="customer_form" name="l_name" value="<?php echo htmlspecialchars($edit ? $customer['l_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Last Name" class="form-control" required="required" id="l_name">
                                    </div>



                                    <div class="form-group">
                                      <label for="email">Email</label>
                                      <input  type="email" form="customer_form" name="email" value="<?php echo htmlspecialchars($edit ? $customer['email'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="E-Mail Address" class="form-control" id="email">
                                    </div>

                                    <div class="form-group">
                                      <label for="phone">Phone</label>
                                      <input name="phone" form="customer_form" value="<?php echo htmlspecialchars($edit ? $customer['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control"  type="text" id="phone">
                                    </div>

                                    <div class="form-group text-center">
                                      <label></label>
                                      <button type="submit" form="customer_form" name="custForm" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
                                    </div>


                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td style="background-color:#0075d4;"><label style="color:white">Customer Name</label></td>
                            <td style="text-align:left; background-color:#0075d4;"><label style="color:white">Customer Phone</label></td>

                          </tr>
                          <tr>
                            <td>
                              <input form="job_form" class="cust-label" style="border: 0; width:100%;"  id="cust-name">
                            </td>
                            <td style="text-align:left;">
                              <input form="job_form" style="border: 0; width:100%;" class="cust-label" for="phone" id="cust-phone">
                            </td>

                          </tr>
                          <tr>
                            <td colspan="2" style="background-color:#0075d4;"><label style="color:white">Customer Email</label></td>


                          </tr>
                          <tr>
                            <td colspan="2">

                              <input  form="job_form" class="cust-label" for="email" style="border: 0; width:100%;" id="cust-email">
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
                              <input form="job_form" type="hidden" name="arrived" value="0" />
                              <input form="job_form" type="checkbox" id="arrived" name="arrived" value="1" <?php echo ($edit && $job['arrived'] =='1') ? "checked": "" ; ?>>

                              <label for="vehicle1"> Arrived</label><br>

                            </td>
                          </tr>
                          <tr>
                            <td>

                              <input form="job_form" type="date" style="border: 0; width:100%;" class="cust-label" value="<?php echo htmlspecialchars($edit ? $job['estimate_date'] : '', ENT_QUOTES, 'UTF-8'); ?>" for="estimate_date" id="estimate_date" name="estimate_date">
                            </td>

                            <td>
                              <input form="job_form" type="hidden" name="est_complete" value="0" />
                              <input form="job_form" type="checkbox" id="est_complete" name="est_complete" value="1" <?php echo ($edit && $job['est_complete'] =='1') ? "checked": "" ; ?>>
                              <label for="vehicle2"> Est Complete</label><br>


                            </td>

                          </tr>
                          <tr>
                            <td style="background-color:#0075d4;">
                              <label style="color:white">
                                Repair Order Date
                              </label>

                            </td>

                            <td>
                              <input form="job_form" type="hidden" name="part_req" value="0" />
                              <input form="job_form" type="checkbox" id="part_req" name="part_req" value="1" <?php echo ($edit && $job['part_req'] =='1') ? "checked": "" ; ?>>
                              <label for="vehicle3"> Part Req.</label><br>

                            </td>

                          </tr>
                          <tr>
                            <td>
                              <input  form="job_form" type="date" style="border: 0; width:100%;" class="cust-label" name="repair_date" for="repair_date" id="repair_date" value="<?php echo htmlspecialchars($edit ? $job['repair_date'] : '', ENT_QUOTES, 'UTF-8'); ?>">
                            </td>


                            <td>
                              <input form="job_form" type="hidden" name="in_shop" value="0" />
                              <input form="job_form" type="checkbox" id="in_shop" name="in_shop" value="1" <?php echo ($edit && $job['in_shop'] =='1') ? "checked": "" ; ?>>
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
                              <input form="job_form" type="hidden" name="cust_waiting" value="0" />
                              <input form="job_form" type="checkbox" id="cust_waiting" name="cust_waiting" value="1" <?php echo ($edit && $job['cust_waiting'] =='1') ? "checked": "" ; ?>>
                              <label for="vehicle3"> Cust. Waiting</label><br>


                            </td>

                          </tr>
                          <tr>
                            <td>
                              <input form="job_form" type="date" style="border: 0; width:100%;" class="cust-label" name="invoice_date"  id="invoice_date" value="<?php echo htmlspecialchars($edit ? $job['invoice_date'] : '', ENT_QUOTES, 'UTF-8'); ?>">

                            </td>

                            <td>
                              <input form="job_form" type="hidden" name="completed" value="0" />
                              <input form="job_form" type="checkbox" id="completed" name="completed" value="1" <?php echo ($edit && $job['completed'] =='1') ? "checked": "" ; ?>>
                              <label for="vehicle3"> Completed</label>

                            </td>

                          </tr>
                        </table>



                      </td>


                      <td  style="text-align:center;">






                        <div colspan="3" class="tab">
                          <button class="tablinks"  onclick="openCity(event, 'vehicleTab')" id="defaultOpen">Vehicle Details</button>
                          <button class="tablinks" onclick="openCity(event, 'notes')">Notes</button>

                      </div>
                      <div id="vehicleTab" class="tabcontent" style="display:block">
                        <table width="100%">


                          <tr>
                            <td>
                              <div id="vehicle">
                                <!-- <a class="btn btn-success" data-toggle="modal" data-target="#modalForm1"><i class="glyphicon glyphicon-plus"></i> Existing Vehicle</a> -->
                                <select name="vehicle_id" form="job_form" id="vehic" class="form-control vehicle_id" onchange="showVehicle(this.value)" required>
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
                              </div>
                            </td>
                            <td>
                              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#vehicle-modal"><i class="glyphicon glyphicon-plus"></i> New Vehicle</a>
                              <div id="vehicle-modal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div style="padding:20px" class="modal-content">
                                    <div class="modal-header">
                                      <a class="close" data-dismiss="modal">×</a>
                                      <h3>Add New Vehicle</h3>
                                    </div>

                                    <form class="form" action="" method="post"  id="vehicle_form" enctype="multipart/form-data">   </form>
                                    <div class="form-group">
                                      <label for="vehicle_make">Vehicle Make *</label>
                                      <input form="vehicle_form" type="text" name="vehicle_make" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_make'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Make" class="form-control" required="required" id = "vehicle_make" >
                                    </div>

                                    <div class="form-group">
                                      <label for="vehicle_model">Vehicle Model *</label>
                                      <input form="vehicle_form" type="text" name="vehicle_model" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_model'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Model" class="form-control" required="required" id="vehicle_model">
                                    </div>



                                    <div class="form-group">
                                      <label for="vehicle_year">Vehicle Year</label>
                                      <input  form="vehicle_form" type="text" name="vehicle_year" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_year'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Year" class="form-control" id="vehicle_year">
                                    </div>

                                    <div class="form-group">
                                      <label for="vehicle_kms">Vehicle KMs</label>
                                      <input form="vehicle_form" name="vehicle_kms" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_kms'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Kilometers" class="form-control"  type="text" id="vehicle_kms">
                                    </div>

                                    <div class="form-group">
                                      <label for="vehicle_engine">Vehicle Engine</label>
                                      <input form="vehicle_form" name="vehicle_engine" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_engine'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Vehicle Engine" class="form-control"  type="text" id="vehicle_engine">
                                    </div>

                                    <div class="form-group">
                                      <label for="vehicle_vin">VIN No.</label>
                                      <input form="vehicle_form" name="vehicle_vin" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_vin'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="VIN No." class="form-control"  type="text" id="vehicle_vin">
                                    </div>

                                    <div class="form-group">
                                      <label for="vehicle_lic">License Plate Number</label>
                                      <input form="vehicle_form" name="vehicle_lic" value="<?php echo htmlspecialchars($edit ? $vehicle['vehicle_lic'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="License Plate Number" class="form-control"  type="text" id="vehicle_lic">
                                    </div>

                                    <div class="form-group">
                                      <label for="vehicle_owner_id">Vehicle Owner</label>
                                      <select form="vehicle_form" name="vehicle_owner_id"  class="form-control" >
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
                                      <button type="submit" form="vehicle_form" name="vehicleForm" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
                                    </div>


                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>

                            </td>
                          </tr>
                        </table>


                        <div id="vehicleinfo">
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
                                <input form="job_form" style="border: 0; width:100%;" class="cust-label" value="<?php echo htmlspecialchars($edit ? $vehi['vehicle_year'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Year">
                              </td>
                              <td>
                                <input form="job_form" style="border: 0; width:100%;" class="cust-label" value="<?php echo htmlspecialchars($edit ? $vehi['vehicle_make'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Make">
                              </td>
                              <td>
                                <input form="job_form" style="border: 0; width:100%;" class="cust-label" value="<?php echo htmlspecialchars($edit ? $vehi['vehicle_model'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Model">
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
                                <input form="job_form" style="border: 0; width:100%;" class="cust-label" value="<?php echo htmlspecialchars($edit ? $vehi['vehicle_vin'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="V.I.N. Number"><br>
                              </td>
                              <td>
                                <input form="job_form" style="border: 0; width:100%;" class="cust-label" value="<?php echo htmlspecialchars($edit ? $vehi['vehicle_lic'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="License Plate">
                              </td>
                              <td>
                                <input form="job_form" style="border: 0; width:100%;" class="cust-label" value="<?php echo htmlspecialchars($edit ? $vehi['vehicle_kms'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Kilometers">
                              </td>
                            </tr>
                          </table>
                        </div>
                        </div>
                        <div id="notes" class="tabcontent" style=height:100%;"">
                          <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes"  form="job_form" value="" placeholder="Enter Notes Here" class="form-control" id="notes"><?php echo htmlspecialchars($edit ? $job['notes'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                          </div>
                        </div>








                      </td>


                    </tr>
                  </table>
                </td>
              </tr>

              <tr class="information">
                <td colspan="2">
                  <input form="job_form" type="hidden" id="inspection_status" required="" name="inspection_status" value="<?php echo htmlspecialchars($edit ? $job['inspection_status'] : '0', ENT_QUOTES, 'UTF-8'); ?>">


                  <!-- <table width="100%">

                    <tr>
                      <td style="text-align:left; width: 25%;"><p>Job Status</p>

                        <br></td>
                        <td style="text-align:left; width: 50%;">
                          <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes"  form="job_form" value="" placeholder="Enter Notes Here" class="form-control" id="notes"><?php #echo htmlspecialchars($edit ? $job['notes'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                          </div>

                        </td>
                        <td style="text-align:center; width: 25%;">

                          <input form="job_form" type="radio" id="inspection_status" required="" name="inspection_status" value="1" <?php #echo ($edit && $job['inspection_status'] =='1') ? "checked": "" ; ?>>

                          <input form="job_form" type="radio" id="inspection_status" required="" name="inspection_status" value="0" <?php #echo ($edit && $job['inspection_status'] =='0') ? "checked": "" ; ?>>


                        </td>
                      </tr>


                    </table>

                  </td>
                </tr>

              </table> -->


              <!-- <table width="100%">
                <tr>
                  <label for="add_services">Add Services</label> &nbsp &nbsp &nbsp<a class="btn btn-success" data-toggle="modal" data-target="#service-modal"><i class="glyphicon glyphicon-plus"></i> Add New Service</a>
                  <div id="service-modal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div style="padding:20px" class="modal-content">
                        <div class="modal-header">
                          <a class="close" data-dismiss="modal">×</a>
                          <h3>Add New Service</h3>
                        </div>

                        <form class="form" action="" method="post"  id="service_form" enctype="multipart/form-data">   </form>
                        <div class="form-group">
                          <label for="service_code">Service Code *</label>
                          <input form="service_form" type="text" name="service_code" value="<?php #echo htmlspecialchars($edit ? $service['service_code'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Service Code" class="form-control" required="required" id = "service_code" >
                        </div>

                        <div class="form-group">
                          <label for="service_name">Service name *</label>
                          <input form="service_form" type="text" name="service_name" value="<?php #echo htmlspecialchars($edit ? $service['service_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Service Name" class="form-control" required="required" id="service_name">
                        </div>



                        <div class="form-group">
                          <label for="service_desc">Description</label>
                          <input form="service_form" type="textarea" name="service_desc" value="<?php #echo htmlspecialchars($edit ? $service['service_desc'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Description" class="form-control" id="service_desc">
                        </div>

                        <div class="form-group">
                          <label for="service_price">Price</label>
                          <input form="service_form" name="service_price" value="<?php #echo htmlspecialchars($edit ? $service['service_price'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Price" class="form-control"  type="text" id="service_price">
                        </div>

                        <div class="form-group text-center">
                          <label></label>
                          <button type="submit" form="service_form" name="servForm" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
                        </div>


                      </div>
                    </div>
                  </div>
                  <td>

                    <select id="cust" class="form-control" onchange="showServiceInfo(this.value);  getTotal(this.value);">
                      <option value="" selected="selected">Select Service</option>
                      <?php #foreach($services as $key => $service) : ?>
                        <?php #$selected = ($key == $service['service_code'] ? 'selected' : '') ?>
                        <option value = "<?php #echo($service['id']); ?>" data-name = "<?php #echo($service['service_code']. ' ' .$service['service_name']); ?>" data-desc = "<?php #echo($service['service_desc']); ?>" data-price = "<?php #echo($service['price']); ?>">
                          <?php #echo($service['service_code']. ' ' .$service['service_name']); ?>
                        </option>
                      <?php #endforeach; ?>
                    </select>

                    <div id="serviceinfo">


                    </div>



                  </td>

                  <td>
                    <div id="s-btn" name="s-btn"></div>


                  </td>
                </tr>


              </table> -->



            <table width="100%">
              <tr class="heading">
                <td style="width:10%">
                  <label class="wLabel">  CODE </label>
                </td>

                <td style="width:10%; text-align: left;">
                  <label class="wLabel">   Name </label>
                </td>
                <td style="width:30%">
                  <label class="wLabel">     Description </label>
                </td>


                <td style="width:5%">
                  <label class="wLabel">       Qty </label>
                </td>
                <td style="width:10%">
                  <label class="wLabel">     Price </label>
                </td>
                <td style="width:10%">
                  <label class="wLabel">     Discount </label>
                </td>
                <td style="width:10%">
                  <label class="wLabel">     Tax</label>
                </td>
                <td style="width:10%">
                  <label class="wLabel">     Total</label>
                </td>
                <td style="width:5%">
                  <label class="wLabel">     Delete</label>
                </td>
              </tr>
              <tbody id="serviceTable">
                <?php $servicesArray = htmlspecialchars($edit ? $job['serviceIds'] : '', ENT_QUOTES, 'UTF-8'); ?>
                <?php $currentServices = explode(',', $servicesArray); ?>
                <?php foreach ($currentServices as $currentService) : ?>

                  <?php $dbServices->where ('id', $currentService);?>
                  <?php $service = $dbServices->getOne("services");?>

                  <tr class="item">
                    <td>
                      <select id="serv-code" class="serv-code" onchange="showServiceInfo(this.value);  getTotal(this.value);">
                        <option value="" selected="selected">Select Service</option>
                        <?php foreach($services as $key => $service) : ?>
                          <?php $selected = ($key == $service['service_code'] ? 'selected' : '') ?>
                          <option value = "<?php echo($service['id']); ?>" data-name = "<?php echo($service['service_code']. ' ' .$service['service_name']); ?>" data-desc = "<?php echo($service['service_desc']); ?>" data-price = "<?php echo($service['price']); ?>">
                            <?php echo($service['service_code']); ?>
                          </option>
                        <?php endforeach; ?>
                      </select>

                    </td>
                    <td style="text-align:left;">
                      <input form="job_form"   id = "qty" >
                    </td>
                    <td>
                      <input form="job_form"  style="width:100%;">
                    </td>
                    <td>
                      <input form="job_form"  required="required" id = "qty" >
                    </td>

                    <td class="price">


                    </td>
                    <td class="price">


                    <td class="price">


                    </td>
                    <td class="price">


                    </td>
                    <td class="price">

                      <a href="#" id="d-btn" name="d-btn" value = "<?php echo($service['id']); ?>" onclick="delService(<?php echo($service['id']); ?>); updateTotal(<?php echo($service['id']); ?>); "><i class="fa fa-trash fa-fw"></i></a>
                    </td>

                  </tr>


                <?php endforeach; ?>


              </tbody>
              <?php $servicesArray = htmlspecialchars($edit ? $job['serviceIds'] : '', ENT_QUOTES, 'UTF-8'); ?>
              <?php $currentServices = explode(',', $servicesArray); ?>
              <?php foreach ($currentServices as $currentService) : ?>

                <?php $dbServices->where ('id', $currentService);?>
                <?php $service = $dbServices->getOne("services");?>

                <tr class="item">
                  <td>
                    <select id="serv-code" class="serv-code" onchange="showServiceInfo(this.value);  getTotal(this.value);">
                      <option value="" selected="selected">Select Service</option>
                      <?php foreach($services as $key => $service) : ?>
                        <?php $selected = ($key == $service['service_code'] ? 'selected' : '') ?>
                        <option value = "<?php echo($service['id']); ?>" data-name = "<?php echo($service['service_code']. ' ' .$service['service_name']); ?>" data-desc = "<?php echo($service['service_desc']); ?>" data-price = "<?php echo($service['price']); ?>">
                          <?php echo($service['service_code']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>

                  </td>
                  <td style="text-align:left;">
                    <input form="job_form" value="<?php echo($service['service_name']); ?>" >
                  </td>
                  <td>
                    <input form="job_form" value="<?php echo($service['service_desc']); ?>" style="width:100%;">
                  </td>
                  <td>
                    <input form="job_form" value="1"   id = "qty" >
                  </td>

                  <td class="price">
                  <?php echo($service['service_price']); ?>

                  </td>
                  <td class="price">
                  <input form="job_form"  id = "qty" >

                  <td class="price">
                    <?php $taxs = $service['service_price']*0.13; ?>
                  <?php  echo number_format((float)$taxs, 2, '.', ''); ?>

                  </td>
                  <td class="price">
                      <?php $totalser = $service['service_price']+$service['service_price']*0.13; ?>
                    <?php  echo number_format((float)$totalser, 2, '.', ''); ?>
                  </td>
                  <td class="price">

                    <a href="#" id="d-btn" name="d-btn" value <?php= "<?php echo($service['id']); ?>" onclick="delService(<?php echo($service['id']); ?>); updateTotal(<?php echo($service['id']); ?>); "><i class="fa fa-trash fa-fw"></i></a>
                  </td>

                </tr>


              <?php endforeach; ?>
            </table>
            <input form="job_form" type="hidden" id="serviceIds" name="serviceIds" value="<?php echo htmlspecialchars($edit ? $job['serviceIds'] : '', ENT_QUOTES, 'UTF-8'); ?>">
            <input form="job_form" type="hidden" id="total" name="total">

            <br>
            <br>
            <table  cellpadding="0" cellspacing="0">

            </table>
            <!-- <table width="50%">
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
                  <b>Discount</b>
                </td>

                <td class="discount">
                  <input form="job_form" id="discount" name="discount" onchange="updateDisc(this.value)" value="<?php #echo htmlspecialchars($edit ? $job['discount'] : '', ENT_QUOTES, 'UTF-8'); ?>">
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
            </table> -->




            <div class="form-group text-center">
              <label></label>

            </div>
            <script>
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

            var job_id = "<?php echo $job_id; ?>";


            n =  new Date();
            y = n.getFullYear();
            m = n.getMonth() + 1;
            d = n.getDate();
            document.getElementById("date").innerHTML =  m + "/" + d + "/" + y;

            $(document).ready(function(){
  $("#job_form").submit(function(event){
    if(edit == '1'){
      updateJobForm();
      var stat = document.getElementById("job_status").value;
      console.log(stat);
      if (stat == "repair"){
        window.location='http://localhost:8888/syed/repairs.php'
      }
      else if (stat == "invoice") {
        window.location='http://localhost:8888/syed/invoices.php'
      }
      else {
        window.location='http://localhost:8888/syed/estimates.php'
      }
      return false;

    } else {
    submitJobForm();
    var stat = document.getElementById("job_status").value;
    console.log(stat);
    if (stat == "repair"){
      window.location='http://localhost:8888/syed/repairs.php'
    }
    else if (stat == "invoice") {
      window.location='http://localhost:8888/syed/invoices.php'
    }
    else {
      window.location='http://localhost:8888/syed/estimates.php'
    }
    return false;
  }
  });
});
// function to handle form submit
function submitJobForm(){
  $.ajax({
    type: "POST",
    url: "add_job.php",
    cache:false,
    data: $('form#job_form').serialize(),
    success: function(response){

    },
    error: function(){
      alert("Error");
    }
  });
}

function updateJobForm(){
  $.ajax({
    type: "POST",
    url: "edit_job.php?job_id="+ job_id,
    cache:false,
    data: $('form#job_form').serialize(),
    success: function(response){
      console.log(response);
    },
    error: function(){
      alert("Error");
    }
  });
}


function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}





            </script>
