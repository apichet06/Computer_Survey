<?php session_start(); 
require_once '../db/config.php'; 
$sql = mysqli_query($conn,"SELECT username FROM member Where username = '".$_SESSION['login_user']."' ");
$rs0 = mysqli_fetch_assoc($sql);

if($rs0['username']==""){
	header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KBANK</title>
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="img/logo.png"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css">
	<style type="text/css">
		body{
			font-size: 13px;
			/*background-color: #FCFCFC;*/
			background:  url('img/plant.jpg');
			/*-webkit-background-size: cover;*/
			background-repeat: no-repeat;
			background-position: center center;
			background-attachment: fixed;
			-o-background-size: 100% 100%, auto;
			-moz-background-size: 100% 100%, auto;
			/*-webkit-background-size: 100% 100%, auto;*/
			/*background-size: 100% 100%, auto;*/
 
		}
		.bg_one{
			box-shadow: 0 5px 10px rgba(0,0,0,0.2);

		}
		.card {
 
			background-color: rgba(236, 236, 236, 0.6); 
			margin: 10px; 
			
		}
		.card-header, .card-footer { 
			opacity: 1
		}
	</style>
</head>
<body>
	
	<nav class="navbar navbar-dark  bg_one" style="background-color: #008B45;">
		<a class="navbar-brand 	text-white"><img src="img/logo.png" width="35"> Kbank</a> 
		<form class="form-inline">
			<a href="logout.php" class="btn btn-outline-light my-2 my-sm-0">Admin  ออกจากระบบ</a>
		</form>
	</nav>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-6 p-4  text-center" style="margin:30px 50px;">
				<h3 class="text-white">กราฟแสดงภาพรวมจำนวนอุปกรณ์คอมพิวเตอร์</h3><br>
				<div class="card wrap-input100">

					<div class="card-body bg_one">
						<canvas id="myChart" width="400" height="200"></canvas>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-4 ">
				<h3 class="text-white">ข้อมูลรายการสำรวจอุปกรณ์คอมพิวเตอร์ประจำสาขาของผู้จัดการสาขา</h3><br>
				<div class="card">
					<div class="card-body bg_one">
						<table class="table table-bordered table-responsive" id="example">
							<thead >
								<tr class="align-middle text-nowrap">
									<th>No.</th>
									<th>ชื่อ-สกุล/รหัสพนักงาน</th>
									<th>รหัสสาขา</th>
									<th>ชื่อสาขา</th>
									<th>อุปกรณ์เดิมของสาขา</th>
									<th>ถ้าเป็น notebook(ยี่ห้อ)</th>
									<th>เคยใช้ งาน VPN Token หรือไม่</th>
									<th>Team</th>
									<th>หัวหน้าสาขา</th>
									<th>เบอร์โทรหัวหน้าสาขา</th>
									<th>เบอร์โทรสาขา</th>
									<th>เบอร์ที่ติดต่อได้ผู้ส่งแบบสอบถาม</th>
									<th>ถนน</th>
									<th>เขต/อำเภอ</th>
									<th>จังหวัด</th>
									<th>ข้อมูลเพิ่มเติม</th>
									<th>สถานะสาขา</th>
									<th>เวลาบันทึก</th>
								</tr>
							</thead>
							<tbody>

								<?php $sql = mysqli_query($conn,"SELECT *,a.br_name FROM request a 
									LEFT JOIN kb_branch b 
									on a.br_id = b.br_code
									group by a.br_id")or die(mysqli_error($conn)); 
								$i=1;
								while ($rs = mysqli_fetch_assoc($sql)) { ?>
									<tr> 	
										<td><?=$i?></td>
										<td><?=$rs['name']?></td>
										<td><?=$rs['br_id']?></td>
										<td><?=$rs['br_name']?></td>
										<td><?=$rs['old']?></td>
										<td><?=$rs['Brand']?></td>
										<td><?=$rs['vpn']?></td>
										<td><?=$rs['br_team']?></td>
										<td><?=$rs['br_manager_name']?></td>
										<td><?=$rs['br_manager_phone']?></td>
										<td><?=$rs['br_branch_phone']?></td>
										<td><?=$rs['phone']?></td>
										<td><?=$rs['br_road']?></td>
										<td><?=$rs['br_ampore']?></td>
										<td><?=$rs['br_province']?></td>
										<td><?=$rs['data_other']?></td>
										<td><?=$rs['br_other']=="1" ? "ไม่มีสาขานี้": "";?></td>
										<td><?=$rs['timeStamp']?></td>
									</tr>
									<?php $i++;} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="bg-secondary  text-white p-3 bg_one">
			<div class="text-center">
				© บริษัท คอมพิวเตอร์ยูเนี่ยน จำกัด  (โทร.064-585-0738 หรือ support_center@cu.co.th)
			</div>
		</div>


		<?php 

		$sql = mysqli_query($conn,"SELECT old,count(rq_id)as s_sum FROM request Group by old ")or die(mysqli_error($conn));
		$old     = array();
		$x       = array();
		while ($rows = mysqli_fetch_assoc($sql)) {
			array_push($old,$rows['old']);
			array_push($x,$rows['s_sum']);
		}

		?>

		<!--===============================================================================================-->	
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<!--===============================================================================================-->

		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		

		<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

		<script type="text/javascript"> 
			$(document).ready(function() {
				var table = $('#example').DataTable({
					lengthChange: true,
					stateSave: true, 
					buttons: [
					{ extend: 'excel',
					messageTop: 'ข้อมูลรายการสำรวจอุปกรณ์คอมพิวเตอร์ประจำสาขาของผู้จัดการสาขา',
					className: 'btn-sm btn-warning',
					title: '' },
					{ extend: 'colvis', className: 'btn-sm btn-secondary' }
					],
					"lengthMenu": [[10,25, 50,100, -1], [10,25, 50,100, "All"]],
					"sPaginationType" : 'full_numbers', 'sPaging' : 'pagination',
					"drawCallback": function () {
						$('.dataTables_paginate > .pagination').addClass('pagination-sm');
					}
				});

				table.buttons().container()
				.appendTo( '#example_wrapper .col-md-6:eq(0) ' );
			}); 

			var ctx = document.getElementById('myChart').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ['<?=implode("','",$old);?>'],
					datasets: [{
						data: ['<?=implode("','",$x);?>'],
						backgroundColor: [				
						'rgba(63, 215 ,32 , 0.8)',
						'rgba(49 ,137 ,32, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(255, 206, 86, 0.8)',
						'rgba(75, 192, 192, 0.8)',
						'rgba(153, 102, 255, 0.8)',
						'rgba(255, 159, 64, 0.8)'
						],
						borderColor: [

						// 'rgba(46 ,139, 87 , 1)',
						// 'rgba(60 ,179 ,113, 1)',
						'rgba(255,255,255, 5)',
						'rgba(255,255,255, 5)',
						'rgba(255,255,255, 5)',
						'rgba(255,255,255, 5)',
						'rgba(255,255,255, 5)',
						'rgba(255,255,255, 5)',
						'rgba(255,255,255, 5)',
						'rgba(255,255,255, 5)',
						],
						borderWidth: 2
					}]
				}
			});

		</script>
	</body>
	</html>