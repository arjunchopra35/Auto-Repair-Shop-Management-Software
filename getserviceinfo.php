<?php
require_once './config/config.php';
$db = getDbInstance();
$dbjob = getDbInstance();
$s = intval($_GET['s']);
$db->where ('id', $s);
$services = $db->get ('services');
$total = 0;
?>
<?php foreach($services as $key => $service) : ?>


  <tr class="item">
    <td>
      <select id="serv-code" class="serv-code" onchange="showServiceInfo(this.value);  getTotal(this.value);">
        <option value="">Select Service</option>
        <?php foreach($services as $key => $service) : ?>
          <?php if($service['id'] == $s): ?>
            <?php $selected = ($key == $service['service_code'] ? 'selected' : '') ?>
          <option value = "<?php echo($service['id']); ?>" data-name = "<?php echo($service['service_code']); ?>" data-desc = "<?php echo($service['service_desc']); ?>" data-price = "<?php echo($service['price']); ?>">
            <?php echo($service['service_code']); ?>
          </option>
          <?php else: ?>

            <option value = "<?php echo($service['id']); ?>" data-name = "<?php echo($service['service_code']); ?>" data-desc = "<?php echo($service['service_desc']); ?>" data-price = "<?php echo($service['price']); ?>">
              <?php echo($service['service_code']); ?>
            </option>
            <?php endif; ?>
        <?php endforeach; ?>
      </select>

    </td>
    <td style="text-align:left;">
      <input form="job_form" value="<?php echo($service['service_name']); ?>"  id = "qty" >
    </td>
    <td>
      <input form="job_form" value="<?php echo($service['service_desc']); ?>" style="width:100%;">
    </td>
    <td>
      <input form="job_form" value="1" required="required" id = "qty" >
    </td>

    <td class="price">
      <?php echo($service['service_price']); ?>

    </td>
    <td class="price">
      <?php echo($service['service_price']); ?>

    <td class="price">
      <?php echo($service['service_price']); ?>

    </td>
    <td class="price">
      <?php echo($service['service_price']); ?>

    </td>
    <td class="price">

      <a href="#" id="d-btn" name="d-btn" value = "<?php echo($service['id']); ?>" onclick="delService(<?php echo($service['id']); ?>); updateTotal(<?php echo($service['id']); ?>); "><i class="fa fa-trash fa-fw"></i></a>
    </td>

  </tr>

<?php endforeach; ?>
