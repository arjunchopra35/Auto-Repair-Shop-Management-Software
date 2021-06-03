<?php
require_once './config/config.php';
$p = intval($_GET['p']);
$subtotal = 0;

$db = getDbInstance();
// $db->where('job_status','invoice');
$db->where ('vehicle_id', $p);
$jobs = $db->get ('jobs');
?>

<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th width="10%">Date</th>
            <th width="45%">Services</th>
            <th width="10%">Amount Paid</th>
            <th width="10%">Job Status</th>
            <th width="10%">Inspection</th>
        </tr>
    </thead>
      <?php foreach ($jobs as $job): ?>
    <tbody>
      <tr>
<?php
$dbJobService = getDbInstance();
$dbJobService->where('job_id',$job['id']);
$currentServices = array();
$jobServices = $dbJobService->getValue("job_service","service_id", null);
foreach ($jobServices as $jobService){
  $currentServices[] = $jobService;
}
$dbServices = getDbInstance();
?>
<td> <?php echo xss_clean($job['job_status']); ?> </td>
<td>
    <?php foreach ($currentServices as $currentService) : ?>
      <?php $dbServices->where ('id', $currentService);?>
      <?php $services = $dbServices->get("services");?>
    <?php foreach($services as $key => $service) : ?>


            <?php echo($service['service_code'].' - '.$service['service_name']); ?><br>
          <?php echo($service['service_desc']); ?><br>

  <?php $subtotal += $service['service_price'];?>
  <?php $taxAmt = $subtotal*0.13; ?>


<?php endforeach; ?>
  <?php endforeach; ?> </td>
  <td><?php echo $subtotal + $taxAmt?></td>
  <td> <?php echo xss_clean($job['job_status']); ?> </td>
    <td> <?php echo xss_clean($job['inspection_status']); ?> </td>

</tr>
<?php endforeach; ?>
</tbody>
</table>
