<?php
ob_start();
include('config/config.php');
require('fpdf/fpdf.php');
$id = $_GET['job_id'];
$db = getDbInstance();
$db->where('id', $id);
$data = $db->getOne('jobs');
$dbsettings = getDbInstance();
$dbsettings->where('id',1);
$settings = $dbsettings->getOne('settings');
$vehicle_id = $data['vehicle_id'];
$dbvehicle = getDbInstance();
$dbvehicle->where('id', $vehicle_id);
$vehicledata = $dbvehicle->getOne('vehicles');
$vehicle_make = $vehicledata['vehicle_make'];
$vehicle_model = $vehicledata['vehicle_model'];
$vehicle_year = $vehicledata['vehicle_year'];
$vehicle_vin = $vehicledata['vehicle_vin'];
$vehicle_lic = $vehicledata['vehicle_lic'];
$vehicle_kms = $vehicledata['vehicle_kms'];
$vehicle_engine = $vehicledata['vehicle_engine'];
$customer_id = $vehicledata['vehicle_owner_id'];
$dbcustomer = getDbInstance();
$dbcustomer->where('id', $customer_id);
$customerdata = $dbcustomer->getOne('customers');
$customer_fname = $customerdata['f_name'];
$customer_lname = $customerdata['l_name'];
$customer_phone = $customerdata['phone'];
$customer_email = $customerdata['email'];
$servicesArray = $data['serviceIds'];
$currentServices = explode(',', $servicesArray);
// $dbJobService = getDbInstance();
// $dbJobService->where('job_id',$id);
// $currentServices = array();
// $jobServices = $dbJobService->getValue("job_service","service_id", null);
// foreach ($jobServices as $jobService){
//   $currentServices[] = $jobService;
// }
$dbServices = getDbInstance();
$serviceCodes = array();
$serviceNames = array();
$serviceDesc = array();
$servicePrice = array();
foreach ($currentServices as $currentService){
$dbServices->where ('id', $currentService);
 $services = $dbServices->get("services");
foreach($services as $key => $service){
  $serviceCodes[] = $service['service_code'];
  $serviceNames[] = $service['service_name'];
  $serviceDesc[] = $service['service_desc'];
  $servicePrice[] = $service['service_price'];
$subtotal += $service['service_price'];
}
}
$tax = $subtotal*0.13;
$total = $subtotal+$tax;



class PDF extends FPDF
{
// Page header
function Header()
{
  $dbsettings = getDbInstance();
  $dbsettings->where('id',1);
  $settings = $dbsettings->getOne('settings');
  $id = $_GET['job_id'];
  $db = getDbInstance();
  $db->where('id', $id);
  $data = $db->getOne('jobs');
  $vehicle_id = $data['vehicle_id'];
  $address = $settings['address'];
  $date = $data['estimate_date'];
  $time=strtotime($date);
  $year=date("Y",$time);
  $this->SetFont('Arial','B',13);
  // Move to the right
  $this->Cell(80);
  // Title
  $this->Cell(30,8,'REPAIR',1,0,'C');
    // Logo
    $this->Cell(40);
    $this->Image('logo.png',6,14,40);
    // Arial bold 15
    $this->SetFont('Arial','',12);
    // Move to the right

    $this->Ln(5);
    $this->Cell(36);
    // Title
    $this->Cell(40,24,$address);
    $this->Cell(70);
    $this->Cell(40,24,'ROSYD-'.$year.'-'.$id,0,0,'R');

    $this->Ln(5);
    $this->Cell(36);
    $this->Cell(40,27,$settings['phone']);
    $this->Cell(86);
    $this->Cell(40,27,$date);

    $this->Ln(5);
    $this->Cell(36);
    $this->Cell(40,30,$settings['email']);

    // Line break
    $this->Ln(20);
}
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,40,'Vehicle Details');
$pdf->Cell(110);
$pdf->Cell(40,40,'Customer Details', 0, 0, 'R');
$pdf->SetFont('Arial','',12);
$pdf->SetXY(10, 50);
$pdf->Cell(40,50,$vehicle_make.' '.$vehicle_model.' '.$vehicle_year);
$pdf->Cell(110);
$pdf->Cell(40,50,$customer_fname.' '.$customer_lname, 0, 0, 'R');
$pdf->SetXY(10, 55);
$pdf->Cell(40,50,'VIN: '.$vehicle_vin);
$pdf->Cell(110);
$pdf->Cell(40,50,$customer_phone,  0, 0, 'R');
$pdf->SetXY(10, 60);
$pdf->Cell(40,50,'Plate: '.$vehicle_lic);
$pdf->Cell(110);
$pdf->Cell(40,50,$customer_email,  0, 0, 'R');
$pdf->SetXY(10, 65);
$pdf->Cell(40,50,'KMS: '.$vehicle_kms);
$pdf->SetXY(10, 70);
$pdf->Cell(40,50,'Engine: '.$vehicle_engine);
$pdf->SetXY(10, 55);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,7,'Name',0);
$pdf->Cell(130,7,'Service Description',0);
$pdf->Cell(15,7,'Cost',0, 0, 'R');
$pdf->Ln();
$pdf->SetXY(10, 65);
$pdf->SetFont('Arial','',10);
$x = 112;
foreach($serviceNames as $column){
        $pdf->SetXY(10, $x);
        $x = $x + 25;
        $pdf->MultiCell(30,7,$column,0);
        $pdf->Ln();
}
$pdf->SetXY(10, 85);
$x = 112;
foreach($serviceDesc as $column){
        $pdf->SetXY(55, $x);
        $x = $x + 25;
        $pdf->MultiCell(115,7,$column,0);
        $pdf->Ln();
}
$pdf->SetXY(10, 85);
$x = 112;
foreach($servicePrice as $column){
        $pdf->SetXY(170, $x);
        $x = $x + 25;
        $pdf->MultiCell(30,7,$column, 0, 'R');
        $pdf->Ln();
}
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,20,'Subtotal : '.$subtotal,  0, 0, 'R');
$pdf->Ln();
$pdf->Cell(190,10,'Tax '.$settings['hst'].': '.$tax,  0, 0, 'R');
$pdf->Ln();
$pdf->Cell(190,4,'Total : '.$total,  0, 0, 'R');

$pdf->SetXY(125, 10);
$pdf->SetFont('Arial','',10);
$pdf->Ln();
$pdf->SetXY(10, 220);
$pdf->MultiCell(0,5,$settings['repair_data']);
$pdf->Ln();
$pdf->Cell(10,20,'Signature : ______________________________');

ob_end_clean();
$pdf->Output();
?>
