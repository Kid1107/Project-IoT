<?php 
    session_start();
    $hoten = $_POST['tennv'];
    $chucvu = $_POST['chucvu'];
    $id = $_POST['id'];

    $link= mysqli_connect("localhost","id18279955_server","Dat2140904@@@")or die($link);
    mysqli_select_db($link,"id18279955_n1alps");
    mysqli_query($link, 'SET NAMES "utf8"');
    $output = '';
    

    if(isset($_POST['them']))
    {
        if(($id!=NULL)&&($chucvu!=NULL)&&($hoten!=NULL))
        {
            $themdulieu=mysqli_query($link,"INSERT INTO dulieu(id,hoten,chucvu) VALUES ('$id','$hoten','$chucvu')");
            if($themdulieu)
                header("location: nhanvien.php");
            else
            {
                echo "<script language='javascript'>alert('情報登録が失敗しました。');";
                echo "location.href='nhanvien.php';</script>";
            }
        }
        else
        {
                echo "<script language='javascript'>alert('エラー: 情報を入力していません。');";
                echo "location.href='nhanvien.php';</script>";
        }
    }
    if(isset($_POST['xoa']))
    {
        if($id!= NULL)
        {
            $xoadulieu=mysqli_query($link,"DELETE FROM dulieu WHERE id=$id");
            if($xoadulieu)
                header("location: nhanvien.php");
        }
        else
        {
            echo "<script language='javascript'>alert('エラー: IDをまだ入力していません。');";
                echo "location.href='nhanvien.php';</script>";
        }
    }

    if(isset($_POST['delete']))
    {
            $deletedata=mysqli_query($link,"DELETE FROM banghienthinew ");
            if($deletedata)
                header("location: nhanvien.php");
    }


    if(isset($_POST['dsach']))
    {
        header("location: danhsachnhanvien.php");
    }  

    if(isset($_POST["xuat"]))
    {
        header("location: truyxuat.php");
    }

 ?>