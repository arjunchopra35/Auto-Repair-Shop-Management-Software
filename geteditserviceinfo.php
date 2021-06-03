<?php
require_once './config/config.php';
$db = getDbInstance();
$dbjob = getDbInstance();
$s = intval($_GET['s']);
$db->where ('id', $s);
$job_id = intval($_GET['job_id']);
$services = $db->get ('services');
$total = 0;
$data = Array ("job_id" => $job_id, "service_id" => $s);
$store = $dbjob->insert('job_service',$data);
$subtotal =0;
$dbJobService = getDbInstance();
$dbJobService->where('job_id',$job_id);
$currentServices = array();
$jobServices = $dbJobService->getValue("job_service","service_id", null);
foreach ($jobServices as $jobService){
  $currentServices[] = $jobService;
}
$dbServices = getDbInstance();

?>
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
        <a href="#" id="d-btn" name="d-btn" value = "<?php echo($service['id']); ?>" onclick="delService(<?php echo($service['id']); ?>, <?php echo $job_id; ?>);"><i class="fa fa-trash fa-fw"></i></a>
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
