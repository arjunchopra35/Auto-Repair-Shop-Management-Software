<?php
ob_start();
include('config/config.php');
require('fpdf/fpdf.php');
$id = $_GET['job_id'];
$db = getDbInstance();
$dbsettings = getDbInstance();

$dbinspection = getDbInstance();
$dbinspection->where('job_id',$id);
$dbinsdata = $dbinspection->getOne('inspection');

$dbinspectionbody = getDbInstance();
$dbinspectionbody->where('job_id',$id);
$dbinsbodydata = $dbinspectionbody->getOne('inspection_body');

$dbinspectionbrake = getDbInstance();
$dbinspectionbrake->where('job_id',$id);
$dbinsbrakedata = $dbinspectionbrake->getOne('inspection_brake');

$dbinspectioncoupling = getDbInstance();
$dbinspectioncoupling->where('job_id',$id);
$dbinscouplingdata = $dbinspectioncoupling->getOne('inspection_coupling');

$dbinspectionelectrical = getDbInstance();
$dbinspectionelectrical->where('job_id',$id);
$dbinselectricaldata = $dbinspectionelectrical->getOne('inspection_electrical');

$dbinspectioniaae = getDbInstance();
$dbinspectioniaae->where('job_id',$id);
$dbinsiaaedata = $dbinspectioniaae->getOne('inspection_iaae');

$dbinspectionlamp = getDbInstance();
$dbinspectionlamp->where('job_id',$id);
$dbinslampdata = $dbinspectionlamp->getOne('inspection_lamp');

$dbinspectionpowertrain = getDbInstance();
$dbinspectionpowertrain->where('job_id',$id);
$dbinspowertraindata = $dbinspectionpowertrain->getOne('inspection_powertrain');

$dbinspectionroad = getDbInstance();
$dbinspectionroad->where('job_id',$id);
$dbinsroaddata = $dbinspectionroad->getOne('inspection_road');

$dbinspectionsteering = getDbInstance();
$dbinspectionsteering->where('job_id',$id);
$dbinssteeringdata = $dbinspectionsteering->getOne('inspection_steering');

$dbinspectionsuspension = getDbInstance();
$dbinspectionsuspension->where('job_id',$id);
$dbinssuspensiondata = $dbinspectionsuspension->getOne('inspection_suspension');

$dbinspectiontire = getDbInstance();
$dbinspectiontire->where('job_id',$id);
$dbinstiredata = $dbinspectiontire->getOne('inspection_tire');


$dbsettings->where('id',1);
$settings = $dbsettings->getOne('settings');
$db->where('id', $id);
$data = $db->getOne('jobs');
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
  function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
  {
      $font_angle+=90+$txt_angle;
      $txt_angle*=M_PI/180;
      $font_angle*=M_PI/180;

      $txt_dx=cos($txt_angle);
      $txt_dy=sin($txt_angle);
      $font_dx=cos($font_angle);
      $font_dy=sin($font_angle);

      $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      if ($this->ColorFlag)
          $s='q '.$this->TextColor.' '.$s.' Q';
      $this->_out($s);
  }
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
  $this->Cell(30,8,'ONTARIO SAFETY INSPECTION',0,0,'C');
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
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,0);
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
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,7,'Safety Inspection Items',0);
$pdf->TextWithRotation(54,110,'Ok',45,-1);
$pdf->TextWithRotation(60,110,'Suggested',45,-1);
$pdf->TextWithRotation(66,110,'Required',45,-1);
$pdf->Cell(145,10,'Comments',0, 0, 'R');
$pdf->Ln();
$pdf->SetXY(10, 115);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,8,'Section 1. Powertrain',0);
$pdf->SetXY(55, 115);
$pdf->Cell(0,8,$dbinspowertraindata['powertrain'],0,0,L);
$pdf->Cell(0,8,$dbinspowertraindata['powertrain_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 2. Suspension',0);
$pdf->SetXY(55, 123);
$pdf->Cell(0,8,$dbinssuspensiondata['suspension'],0,0,L);
$pdf->Cell(0,8,$dbinssuspensiondata['suspension_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 3. Brake System',0);
$pdf->SetXY(55, 131);
$pdf->Cell(0,8,$dbinsbrakedata['brake'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['brake_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Left Front Pads',0);
$pdf->SetXY(55, 139);
$pdf->Cell(0,8,$dbinsbrakedata['lfp'],0,0,L);
$pdf->SetXY(115, 139);
$pdf->Cell(0,8,'Inner : '.$dbinsbrakedata['lfp_inner'],0,0,L);
$pdf->SetXY(155, 139);
$pdf->Cell(0,8,'Outer : '.$dbinsbrakedata['lfp_outer'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['lfp_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Right Front pads',0);
$pdf->SetXY(55, 147);
$pdf->Cell(0,8,$dbinsbrakedata['rfp'],0,0,L);
$pdf->SetXY(115, 147);
$pdf->Cell(0,8,'Inner : '.$dbinsbrakedata['rfp_inner'],0,0,L);
$pdf->SetXY(155, 147);
$pdf->Cell(0,8,'Outer : '.$dbinsbrakedata['rfp_outer'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['rfp_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Left Rear Pads',0);
$pdf->SetXY(55, 155);
$pdf->Cell(0,8,$dbinsbrakedata['lrp'],0,0,L);
$pdf->SetXY(115, 155);
$pdf->Cell(0,8,'Inner : '.$dbinsbrakedata['lrp_inner'],0,0,L);
$pdf->SetXY(155, 155);
$pdf->Cell(0,8,'Outer : '.$dbinsbrakedata['lrp_outer'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['lrp_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Right Rear Pads',0);
$pdf->SetXY(55, 162);
$pdf->Cell(0,8,$dbinsbrakedata['rrp'],0,0,L);
$pdf->SetXY(115, 162);
$pdf->Cell(0,8,'Inner : '.$dbinsbrakedata['rrp_inner'],0,0,L);
$pdf->SetXY(155, 162);
$pdf->Cell(0,8,'Outer : '.$dbinsbrakedata['rrp_outer'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['rrp_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Front Rotors',0);
$pdf->SetXY(55, 170);
$pdf->Cell(0,8,$dbinsbrakedata['frod'],0,0,L);
$pdf->SetXY(115, 170);
$pdf->Cell(0,8,'Left: '.$dbinsbrakedata['frod_left'],0,0,L);
$pdf->SetXY(155, 170);
$pdf->Cell(0,8,'Right : '.$dbinsbrakedata['frod_right'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['frod_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Rear Rotors',0);
$pdf->SetXY(55, 178);
$pdf->Cell(0,8,$dbinsbrakedata['rrod'],0,0,L);
$pdf->SetXY(115, 178);
$pdf->Cell(0,8,'Left: '.$dbinsbrakedata['rrod_left'],0,0,L);
$pdf->SetXY(155, 178);
$pdf->Cell(0,8,'Right: '.$dbinsbrakedata['rrod_right'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['rrod_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Front Break Shoes',0);
$pdf->SetXY(55, 186);
$pdf->Cell(0,8,$dbinsbrakedata['fbs'],0,0,L);
$pdf->SetXY(115, 186);
$pdf->Cell(0,8,$dbinsbrakedata['fbs_left'],0,0,L);
$pdf->SetXY(155, 186);
$pdf->Cell(0,8,$dbinsbrakedata['fbs_right'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['fbs_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Rear Break Shoes',0);
$pdf->SetXY(55, 194);
$pdf->Cell(0,8,$dbinsbrakedata['rbs'],0,0,L);
$pdf->SetXY(115, 194);
$pdf->Cell(0,8,$dbinsbrakedata['rbs_left'],0,0,L);
$pdf->SetXY(155, 194);
$pdf->Cell(0,8,$dbinsbrakedata['rbs_right'],0,0,L);
$pdf->Cell(0,8,$dbinsbrakedata['rbs_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 4. Steering',0);
$pdf->SetXY(55, 202);
$pdf->Cell(0,8,$dbinssteeringdata['steering'],0,0,L);
$pdf->Cell(0,8,$dbinssteeringdata['steering_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 5. Equipment',0);
$pdf->SetXY(55, 210);
$pdf->Cell(0,8,$dbinsiaaedata['iaae'],0,0,L);
$pdf->Cell(0,8,$dbinsiaaedata['iaae_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 6. Lamps',0);
$pdf->SetXY(55, 218);
$pdf->Cell(0,8,$dbinslampdata['lamp'],0,0,L);
$pdf->Cell(0,8,$dbinslampdata['lamp_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 7. Elec. System',0);
$pdf->SetXY(55, 226);
$pdf->Cell(0,8,$dbinselectricaldata['electrical'],0,0,L);
$pdf->Cell(0,8,$dbinselectricaldata['electrical_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 8. Body',0);
$pdf->SetXY(55, 234);
$pdf->Cell(0,8,$dbinsbodydata['body'],0,0,L);
$pdf->Cell(0,8,$dbinsbodydata['body_comments'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Window Tint',0);
$pdf->SetXY(55, 242);
$pdf->Cell(0,8,$dbinsbodydata['tint'],0,0,L);
$pdf->Cell(0,8,$dbinsbodydata['tint_com'],0,0,R);
$pdf->Ln();

$pdf->Cell(0,8,'Section 9. Tire',0);
$pdf->SetXY(55, 250);
$pdf->Cell(0,8,$dbinstiredata['tire'],0,0,L);
$pdf->Cell(0,8,$dbinstiredata['tire_comments'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'Front Tread',0);
$pdf->SetXY(55, 258);
$pdf->Cell(0,8,$dbinstiredata['ftd'],0,0,L);
$pdf->SetXY(115, 258);
$pdf->Cell(0,8,$dbinstiredata['ftd_left'],0,0,L);
$pdf->SetXY(155, 258);
$pdf->Cell(0,8,$dbinstiredata['ftd_right'],0,0,L);
$pdf->Cell(0,8,$dbinstiredata['ftd_com'],0,0,R);
$pdf->Ln();
$pdf->AddPage();
$pdf->SetXY(10, 55);
$pdf->Cell(0,8,'Rear Tread',0);
$pdf->SetXY(55, 55);
$pdf->Cell(0,8,$dbinstiredata['rtd'],0,0,L);
$pdf->SetXY(115, 55);
$pdf->Cell(0,8,$dbinstiredata['rtd_left'],0,0,L);
$pdf->SetXY(155, 55);
$pdf->Cell(0,8,$dbinstiredata['rtd_right'],0,0,L);
$pdf->Cell(0,8,$dbinstiredata['rtd_com'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'Coupling Dev.',0);
$pdf->SetXY(55, 63);
$pdf->Cell(0,8,$dbinscouplingdata['coupling'],0,0,L);
$pdf->Cell(0,8,$dbinscouplingdata['coupling_comments'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'Road Test',0);
$pdf->SetXY(55, 71);
$pdf->Cell(0,8,$dbinsroaddata['road'],0,0,L);
$pdf->Cell(0,8,$dbinsroaddata['road_comments'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'Tire Pressure (PSI)',0);
$pdf->Ln();
$pdf->Cell(0,8,'Front Left',0);
$pdf->SetXY(10, 87);
$pdf->Cell(0,8,$dbinstiredata['tpfl'],0,0,L);
$pdf->SetXY(115, 87);
$pdf->Cell(0,8,$dbinstiredata['tpfl_before'],0,0,L);
$pdf->SetXY(155, 87);
$pdf->Cell(0,8,$dbinstiredata['tpfl_after'],0,0,L);
$pdf->Cell(0,8,$dbinstiredata['tpfl_com'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'Front Right',0);
$pdf->SetXY(55, 95);
$pdf->Cell(0,8,$dbinstiredata['tpfr'],0,0,L);
$pdf->SetXY(115, 95);
$pdf->Cell(0,8,$dbinstiredata['tpfr_before'],0,0,L);
$pdf->SetXY(155, 95);
$pdf->Cell(0,8,$dbinstiredata['tpfr_after'],0,0,L);
$pdf->Cell(0,8,$dbinstiredata['tpfr_com'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'Rear Left',0);
$pdf->SetXY(55, 103);
$pdf->Cell(0,8,$dbinstiredata['tprl'],0,0,L);
$pdf->SetXY(115, 103);
$pdf->Cell(0,8,$dbinstiredata['tprl_before'],0,0,L);
$pdf->SetXY(155, 103);
$pdf->Cell(0,8,$dbinstiredata['tprl_after'],0,0,L);
$pdf->Cell(0,8,$dbinstiredata['tprl_com'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'Rear Right',0);
$pdf->SetXY(55, 111);
$pdf->Cell(0,8,$dbinstiredata['tprr'],0,0,L);
$pdf->SetXY(115, 111);
$pdf->Cell(0,8,$dbinstiredata['tprr_before'],0,0,L);
$pdf->SetXY(155, 111);
$pdf->Cell(0,8,$dbinstiredata['tprr_after'],0,0,L);
$pdf->Cell(0,8,$dbinstiredata['tprr_com'],0,0,R);
$pdf->Ln();
$pdf->Cell(0,8,'ABS',0);
$pdf->SetXY(55, 119);
$pdf->Cell(0,8,$dbinsroaddata['abs'],0,0,L);
$pdf->Ln();
$pdf->Cell(0,8,'TPMS',0);
$pdf->SetXY(55, 127);
$pdf->Cell(0,8,$dbinsroaddata['tpms'],0,0,L);
$pdf->Ln();
$pdf->Cell(0,8,'Check Engine',0);
$pdf->SetXY(55, 135);
$pdf->Cell(0,8,$dbinsroaddata['check_engine'],0,0,L);
$pdf->Ln();
$pdf->Cell(0,8,'Air Bags (SRS)',0);
$pdf->SetXY(55, 143);
$pdf->Cell(0,8,$dbinsroaddata['air_bags'],0,0,L);
$pdf->Ln();
$pdf->Cell(0,8,'Electronic Stability Control',0);
$pdf->SetXY(55, 151);
$pdf->Cell(0,8,$dbinsroaddata['esc'],0,0,L);
$pdf->Ln();
$pdf->Cell(0,8,'Other Lights',0);
$pdf->SetXY(55, 159);
$pdf->Cell(0,8,$dbinsroaddata['other_lights'],0,0,L);
$pdf->SetFont('Arial','',10);
$pdf->Ln();
$pdf->SetXY(10, 220);
$pdf->Cell(0,8,'Name of Licensee - '.$settings['name']);
$pdf->Ln();
$pdf->Cell(0,8,'Licensee Number - 21 - 90614');
$pdf->Ln();
$pdf->Cell(0,8,'Licensee Address - '.$settings['address']);
$pdf->Ln();
$pdf->Cell(0,8,'Licensee Phone Number - '.$settings['phone']);
$pdf->Ln();
$pdf->Cell(0,8,'Name Of Technician - '.$settings['name']);
$pdf->Ln();
$pdf->Cell(0,8,'Trade Certificate Number - '.$settings['tcn']);
$pdf->Ln();
ob_end_clean();
$pdf->Output();
?>
