<?php
require_once './config/config.php';
$db = getDbInstance();
$s = intval($_GET['s']);
$db->where ('id', $s);
$services = $db->get ('services');
$total = 0;
?>
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
            <input id="qty" name="qty" value="1" required="required">
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
