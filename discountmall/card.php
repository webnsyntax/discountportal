<?php 
require('fpdf/fpdf.php');
include_once("../includes/db_connect.php");
include_once("functions.php");
admin_logincheck();
$admin_name=$_SESSION['uname'];
$permission=$_SESSION['permission'];

$cid=$_REQUEST['cid'];

$user_details=mysql_query("select * from users where userid='{$cid}'");
$udetails=mysql_fetch_array($user_details);

$uname=$udetails[2];
$umobile=$udetails[6];
$udob=$udetails[7];
$ucity=$udetails[12];
$uphoto=$udetails[10];
if($ucity==1)
{
	$city="Vijayawada";
}
else if($ucity==2)
{
	$city="Vizag";
}
else if($ucity==3)
{
	$city="Tirupathi";
}


$card_details=mysql_query("select * from discards where userid='{$cid}'");
$cdetails=mysql_fetch_array($card_details);

$ctype=$cdetails[2];
$cexpdate=$cdetails[5];
$cardid=$cdetails[8];

$date=date('d-m-Y');
$edate=date('j-n-Y', strtotime($cexpdate));
$dob=date('j-n-Y', strtotime($udob));

class PDF extends FPDF
{
	// Page header
function Header()
{
	// Logo
	$this->Image('logo.jpg',80,8,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title

	// Line break
	$this->Ln(40);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}



}

$pdf = new PDF();


// Column headings

$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->SetXY(150, 25);

$pdf->Cell(200, 5, "Date        : $date", 0, 2);
$pdf->Cell(200, 5, "Card Id: $cardid", 0, 2);

$pdf->Ln(10);

$pdf->SetXY(20, 50);
$pdf->SetFont('Arial','B',12);
 
$pdf->Cell(200, 5, "Customer Details", 0, 2);

$pdf->SetFont('Arial','',12);
$pdf->Cell( 40, 40, $pdf->Image($uphoto, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
$pdf->Cell(200, 5, "Name:$uname", 0, 2);
$pdf->Cell(200, 5, "Mobile:$umobile", 0, 2);
$pdf->Cell(200, 5, "DOB:$dob", 0, 2);
$pdf->Cell(200, 5, "City:$city", 0, 2);
$pdf->Ln(30);


$pdf->SetXY(20, 95);
$pdf->SetFont('Arial','B',12);
 
$pdf->Cell(200, 5, "Card Details", 0, 2);

$pdf->SetFont('Arial','',12);
$pdf->Cell(200, 5, "Card Type:$ctype", 0, 2);
$pdf->Cell(200, 5, "Exp Date:$edate", 0, 2);


$pdf->Ln(10);

$pdf->Output('card.pdf','I');

?>
