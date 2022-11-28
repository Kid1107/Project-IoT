<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>社員管理</title>
  <link href="stylenew.css" rel="stylesheet" type="text/css" media="screen,print" />
  <link href="clock.css" rel="stylesheet" type="text/css" media="screen,print" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <script src="finisher-header.es5.min.js" type="text/javascript"></script>
  
  
</head>
<body>
	<div class="layout">
		<div class="header finisher-header">
			<div class="header"><img src="logocty.png" alt="" ></div>
				<script type="text/javascript">
					new FinisherHeader({
					"count": 10,
					"size": {
						"min": 1299,
						"max": 1500,
						"pulse": 0
					},
					"speed": {
						"x": {
						"min": 0.4,
						"max": 2
						},
						"y": {
						"min": 0.1,
						"max": 0.6
						}
					},
					"colors": {
						"background": "#2558a2",
						"particles": [
						"#ffffff",
						"#87ddfe",
						"#acaaff",
						"#1bffc2",
						"#f88aff"
						]
					},
					"blending": "none",
					"opacity": {
						"center": 0.5,
						"edge": 0.05
					},
					"skew": 0,
					"shapes": [
						"c",
						"s",
						"t"
					]
					});
					</script>
			</div>
		

					
		<div class="pagebody">
			<div class="col-md-4 sidebar">
				

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">従業員の追加・削除</h3>
					</div>
					<div class="panel-body dk">
						<form action="edituser.php" method="POST" accept-charset="utf-8">
							<input type="text" name="tennv" id="inputTennv" class="form-control" placeholder="社員の名前">
							<input type="text" name="chucvu" id="inputChucvu" class="form-control" placeholder="部署">
							<input type="text" name="id" id="inputId" class="form-control" placeholder="社員のID">
							<button type="submit" name="them" class="btn btn-danger" id="btnthem">追加</button>
							<button type="submit" name="dsach" class="btn btn-danger" id="btnsua">従業員名簿</button>
							<button type="submit" name="xoa" class="btn btn-danger" id="btnxoa">削除</button>
							<button type="submit" name="xuat" class="btn btn-warning" id="btnxuat">エクスポート</button>
							<button type="button" class="btn" id="btndelete"data-toggle="modal" data-target="#exampleModal">データを削除する</button>

							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">再確認</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										データを削除しますか?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
										<button type="submit" name="delete" class="btn btn-primary">はい</button>
									</div>
									</div>
								</div>
							</div>
						</form>
						<button type="submit" name="update" class="btn" id="btnupdate" onclick="tai_lai_trang()">最新の情報に更新</button>
						<script>
							function tai_lai_trang(){
							location.reload();
							}
						</script>
					</div>
				</div>

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">ユーザー アカウント</h3>
					</div>
					<div class="panel-body">
						<?php echo "ようこそ ". "<span style='color:red; font-weight:bold;'>".$_SESSION['username']."</span>"; ?>
							<form method="POST" action="index.php">
								<button type="submit" class="btn btn-default" id="btnthoat">ログアウト</button>
							</form>
					</div>
				</div>

			</div>
							
			<div class="col-md-8 content">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">勤務管理表</h3>
					</div>

					<div class="panel-body" >
						<table class="table table-striped table-hover" > 
							<thead>
								<tr >
									<th>ID</th>
									<th>名前</th>
									<th>部署</th>
									<th>出勤時間</th>
									<th>退勤時間</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									while($hienthi=mysqli_fetch_assoc($sapxep))
									{
										echo "<tr>";
										echo "<td>".$hienthi['id']."</td>";
										echo "<td>".$hienthi['hoten']."</td>";
										echo "<td>".$hienthi['chucvu']."</td>";
										echo "<td>".$hienthi['timei']."<br/>".$hienthi['ngay']."</td>";
										echo "<td>".$hienthi['timeo']."<br/>".$hienthi['ngay']."</td>";
										echo "</tr>";
									}
								
									
									 mysqli_free_result($sapxep);
								?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>

		<div class="footer">
			<div class="col-md-12 footer" >
				<div class="fLeft">
					<p>N1グランプリ</p>
					<p>
						中日本事業部 松本営業所</br>
						発表者:  2020602 レ ダット</br>
						担当者:  2016640 ホアン クアン リエム
					</p>
					<p>電話番号: <a href="#">05068644196</a></br>
					   メール: <a href="#">le-dat@alpsgiken.co.jp</a></p>
				</div>

				<div class="fRight">
					<ul>
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
						<li><a href="#"><i class="fab fa-youtube"></i></a></li>
					</ul>
					<p>© Copyright LEDAT - All Rights Reserved</p>
				</div>
			</div>
		</div>
		<div class="clear"></div>

		
 		

	</div>
	
</body>
</html>
