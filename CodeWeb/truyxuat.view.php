<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>エクスポート</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
</head>
<body>
	<div class="col-md-4" >
		<form action="" method="POST" accept-charset="utf-8">
			<table  height="150px" >
			<tr>
				<td>名前:</td>
				<td><input type="text" name="ten" id="inputTennv" class="form-control" placeholder="従業員の名前"></td>
				<td>&nbsp;<button type="submit" name="xuatten" class="btn btn-warning" id="btnxuatexten">表示</button></td>
			</tr>
			<tr> 
				<td>日付:&nbsp;</td>
				<td><input type="date" name="date" id="date" class="form-control"></td>
				<td>&nbsp;<button type="submit" name="xuatngay" class="btn btn-warning" id="btnxuatexngay">表示</button></td>
			</tr>
			<tr> 
				<td>1か月:&nbsp;</td>
				<td><input type="month" name="month" id="month" class="form-control"></td>
				<td>&nbsp;<button type="submit" name="xuatthang" class="btn btn-warning" id="btnxuatexthang">表示</button></td>
			</tr>
			<tr>
				<td colspan="3" align="center"><button style="width:100%;" type="submit" name="xuatall" id="btnxuatall">全て表示</button></td>
			</tr>
			</table>
		</form>
		<table>
			<tr>
				<td colspan="3" align="center"><button style="width:332%;" type="submit" name="xuatex" id="export_button" onclick="html_table_to_excel()">エクスポート</button></td>
			</tr>
		</table>
		<script>
			function html_table_to_excel(type)
    		{
        		var data = document.getElementById('employee_data');

        		var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        		XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        		XLSX.writeFile(file, 'FileExcel.' + type);
    		}

    		const export_button = document.getElementById('export_button');

    		export_button.addEventListener('click', () =>  {
        	html_table_to_excel('xlsx');
    		});
		</script>
			<p><a href="nhanvien.php"><<< 戻り</a><p>
	</div>

	<div class="col-md-8 content">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">勤務管理表</h3>
					</div>

					<div class="panel-body" >
						<table class="table table-striped table-hover"id="employee_data" > 
							<thead>
								<tr  >
									<th>ID</th>
									<th>名前</th>
									<th>部署</th>
									<th>出勤時間</th>
									<th>退勤時間</th>
									<th>日付</th>
									<th>勤務時間</th>
									<th>残業時間</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								    function get_time_difference($t1, $t2)										// tinh thoigianlamviec = time out -time i						
                                    {																			
                                        $t1 = strtotime($t1);													//chuyen kieu hh:mm:ss -> timestamp 
                                        $t2 = strtotime($t2);;												
                                        $hour = floor(($t1-$t2)/3600);											
                                        $minute =floor(($t1-$t2)/60)%60;
                                        $second = ($t1-$t2)-($hour*3600+$minute*60); 
                                        return (date("H:i:s",strtotime($hour.":".$minute.":".$second)));		// tra ve kieu hh:mm:ss sau tinh toan
                                    }
									while($hienthi=mysqli_fetch_assoc($result))
									{
										echo "<tr>";
										echo "<td>".$hienthi['id']."</td>";
										echo "<td>".$hienthi['hoten']."</td>";
										echo "<td>".$hienthi['chucvu']."</td>";
										echo "<td>".$hienthi['timei']."</td>";
										echo "<td>".$hienthi['timeo']."</td>";
										echo "<td>".$hienthi['ngay']."</td>";
										if($hienthi['worktime']>"08:00:00")										//tinh thoi gian lam viec			
										{
											$tongthoigian = $hienthi['worktime'];
											$timenghi = '01:00:00';	
											$timelamviec = get_time_difference($tongthoigian, $timenghi);				
											echo"<td>".$timelamviec."</td>";
										}
										else
											echo "<td>".$hienthi['worktime']."</td>";

										if($hienthi['overtime']>"00:00:00")										//tinh thoi gian tang ca
										{
											$timeocty = '09:00:00';	
											$timetangca = get_time_difference($tongthoigian, $timeocty);
											echo"<td>".$timetangca."</td>";
										}
										else
											echo "<td>"."00:00:00"."</td>";
										echo "</tr>";
									}
									 mysqli_free_result($result);
									 
								?>
							</tbody>
						</table>
					</div>

				</div>
			</div>

</body>
</html>