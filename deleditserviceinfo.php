<?php
require_once './config/config.php';
$db = getDbInstance();
$s = intval($_GET['s']);
$job_id = intval($_GET['job_id']);
$db->where ('id', $s);
$services = $db->get ('services');
$total = 0;
$dbservjob = getDbInstance();
$dbservjob->where('service_id',$s);
$dbservjob->delete('job_service');

$subtotal =0;
$dbJobService = getDbInstance();
$dbJobService->where('job_id',$job_id);
$currentServices = array();
$jobServices = $dbJobService->getValue("job_service","service_id", null);
if ($jobServices != NULL){
foreach ($jobServices as $jobService){
  $currentServices[] = $jobService;
}
}
$dbServices = getDbInstance();
?>
<?php foreach ($currentServices as $currentService) : ?>
  <?php $dbServices->where ('id', $currentService);?>
  <?php $services = $dbServices->get("services");?>
<?php foreach($services as $key => $service) : ?>
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
            <input name="qty" value="1" required="required" id = "qty" >
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
<?php endforeach; ?>
