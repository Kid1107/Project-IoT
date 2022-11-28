<?php
    session_start();
    $connect= mysqli_connect("localhost","id18279955_server","Dat2140904@@@")or die("接続できませんでした。" . mysqli_error($connect));
    

    $username = $_POST['username'];     //lay ten dang nhap luu vao bien username
    $password = $_POST['password'];     //lay password luu vao bien password
	$username = mysqli_real_escape_string($connect,$username);
	$password = mysqli_real_escape_string($connect,$password);     //prevent sql injection

    $db_selected = mysqli_select_db($connect,"id18279955_n1alps");               //ket noi database

    if(!$db_selected)                                               //kiem tra ket noi
    {
        die("データベース接続失敗です。".mysqli_error());
    }
    $result = mysqli_query($connect, "select * from users where username = '$username' and password = '$password'"); //tim thong tin trong database

	if (mysqli_num_rows($result)==0)                            //tim kiem that bai
	{
		echo "<script language='javascript'>alert('ユーザー名またはパスワードが正しくありません');";
			echo "location.href='index.php';</script>";
		
	}                                                          //tim kiem thanh cong
	else
	{
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		header("location: nhanvien.php");
		
	}
?>