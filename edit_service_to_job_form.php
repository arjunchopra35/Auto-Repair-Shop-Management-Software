<script>
var selectedServices = [];


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
  xmlhttp.open("GET","geteditservice.php?r="+scode+"&job_id="+job_id,true);
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
  document.getElementById("serviceTable").innerHTML = this.responseText;
console.log(selectedServices);

}
};

xmlhttp.open("GET","geteditserviceinfo.php?s="+sinfo+"&job_id="+job_id,true);
xmlhttp.send();
}
}


function delService(sid, job_id){
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
  document.getElementById("serviceTable").innerHTML = this.responseText;


}
};

xmlhttp.open("GET","deleditserviceinfo.php?s="+sid+"&job_id="+job_id,true);
xmlhttp.send();
}
}

// function updateTotal(sinfo, job_id){
// if (sinfo == "") {
//   document.getElementById("serviceTotal").innerHTML = "";
// return;
// } else {
// var xmlhttp = new XMLHttpRequest();
// xmlhttp.onreadystatechange = function() {
// if (this.readyState == 4 && this.status == 200) {
//   var ftotal = parseInt(this.responseText);
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
// xmlhttp.open("GET","getedittotal.php?s="+sinfo+"&job_id="+job_id,true);
// xmlhttp.send();
// }
// }

function getTotal(sinfo, job_id){
if (sinfo == "") {
  document.getElementById("serviceTotal").innerHTML = "";
return;
} else {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  var ftotal = parseInt(this.responseText);
  console.log(this.responseText);
  document.getElementById("subamount").innerHTML = ftotal;
  console.log(ftotal);
  var tax = ftotal*0.13;
  ftotal = ftotal + tax;
  document.getElementById("serviceTotal").innerHTML = ftotal;
  document.getElementById("taxamount").innerHTML = Math.round(tax*100)/100;
  console.log(tax);
  console.log(ftotal);

}
};

xmlhttp.open("GET","getedittotal.php?s="+sinfo+"&job_id="+job_id,true);
xmlhttp.send();
}
}

</script>
<?php
require_once './config/config.php';
require_once './includes/auth_validate.php';


require_once 'includes/header.php';

$db = getDbInstance();
$job_id = filter_input(INPUT_GET, 'job_id', FILTER_VALIDATE_INT);
$db->where ('id', $job_id);
$job = $db->getOne ("jobs");

$dbvehicle = getDbInstance();
$dbvehicle->where ('id', $job['vehicle_id']);
$vehicle = $dbvehicle->getOne ("vehicles");
$subtotal = 0;



$dbcustomer = getDbInstance();
$dbcustomer->where ('id', $vehicle['vehicle_owner_id']);
$customer = $dbcustomer->getOne ("customers");

$dbServices = getDbInstance();
$selectServices = array('id','service_code','service_name','service_desc','service_price');
$services = $dbServices->get("services",null,$selectServices);

$dbJobService = getDbInstance();
$dbJobService->where('job_id',$job_id);
$currentServices = array();
$jobServices = $dbJobService->getValue("job_service","service_id", null);
if ($jobServices != NULL){
foreach ($jobServices as $jobService){
  $currentServices[] = $jobService;
}
}


?>

<style>
    .cust-label{
      font-weight:normal;
      margin-bottom: 0px;
    }
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
  <div class="invoice-box">
      <table cellpadding="0" cellspacing="0">
          <tr class="top">
              <td colspan="2">
                  <table>
                      <tr>
                          <td class="title">
                              <img src="assets/images/1.png" style="width:140px; max-width:140px; float: left;"><h5><br><br>24 Melham Ct UNIT 7,<br>
                                Scarborough, ON M1B 2T8<br>
                                +1 416 807 3444</td></h5>

                            </td>
                          <td>
                            <br>
                              ESTIMATE
                              <p id ="date" class="date">January 1, 2021</p>

                          </td>
                      </tr>
                  </table>
              </td>
          </tr>

          <tr class="information">
              <td colspan="2">
                  <table>
                      <tr>
                          <td>
                            <label for="vehicle_owner_id">To</label><br>

                            <?php echo($customer['f_name'].' '.$customer['l_name']); ?><br>
                            <?php echo($customer['phone']); ?><br>
                            <?php echo($customer['email']); ?>




                          </td>


                          <td>

                            <label  for="vehicle_id">Vehicle Details</label><br>

                                <?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?><br>
                                  <?php echo($vehicle['vehicle_kms']); ?><br>
                                  <?php echo($vehicle['vehicle_vin']); ?><br>
                                  <?php echo($vehicle['vehicle_lic']); ?>



                          </td>
                      </tr>
                      <!-- <tr>
                      <td><p>Job Status</p>
                     <input type="radio" id="estimate" name="job_status" value="estimate">
                     <label for="estimate"> Estimate</label><br>
                     <input type="radio" id="repair" name="job_status" value="repair">
                     <label for="repair"> Repair Order</label><br>
                     <input type="radio" id="Invoice" name="job_status" value="invoice">
                     <label for="invoice"> Invoice</label>
                   <br></td>
                      <td>
                         <label for="inspection_status"> Attach Inspection Sheet</label><br>
                        <input type="checkbox" id="inspection_status" name="inspection_status" value="1">

                      </td>
                    </tr> -->


                  </table>
              </td>
          </tr>

    <div >
        <table cellpadding="0" cellspacing="0">

            <tr class="information">
                <td colspan="2">
                  <table>
                    <tr>
                      <label for="add_services">Add Services</label>
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
                        <div id="serviceinfo"></div>



                        </td>

                        <td>
                          <div id="s-btn" name="s-btn"></div>


                        </td>
                    </tr>
                  </table>
                </td>
            </tr>

            <!-- <tr class="heading">
                <td>
                    Payment Method
                </td>

                <td>
                    Check #
                </td>
            </tr>

            <tr class="details">
                <td>
                    Check
                </td>

                <td>
                    1000
                </td>
            </tr> -->

<table>
            <tr class="heading">

                <td>
                    Description
                </td>


                <td>
                    Amount
                </td>
            </tr>
</table>
<table  cellpadding="0" cellspacing="0">
  <tbody id="serviceTable">
    <?php foreach ($currentServices as $currentService) : ?>
      <?php $dbServices->where ('id', $currentService);?>
      <?php $services = $dbServices->get("services");?>
    <?php foreach($services as $key => $service) : ?>
  <tr class="item">
        <td>
            <?php echo($service['service_code'].' - '.$service['service_name']); ?><br>
          <?php echo($service['service_desc']); ?>
        </td>

        <td class="price">
            <?php echo($service['service_price']); ?>
            <a href="#" id="d-btn" name="d-btn" value = "<?php echo($service['id']); ?>" onclick="delService(<?php echo($service['id']); ?>, <?php echo $job_id; ?>); "><i class="fa fa-trash fa-fw"></i></a>
            <?php $subtotal += $service['service_price'];?>
        </td>

    </tr>


<?php endforeach; ?>
  <?php endforeach; ?>
  <tr>


      <td>
          <b>Sub-total</b>
      </td>

      <td class="sub">
      <p id="subamount"><?php echo $subtotal; ?>
      </p>
      </td>
  </tr>
                    <tr>


                        <td>
                            <b>Tax GST (13%)</b>
                        </td>

                        <td class="tax"><?php $taxAmt = $subtotal*0.13; ?>
                        <p id="taxamount"><?php echo $taxAmt; ?></p>

                        </td>
                    </tr>
                    <tr>


                        <td>
                            <b>Total Amount</b>
                        </td>

                        <td class="total">
                        <p id="serviceTotal"><?php echo $subtotal + $taxAmt?></p>
                        </td>
                    </tr>
</tbody>
</table>


  <h6>Estimate good for 15 days. Not responsible for damage caused by theft, fire or act of nature. I hereby authorize the above repairs, include sublet work along with the necessary materials.</h6>
  <h6>You and your employee may operate my vehicle for the purpose of testing, inspection, and delivery at my risk. If i cancel repairs prior to their completion for any reason a tear down and assembly fee will be applied.</h6>
  <br><br>

  x ___________________________        Date _____________



    </div>
    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>

<?php include_once 'includes/footer.php'; ?>
