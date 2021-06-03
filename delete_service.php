<?php
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST')
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: services.php');
        exit;

	}
    $service_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $service_id);
    $status = $db->delete('services');

    if ($status)
    {
        $_SESSION['info'] = "Service deleted successfully!";
        header('location: services.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete customer";
    	header('location: services.php');
        exit;

    }

}
