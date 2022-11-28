<?php 
	$link= mysqli_connect("localhost","id18279955_server","Dat2140904@@@")or die($link);
	mysqli_select_db($link,"id18279955_n1alps");
	mysqli_query($link, 'SET NAMES "utf8"');
    
    $showdulieu="SELECT * FROM dulieu";
    $query= mysqli_query($link,$showdulieu);
 ?>
 <!DOCTYPE html>
<html lang="vi">
<head>
  <title>従業員名簿</title>
  <link href="style.css" rel="stylesheet" type="text/css" media="screen,print" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
		
	</div>
	<div class="col-md-6" >
		<table class="table table-bordered table-hover" >
			<thead>
				<tr>
					<th>No</th>
					<th>ID</th>
					<th>名前</th>
					<th >部署</th>
				</tr>
			</thead>
			<tbody>
			<?php 
					$i=1;
					while($row = mysqli_fetch_assoc($query))
					{
						echo "<tr>";
						echo "<td>".$i."</td>";
						echo "<td>".$row['id']."</td>";
						echo "<td>".$row['hoten']."</td>";
						echo "<td>".$row['chucvu']."</td>";
						echo "</tr>";
						$i++;
					}

				 ?>
			</tbody>
		</table>
		<p><a href="nhanvien.php"><<< 戻り</a><p>
	</div>
</body>
</html>
