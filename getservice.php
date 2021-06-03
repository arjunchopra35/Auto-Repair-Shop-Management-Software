<style>
.cust-label{
  font-weight:normal;
  margin-bottom: 0px;
}
</style>
<?php
require_once './config/config.php';
$db = getDbInstance();
$dbjob = getDbInstance();
$r = intval($_GET['r']);
$job_id = intval($_GET['job_id']);
$db->where ('id', $r);
$services = $db->get ('services');

?>
<?php foreach($services as $key => $service) : ?>
  <a href="#" id="s-btn" name="s-btn" class="btn btn-success addbtn" onclick="showServiceInfo(<?php echo($service['id']); ?>, <?php echo $job_id; ?>); getTotal(<?php echo($service['id']); ?>); " value = "<?php echo($service['id']); ?>" data-code = "<?php echo($service['service_code']); ?>" >Add <?php echo($service['service_code']); ?></a>

<?php endforeach; ?>
