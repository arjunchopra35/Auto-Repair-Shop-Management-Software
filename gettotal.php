<?php
require_once './config/config.php';
$db = getDbInstance();
$s = intval($_GET['s']);
$db->where ('id', $s);
$services = $db->get ('services');
$total = 0;
?>
<?php foreach($services as $key => $service) : ?>
<?php echo($service['service_price']); ?>
<?php endforeach; ?>
