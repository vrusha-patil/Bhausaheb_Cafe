<?php

$conn=mysqli_connect("localhost:3306","root","","bhausaheb");

 if($conn->connect_error)

	  die ("Not connected..!!".$conn->connect_error);

require('fpdf.php');

$nm=$_POST['nm'];
$email=$_POST['email'];
$date=$_POST['date'];
$people=$_POST['people'];
$request=$_POST['request'];

if(isset($_POST['book']))
{
 
if($nm=="" or $email=="" or $date=="" or $people=="" or $request=="" )
	
	echo "<script>alert('Please fill the empty fields..!!')</script>";

elseif(!preg_match("/^[a-z A-Z]/",$nm))

	echo "<script>alert('Please enter valid name..!!')</script>";

elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))

	echo "<script>alert('Please enter valid email..!!')</script>";

else
{
	
		mysqli_query($conn,"insert into cust_data values('$nm','$email','$date','$people','$request');");
		echo "<script>alert('Your response submitted successfully...')</script>";


	    ob_start();
		$pdf=new FPDF();
		//$pdf->SetFillColor(255,179,71); 
		$pdf->SetFillColor(235,175,81);
		$pdf->AddPage();
		

		$pdf->SetFont("Times","", 30);

		$pdf->Cell(0, 10, "BhauSaheb Cafe", 0, 1, "C", TRUE);
		$pdf->Ln(5);

		$pdf->SetFont("Times","", 20);
		$pdf->Cell(0, 10, "Espresso yourself, no judgment here!", 0, 1, "C",TRUE);
		$pdf->Ln(5);

		$pdf->SetFont("Arial","", 20);
		$pdf->Text(80, 50, "Booking Receipt", 0, 1, "C");
		$pdf->Ln(5);

		$pdf->SetFont("Arial", "", 12);

		$pdf->Text(0,40,"__________________________________________________________________________________________");
		$pdf->Text(10,70, "Name:", 0);
		$pdf->Text(70,70,$nm, 0, 1);
		$pdf->Ln(5);

		$pdf->Text(10, 80, "Email:", 0);
		$pdf->Text(70, 80, $email, 0, 1);
		$pdf->Ln(5);

		$pdf->Text(10, 90, "Date :", 0);
		$pdf->Text(70, 90, $date, 0, 1);
		$pdf->Ln(5);

		$pdf->Text(10, 100, "No of People :", 0);
		$pdf->Text(70, 100, $people, 0, 1);
		$pdf->Ln(5);
		
		$pdf->Text(10, 110, "Special Request :", 0);
		$pdf->Text(70, 110, $request, 0, 1);
		$pdf->Ln(5);

		
		$pdf->Text(60, 170, "THANK YOU FOR BOOKING!", 0, 1, "C",TRUE);

		$pdf->Text(0,190,"__________________________________________________________________________________________");
		$pdf->Output();
		ob_end_flush();
	
}
}

?>
