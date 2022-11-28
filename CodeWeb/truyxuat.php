
<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	if (isset($_SESSION['username']) && isset($_SESSION['password']))
	{

		//lay "ten-date-month" tu file truyxuat.view.php
		$ten = $_POST['ten'];
    	$date = $_POST['date'];
    	$month = $_POST['month'];

		$connect= mysqli_connect("localhost","id18279955_server","Dat2140904@@@")or die("接続できませんでした。" . mysqli_error($connect));
		mysqli_select_db($connect,"id18279955_n1alps");
		mysqli_query($connect, 'SET NAMES "utf8"');

		if(isset($_POST['xuatten']))																						//xuat du lieu theo ten
		{
			$xuatdata = "SELECT * FROM savetable1 where hoten='$ten' ORDER BY ngay DESC";
			
		}
		else if(isset($_POST['xuatngay']))																				    //xuat du lieu theo ngay
		{
			$xuatdata = "SELECT * FROM savetable1 where ngay='$date' ORDER BY ngay DESC ";
			
		}
		else if(isset($_POST['xuatthang']))																				    //xuat du lieu theo thang
		{
			$thanglay=$_POST['month'];
        	$thangdau=$thanglay.'-01';
        	$thangcuoi=$thanglay.'-31';
        
        	$xuatdata = "SELECT * FROM savetable1 WHERE ngay between '$thangdau' and '$thangcuoi'ORDER BY ngay DESC";
			
		}
		
		else if(isset($_POST['xuatall']))																				    //xuat tat ca du lieu 
		{
			$xuatdata = "SELECT * FROM savetable1 ORDER BY ngay DESC ";
			
		}
		else
			$xuatdata = "SELECT * FROM savetable1 where id='0' ORDER BY ngay DESC ";

		$result = mysqli_query($connect, $xuatdata);																		
		require "truyxuat.view.php";
	}
	else
	{
		echo "<script language='javascript'>alert('再ログインが必要です。');";
			echo "location.href='index.php';</script>";
	}
?>
