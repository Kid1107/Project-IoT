<?php 
	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	date_default_timezone_set('Asia/Tokyo');
	$id=$_GET['id'];
	
	if (isset($_SESSION['username']) && isset($_SESSION['password']) || isset($id))
	{
		$time=getdate();
		$gioht=$time["hours"].":".$time["minutes"].":".$time["seconds"];
		if($gioht<"08:30:00")
			$gioht="08:30:00";
		$ngayht=$time["year"].".". $time["mon"].".".$time["mday"];
		$connect= mysqli_connect("localhost","id18279955_server","Dat2140904@@@")or die("接続できませんでした。" . mysqli_error($connect));
    	mysqli_select_db($connect,"id18279955_n1alps");
		mysqli_query($connect, 'SET NAMES "utf8"');

		$myfile=fopen("mode.text","r") or die("error");
		$mode=fread($myfile,filesize("mode.text"));
		fclose($myfile);

		if(isset($_GET['id']))																	//get ID from arduino
		{
			$database = "SELECT * FROM dulieu WHERE id=$id";
			$result = mysqli_query($connect, $database);
			if (mysqli_num_rows($result)!=0)
			{
				$row = mysqli_fetch_assoc($result);
    			$hoten=$row['hoten'];
    			$chucvu=$row['chucvu'];

				if($mode==1)																	//check in		
    			{	
					$banghienthi="INSERT INTO banghienthinew(id,hoten,chucvu,timei,ngay)	
				              VALUES ('$id','$hoten','$chucvu','$gioht','$ngayht')
							  ON DUPLICATE KEY UPDATE timei='$gioht',ngay='$ngayht'";			//update ngay va gio

					$savedata="INSERT INTO savetable1(id,hoten,chucvu,timei,ngay)
							VALUES ('$id','$hoten','$chucvu','$gioht','$ngayht')
							ON DUPLICATE KEY UPDATE timei='$gioht'";							//update theo gio
				}
				else if($mode==0)																//check out
				{
					$banghienthi="INSERT INTO banghienthinew(id,hoten,chucvu,timeo,ngay)		
				              	VALUES ('$id','$hoten','$chucvu','$gioht','$ngayht')
							  	ON DUPLICATE KEY UPDATE timeo='$gioht',ngay='$ngayht'";			

					$savedata="INSERT INTO savetable1(id,hoten,chucvu,timeo,ngay)
							  	VALUES ('$id','$hoten','$chucvu','$gioht','$ngayht')
								ON DUPLICATE KEY UPDATE timeo='$gioht'";						

				}
    			mysqli_query($connect,$banghienthi);											//insert vao bang hien thi
				mysqli_query($connect,$savedata);												//insert vao bang savedata	
			} 			
    	}
			if($mode==1)	
				$banghienthi="SELECT *FROM banghienthinew ORDER BY timei DESC";					
			elseif($mode==0)
				$banghienthi="SELECT *FROM banghienthinew ORDER BY timeo DESC";
			
    	  	$sapxep=mysqli_query($connect,$banghienthi);										//sort
		  
    	  	require "nhanvien.view.php";
	}
	else
	{
		echo "<script language='javascript'>alert('再ログインが必要です。');";
			echo "location.href='index.php';</script>";
	}
	
 ?>