<?php
require_once './config/config.php';
$db = getDbInstance();
$s = intval($_GET['s']);
$job_id = intval($_GET['job_id']);
$db->where ('id', $s);
$total = 0;
$subtotal = 0;
$dbServices = getDbInstance();
$selectServices = array('id','service_code','service_name','service_desc','service_price');
$services = $dbServices->get("services",null,$selectServices);
$dbJobService = getDbInstance();
$dbJobService->where('job_id',$job_id);
$currentServices = array();
$jobServices = $dbJobService->getValue("job_service","service_id", null);
foreach ($jobServices as $jobService){
  $currentServices[] = $jobService;
}

?>
<?php foreach ($currentServices as $currentService) : ?>
  <?php $dbServices->where ('id', $currentService);?>
  <?php $services = $dbServices->get("services");?>
<?php foreach($services as $key => $service) : ?>
        <?php $subtotal += $service['service_price'];?>

<?php endforeach; ?>
<?php endforeach; ?>
  <?php echo $subtotal; ?>
