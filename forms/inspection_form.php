
<?php
$dbj = getDbInstance();
$dbj->where ('id', $job_id);
$job = $dbj->getOne ("jobs");

$dbvehicle = getDbInstance();
$dbvehicle->where ('id', $job['vehicle_id']);
$vehicle = $dbvehicle->getOne ("vehicles");
?>
<style>
.invoice-box {
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

/* .invoice-box table tr td:nth-child(2) {
text-align: right;
} */

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

/* .invoice-box table tr.total td:nth-child(2) {
border-top: 2px solid #eee;
font-weight: bold;
} */

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
  /* text-align: right; */
}

/* .rtl table tr td:nth-child(2) {
text-align: left;
} */
</style>
<fieldset>
  <div id="main" class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td>
          <table>
            <tr>
              <td>
                <h3><?php echo($vehicle['vehicle_make']. ' ' .$vehicle['vehicle_model'].' ' .$vehicle['vehicle_year']); ?></h4>
                  <br>
                <div class="form-group">
                  <label for="vin">VIN Number</label>
                  <input type="text" name="vin" value="<?php echo $vehicle['vehicle_vin']; ?>" placeholder="Vin" class="form-control" required="required" id = "Vin" >
                </div>
              </td>

              <td style="text-align: right;">
                <h3>Date: <?php echo date('Y-m-d'); ?></h3>
                <div class="form-group">
                  <br>
                  <label for="Plate">Plate</label>
                  <input type="text" name="plate" value="<?php echo $vehicle['vehicle_lic']; ?>" placeholder="Plate" class="form-control" required="required" id="Plate">
                </div>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td>
          <table>
            <tr>
              <td>
                <div class="form-group">
                  <label for="odo_in">Odometer In</label>
                  <input  type="odo_in" name="odo_in" value="<?php echo $vehicle['vehicle_kms']; ?>" placeholder="Odometers In" class="form-control" id="odo_in">
                </div>

              </td>

              <td>

                <div class="form-group">
                  <label for="odo_out">Odometer Out</label>
                  <input name="odo_out" value="<?php echo htmlspecialchars($edit ? $inspection['odo_out'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Odometer Out" class="form-control"  type="text" id="odo_out">
                </div>

              </td>

            </tr>
          </table>
        </td>
      </tr>

      <tr >
        <td>

        </td>
      </tr>



      <tr class="details">
        <td>


        </td>

        <td>

        </td>
      </tr>

    </table>

    <table>
      <tr class="heading">
        <td>
          <div class="form-group">
            <label class="control-label">Items</label>

          </div>

        </td>

        <td>
          <div class="radio-head">

            <p>✓&nbsp&nbsp - &nbsp&nbsp  x</p>




          </div>
        </div>

      </td>
      <td colspan="2">
        Additional Details
      </td>

      <td>
        <div class="form-group">
          <label >Comments</label>

        </div>

      </td>

    </tr>
    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Powetrain</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="powertrain" value="ok" checked required="" <?php echo ($edit && $inspection_powertrain['powertrain'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="powertrain" value="suggested" required="" <?php echo ($edit && $inspection_powertrain['powertrain'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="powertrain" value="required" required="" <?php echo ($edit && $inspection_powertrain['powertrain'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="powertrain_comments" value="<?php echo htmlspecialchars($edit ? $inspection_powertrain['powertrain_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Powertrain comments" class="form-control"  type="text" id="powertrain_comments">
        </div>

      </td>

    </tr>

    <!-- suspension -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Suspension</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="suspension" value="ok" checked required="" <?php echo ($edit && $inspection_suspension['suspension'] =='ok') ? "checked": "" ; ?>/>

            <input type="radio" name="suspension" value="suggested" required="" <?php echo ($edit && $inspection_suspension['suspension'] =='suggested') ? "checked": "" ; ?>/>

            <input type="radio" name="suspension" value="required" required="" <?php echo ($edit && $inspection_suspension['suspension'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="suspension_comments" value="<?php echo htmlspecialchars($edit ? $inspection_suspension['suspension_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="suspension comments" class="form-control"  type="text" id="suspension_comments">
        </div>

      </td>

    </tr>

    <!-- brake systems -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">brake Systems</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="brake" value="ok" checked required="" <?php echo ($edit && $inspection_brake['brake'] =='ok') ? "checked": "" ; ?>/>

            <input type="radio" name="brake" value="suggested" required="" <?php echo ($edit && $inspection_brake['brake'] =='suggested') ? "checked": "" ; ?>/>

            <input type="radio" name="brake" value="required" required="" <?php echo ($edit && $inspection_brake['brake'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="brake_comments" value="<?php echo htmlspecialchars($edit ? $inspection_brake['brake_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="brake Comments" class="form-control"  type="text" id="brake_comments">
        </div>

      </td>

    </tr>
    <!-- Left Front Pads -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Left Front Pads</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="lfp" value="ok" checked required="" <?php echo ($edit && $inspection_brake['lfp'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="lfp" value="suggested" required="" <?php echo ($edit && $inspection_brake['lfp'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="lfp" value="required" required="" <?php echo ($edit && $inspection_brake['lfp'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="lfp_inner"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['lfp_inner'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Inner" class="form-control"  type="text" id="lfp_inner">
      </td>
      <td>
        <input name="lfp_outer"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['lfp_outer'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Outer" class="form-control"  type="text" id="lfp_outer">



      </td>

      <td>
        <div class="form-group">
          <input name="lfp_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['lfp_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="lfp_com">
        </div>

      </td>

    </tr>

    <!-- RightFront Pads -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Right Front Pads</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="rfp" value="ok" checked required="" <?php echo ($edit && $inspection_brake['rfp'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="rfp" value="suggested" required="" <?php echo ($edit && $inspection_brake['rfp'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="rfp" value="required" required="" <?php echo ($edit && $inspection_brake['rfp'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="rfp_inner"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rfp_inner'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Inner" class="form-control"  type="text" id="rfp_inner">
      </td>
      <td>
        <input name="rfp_outer"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rfp_outer'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Outer" class="form-control"  type="text" id="rfp_outer">



      </td>

      <td>
        <div class="form-group">
          <input name="rfp_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['rfp_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="rfp_com">
        </div>

      </td>

    </tr>

    <!-- Left Rear Pads -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Left Rear Pads</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="lrp" value="ok" checked required="" <?php echo ($edit && $inspection_brake['lrp'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="lrp" value="suggested" required="" <?php echo ($edit && $inspection_brake['lrp'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="lrp" value="required" required="" <?php echo ($edit && $inspection_brake['lrp'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="lrp_inner"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['lrp_inner'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Inner" class="form-control"  type="text" id="lrp_inner">
      </td>
      <td>
        <input name="lrp_outer"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['lrp_outer'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Outer" class="form-control"  type="text" id="lrp_outer">



      </td>

      <td>
        <div class="form-group">
          <input name="lrp_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['lrp_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="lrp_com">
        </div>

      </td>

    </tr>
    <!-- Right Rear Pads -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Right Rear Pads</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="rrp" value="ok" checked required="" <?php echo ($edit && $inspection_brake['rrp'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="rrp" value="suggested" required="" <?php echo ($edit && $inspection_brake['rrp'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="rrp" value="required" required="" <?php echo ($edit && $inspection_brake['rrp'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="rrp_inner"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rrp_inner'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Inner" class="form-control"  type="text" id="rrp_inner">
      </td>
      <td>
        <input name="rrp_outer"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rrp_outer'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Outer" class="form-control"  type="text" id="rrp_outer">



      </td>

      <td>
        <div class="form-group">
          <input name="rrp_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['rrp_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="rrp_com">
        </div>

      </td>

    </tr>

    <!-- Front Rotors or drums -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Front Rotors or Drums</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="frod" value="ok" checked required="" <?php echo ($edit && $inspection_brake['frod'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="frod" value="suggested" required="" <?php echo ($edit && $inspection_brake['frod'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="frod" value="required" required="" <?php echo ($edit && $inspection_brake['frod'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="frod_left"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['frod_left'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Left" class="form-control"  type="text" id="frod_left">
      </td>
      <td>
        <input name="frod_right"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['frod_right'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Right" class="form-control"  type="text" id="frod_right">



      </td>

      <td>
        <div class="form-group">
          <input name="frod_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['frod_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="frod_com">
        </div>

      </td>

    </tr>

    <!-- Rear Rotors or drums -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Rear Rotors or Drums</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="rrod" value="ok" checked required="" <?php echo ($edit && $inspection_brake['rrod'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="rrod" value="suggested" required="" <?php echo ($edit && $inspection_brake['rrod'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="rrod" value="required" required="" <?php echo ($edit && $inspection_brake['rrod'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="rrod_left"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rrod_left'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Left" class="form-control"  type="text" id="rrod_left">
      </td>
      <td>
        <input name="rrod_right"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rrod_right'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Right" class="form-control"  type="text" id="rrod_right">



      </td>

      <td>
        <div class="form-group">
          <input name="rrod_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['rrod_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="rrod_com">
        </div>

      </td>

    </tr>
    <!-- Front Brake Shoes -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Front Brake Shoes</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="fbs" value="ok" checked required="" <?php echo ($edit && $inspection_brake['fbs'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="fbs" value="suggested" required="" <?php echo ($edit && $inspection_brake['fbs'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="fbs" value="required" required="" <?php echo ($edit && $inspection_brake['fbs'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="fbs_left"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['fbs_left'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Left" class="form-control"  type="text" id="fbs_left">
      </td>
      <td>
        <input name="fbs_right"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['fbs_right'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Right" class="form-control"  type="text" id="fbs_right">



      </td>

      <td>
        <div class="form-group">
          <input name="fbs_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['fbs_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="fbs_com">
        </div>

      </td>

    </tr>
    <!-- Rear Brake Shoes -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Rear Brake Shoes</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="rbs" value="ok" checked required="" <?php echo ($edit && $inspection_brake['rbs'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="rbs" value="suggested" required="" <?php echo ($edit && $inspection_brake['rbs'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="rbs" value="required" required="" <?php echo ($edit && $inspection_brake['rbs'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>

      <td>


        <input name="rbs_left"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rbs_left'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Left" class="form-control"  type="text" id="rbs_left">
      </td>
      <td>
        <input name="rbs_right"  value="<?php echo htmlspecialchars($edit ? $inspection_brake['rbs_right'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Right" class="form-control"  type="text" id="rbs_right">



      </td>

      <td>
        <div class="form-group">
          <input name="rbs_com" value="<?php echo htmlspecialchars($edit ? $inspection_brake['rbs_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="rbs_com">
        </div>

      </td>

    </tr>
<!-- Steering -->
    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Steering</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="steering" value="ok" checked required="" <?php echo ($edit && $inspection_steering['steering'] =='ok') ? "checked": "" ; ?>/>



            <input type="radio" name="steering" value="suggested" required="" <?php echo ($edit && $inspection_steering['steering'] =='suggested') ? "checked": "" ; ?>/>



            <input type="radio" name="steering" value="required" required="" <?php echo ($edit && $inspection_steering['steering'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="steering_comments" value="<?php echo htmlspecialchars($edit ? $inspection_steering['steering_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="steering comments" class="form-control"  type="text" id="steering_comments">
        </div>

      </td>

    </tr>

    <!-- Instruments and Aux Equipment -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Instruments and Aux Equipment</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="iaae" value="ok" checked required="" <?php echo ($edit && $inspection_iaae['iaae'] =='ok') ? "checked": "" ; ?>/>

            <input type="radio" name="iaae" value="suggested" required="" <?php echo ($edit && $inspection_iaae['iaae'] =='suggested') ? "checked": "" ; ?>/>

            <input type="radio" name="iaae" value="required" required="" <?php echo ($edit && $inspection_iaae['iaae'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="iaae_comments" value="<?php echo htmlspecialchars($edit ? $inspection_iaae['iaae_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="iaae comments" class="form-control"  type="text" id="iaae_comments">
        </div>

      </td>

    </tr>

    <!-- Lamps -->

    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Lamps</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="lamp" value="ok" checked required="" <?php echo ($edit && $inspection_lamp['lamp'] =='ok') ? "checked": "" ; ?>/>

            <input type="radio" name="lamp" value="suggested" required="" <?php echo ($edit && $inspection_lamp['lamp'] =='suggested') ? "checked": "" ; ?>/>

            <input type="radio" name="lamp" value="required" required="" <?php echo ($edit && $inspection_lamp['lamp'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="lamp_comments" value="<?php echo htmlspecialchars($edit ? $inspection_lamp['lamp_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="lamp Comments" class="form-control"  type="text" id="lamp_comments">
        </div>

      </td>

    </tr>
<!-- Electrical -->
    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Electrical Systems</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="electrical" value="ok" checked required="" <?php echo ($edit && $inspection_electrical['electrical'] =='ok') ? "checked": "" ; ?>/>

            <input type="radio" name="electrical" value="suggested" required="" <?php echo ($edit && $inspection_electrical['electrical'] =='suggested') ? "checked": "" ; ?>/>

            <input type="radio" name="electrical" value="required" required="" <?php echo ($edit && $inspection_electrical['electrical'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="electrical_comments" value="<?php echo htmlspecialchars($edit ? $inspection_electrical['electrical_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="electrical Comments" class="form-control"  type="text" id="electrical_comments">
        </div>

      </td>

    </tr>
    <!-- Body -->
    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Body</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="body" value="ok" checked required="" <?php echo ($edit && $inspection_body['body'] =='ok') ? "checked": "" ; ?>/>

            <input type="radio" name="body" value="suggested" required="" <?php echo ($edit && $inspection_body['body'] =='suggested') ? "checked": "" ; ?>/>

            <input type="radio" name="body" value="required" required="" <?php echo ($edit && $inspection_body['body'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="body_comments" value="<?php echo htmlspecialchars($edit ? $inspection_body['body_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="body Comments" class="form-control"  type="text" id="body_comments">
        </div>

      </td>

    </tr>
    <tr>
      <td>
        <div class="form-group">
          <label class="control-label">Tint</label>

        </div>

      </td>

      <td>
        <div>
          <div>

            <input type="radio" name="tint" value="ok" checked required="" <?php echo ($edit && $inspection_body['tint'] =='ok') ? "checked": "" ; ?>/>

            <input type="radio" name="tint" value="suggested" required="" <?php echo ($edit && $inspection_body['tint'] =='suggested') ? "checked": "" ; ?>/>

            <input type="radio" name="tint" value="required" required="" <?php echo ($edit && $inspection_body['tint'] =='required') ? "checked": "" ; ?>/>

          </div>
        </div>

      </td>
      <td>

      </td>
      <td>

      </td>

      <td>
        <div class="form-group">
          <input name="tint_com" value="<?php echo htmlspecialchars($edit ? $inspection_body['tint_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Tint Comments" class="form-control"  type="text" id="tint_com">
        </div>

      </td>

    </tr>

<!-- Tire and Wheel -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Tire and Wheel</label>

    </div>

  </td>

  <td>
    <div>
      <div>

        <input type="radio" name="tire" value="ok" checked required="" <?php echo ($edit && $inspection_tire['tire'] =='ok') ? "checked": "" ; ?>/>

        <input type="radio" name="tire" value="suggested" required="" <?php echo ($edit && $inspection_tire['tire'] =='suggested') ? "checked": "" ; ?>/>

        <input type="radio" name="tire" value="required" required="" <?php echo ($edit && $inspection_tire['tire'] =='required') ? "checked": "" ; ?>/>

      </div>
    </div>

  </td>
  <td>

  </td>
  <td>

  </td>

  <td>
    <div class="form-group">
      <input name="tire_comments" value="<?php echo htmlspecialchars($edit ? $inspection_tire['tire_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="tire Comments" class="form-control"  type="text" id="tire_comments">
    </div>

  </td>

</tr>
<!-- Front Tread Depth -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Front Tread Depth</label>

    </div>

  </td>

  <td>
    <div>
      <div>

        <input type="radio" name="ftd" value="ok" checked required="" <?php echo ($edit && $inspection_tire['ftd'] =='ok') ? "checked": "" ; ?>/>



        <input type="radio" name="ftd" value="suggested" required="" <?php echo ($edit && $inspection_tire['ftd'] =='suggested') ? "checked": "" ; ?>/>



        <input type="radio" name="ftd" value="required" required="" <?php echo ($edit && $inspection_tire['ftd'] =='required') ? "checked": "" ; ?>/>

      </div>
    </div>

  </td>

  <td>


    <input name="ftd_left"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['ftd_left'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Left" class="form-control"  type="text" id="ftd_left">
  </td>
  <td>
    <input name="ftd_right"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['ftd_right'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Right" class="form-control"  type="text" id="ftd_right">



  </td>

  <td>
    <div class="form-group">
      <input name="ftd_com" value="<?php echo htmlspecialchars($edit ? $inspection_tire['ftd_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="ftd_com">
    </div>

  </td>

</tr>

<!-- Rear Tread Depth -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Rear Tread Depth</label>

    </div>

  </td>

  <td>
    <div>
      <div>

        <input type="radio" name="rtd" value="ok" checked required="" <?php echo ($edit && $inspection_tire['rtd'] =='ok') ? "checked": "" ; ?>/>



        <input type="radio" name="rtd" value="suggested" required="" <?php echo ($edit && $inspection_tire['rtd'] =='suggested') ? "checked": "" ; ?>/>



        <input type="radio" name="rtd" value="required" required="" <?php echo ($edit && $inspection_tire['rtd'] =='required') ? "checked": "" ; ?>/>

      </div>
    </div>

  </td>

  <td>


      <input name="rtd_left"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['rtd_left'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Left" class="form-control"  type="text" id="rtd_left">
  </td>
  <td>
    <input name="rtd_right"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['rtd_right'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Right" class="form-control"  type="text" id="rtd_right">



  </td>

  <td>
    <div class="form-group">
      <input name="rtd_com" value="<?php echo htmlspecialchars($edit ? $inspection_tire['rtd_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="rtd_com">
    </div>

  </td>

</tr>

<!-- Tire Pressure Front Left-->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Front Left</label>

    </div>

  </td>

  <td>
    <div>
      <div>


      </div>
    </div>

  </td>

  <td>


    <input name="tpfl_after"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tpfl_after'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="After" class="form-control"  type="text" id="tpfl_after">
  </td>
  <td>
    <input name="tpfl_before"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tpfl_before'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Before" class="form-control"  type="text" id="tpfl_before">



  </td>

  <td>
    <div class="form-group">
      <input name="tpfl_com" value="<?php echo htmlspecialchars($edit ? $inspection_tire['tpfl_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="tpfl_com">
    </div>

  </td>

</tr>
<!-- Tire Pressure Front Right-->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Front Right</label>

    </div>

  </td>

  <td>
    <div>
      <div>



      </div>
    </div>

  </td>

  <td>


    <input name="tpfr_after"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tpfr_after'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="After" class="form-control"  type="text" id="tpfr_after">
  </td>
  <td>
    <input name="tpfr_before"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tpfr_before'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Before" class="form-control"  type="text" id="tpfr_before">



  </td>

  <td>
    <div class="form-group">
      <input name="tpfr_com" value="<?php echo htmlspecialchars($edit ? $inspection_tire['tpfr_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="tpfr_com">
    </div>

  </td>

</tr>
<!-- Tire Pressure Rear Left-->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Rear Left</label>

    </div>

  </td>

  <td>
    <div>
      <div>


      </div>
    </div>

  </td>

  <td>


    <input name="tprl_after"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tprl_after'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="After" class="form-control"  type="text" id="tprl_after">
  </td>
  <td>
    <input name="tprl_before"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tprl_before'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Before" class="form-control"  type="text" id="tprl_before">



  </td>

  <td>
    <div class="form-group">
      <input name="tprl_com" value="<?php echo htmlspecialchars($edit ? $inspection_tire['tprl_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="tprl_com">
    </div>

  </td>

</tr>
<!-- Tire Pressure Rear Right-->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Rear Right</label>

    </div>

  </td>

  <td>
    <div>
      <div>



      </div>
    </div>

  </td>

  <td>


    <input name="tprr_after"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tprr_after'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="After" class="form-control"  type="text" id="tprr_after">
  </td>
  <td>
    <input name="tprr_before"  value="<?php echo htmlspecialchars($edit ? $inspection_tire['tprr_before'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Before" class="form-control"  type="text" id="tprr_before">



  </td>

  <td>
    <div class="form-group">
      <input name="tprr_com" value="<?php echo htmlspecialchars($edit ? $inspection_tire['tprr_com'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Comments" class="form-control"  type="text" id="tprr_com">
    </div>

  </td>

</tr>
<!-- Coupling Devices -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Coupling Devices</label>

    </div>

  </td>

  <td>
    <div>
      <div>

        <input type="radio" name="coupling" value="ok" checked required="" <?php echo ($edit && $inspection_coupling['coupling'] =='ok') ? "checked": "" ; ?>/>

        <input type="radio" name="coupling" value="suggested" required="" <?php echo ($edit && $inspection_coupling['coupling'] =='suggested') ? "checked": "" ; ?>/>

        <input type="radio" name="coupling" value="required" required="" <?php echo ($edit && $inspection_coupling['coupling'] =='required') ? "checked": "" ; ?>/>

      </div>
    </div>

  </td>
  <td>

  </td>
  <td>

  </td>

  <td>
    <div class="form-group">
      <input name="coupling_comments" value="<?php echo htmlspecialchars($edit ? $inspection_coupling['coupling_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="coupling Comments" class="form-control"  type="text" id="coupling_comments">
    </div>

  </td>

</tr>
<!-- Road Test -->
<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Road Test</label>

    </div>

  </td>

  <td>
    <div>
      <div>

        <input type="radio" name="road_test" value="ok" checked required="" <?php echo ($edit && $inspection_road['road_test'] =='ok') ? "checked": "" ; ?>/>

        <input type="radio" name="road_test" value="suggested" required="" <?php echo ($edit && $inspection_road['road_test'] =='suggested') ? "checked": "" ; ?>/>

        <input type="radio" name="road_test" value="required" required="" <?php echo ($edit && $inspection_road['road_test'] =='required') ? "checked": "" ; ?>/>

      </div>
    </div>

  </td>
  <td>

  </td>
  <td>

  </td>

  <td>
    <div class="form-group">
      <input name="road_comments" value="<?php echo htmlspecialchars($edit ? $inspection_road['road_comments'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="road Comments" class="form-control"  type="text" id="road_comments">
    </div>

  </td>

</tr>

<!-- ABS -->
<tr>
  <td>
    <div class="form-group">
      <label class="control-label">ABS</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>

        <input type="radio" name="abs" value="off" checked required="" <?php echo ($edit && $inspection_road['abs'] =='off') ? "checked": "" ; ?>/> Off &nbsp&nbsp&nbsp

        <input type="radio" name="abs" value="on" required="" <?php echo ($edit && $inspection_road['abs'] =='on') ? "checked": "" ; ?>/> On



      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>

<!-- TPMS -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">TPMS</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>

        <input type="radio" name="tpms" value="off" checked required="" <?php echo ($edit && $inspection_road['tpms'] =='off') ? "checked": "" ; ?>/> Off &nbsp&nbsp&nbsp

        <input type="radio" name="tpms" value="on" required="" <?php echo ($edit && $inspection_road['tpms'] =='on') ? "checked": "" ; ?>/> On



      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>

<!-- Check Engine -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Check Engine</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>

        <input type="radio" name="check_engine" value="off" checked required="" <?php echo ($edit && $inspection_road['check_engine'] =='off') ? "checked": "" ; ?>/> Off &nbsp&nbsp&nbsp

        <input type="radio" name="check_engine" value="on" required="" <?php echo ($edit && $inspection_road['check_engine'] =='on') ? "checked": "" ; ?>/> On



      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>

<!-- Air Bags -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Air Bags</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>

        <input type="radio" name="air_bags" value="off" checked required="" <?php echo ($edit && $inspection_road['air_bags'] =='off') ? "checked": "" ; ?>/> Off &nbsp&nbsp&nbsp

        <input type="radio" name="air_bags" value="on" required="" <?php echo ($edit && $inspection_road['air_bags'] =='on') ? "checked": "" ; ?>/> On



      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>

<!-- Electronic Safety Control -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Electronic Safety Control</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>

        <input type="radio" name="esc" value="off" checked required="" <?php echo ($edit && $inspection_road['esc'] =='off') ? "checked": "" ; ?>/> Off &nbsp&nbsp&nbsp

        <input type="radio" name="esc" value="on" required="" <?php echo ($edit && $inspection_road['esc'] =='on') ? "checked": "" ; ?>/> On



      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>

<!-- Other Lights -->


<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Other Lights</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>

        <input type="radio" name="other_lights" value="off" checked required="" <?php echo ($edit && $inspection_road['other_lights'] =='off') ? "checked": "" ; ?>/> Off &nbsp&nbsp&nbsp

        <input type="radio" name="other_lights" value="on" required="" <?php echo ($edit && $inspection_road['other_lights'] =='on') ? "checked": "" ; ?>/> On



      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>

<!-- Ministry information -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Safety Cetificate Number</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>
        <div class="form-group">
          <input name="safety_cert_no" value="<?php echo htmlspecialchars($edit ? $ministry_req_info['safety_cert_no'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Safety Cert. Number" class="form-control"  type="text" id="safety_cert_no">
        </div>


      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>


  <!-- Second Inspection -->

<tr>
  <td>
    <div class="form-group">
      <label class="control-label">Additional or Second Inspection</label>

    </div>

  </td>

  <td colspan="2">
    <div>
      <div>

                <input type="radio" name="add_inspec" value="yes"  required="" <?php echo ($edit && $ministry_req_info['add_inspec'] =='yes') ? "checked": "" ; ?>/> Yes &nbsp&nbsp&nbsp

                <input type="radio" name="add_inspec" value="no"checked required="" <?php echo ($edit && $ministry_req_info['add_inspec'] =='no') ? "checked": "" ; ?>/> No


      </div>
    </div>

  </td>

  <td>

  </td>

  <td>


  </td>

</tr>
<!--  Inspection Result -->

<tr>
<td>
  <div class="form-group">
    <label class="control-label">Inspection Result</label>

  </div>

</td>

<td colspan="2">
  <div>
    <div>

              <input type="radio" name="inspec_result" value="pass" checked required="" <?php echo ($edit && $ministry_req_info['inspec_result'] =='pass') ? "checked": "" ; ?>/> Pass &nbsp&nbsp&nbsp

              <input type="radio" name="inspec_result" value="fail"  required="" <?php echo ($edit && $ministry_req_info['inspec_result'] =='fail') ? "checked": "" ; ?>/> Fail


    </div>
  </div>

</td>

<td>

</td>

<td>


</td>

</tr>


  </table>
</div>






<div class="form-group text-center">
  <label></label>
  <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
</div>
</fieldset>
