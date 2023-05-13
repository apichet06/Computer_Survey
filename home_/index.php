<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>KBANK</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">
  <?php require_once '../db/config.php'; ?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="img/logo.png" width="35"> Kbank</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="logout.php"> Admin ออกจากระบบ</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-white text-white d-none d-sm-block">
    <div class="container text-center hidden-xs-down">
      <img src="img/kb.png" width="40%">
    </div>
  </header>

  <section id="services" class="bg-light">
    <h2 class="text-center">กราฟสรุปจำนวนอุปกรณ์คอมพิวเตอร์</h2>
    <div class="row justify-content-center">
      <div class="col-md-6 ">
        <div class="card wrap-input100">
          <div class="card-body">
            <canvas id="myChart" width="400" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section> 

  <section id="services" class="bg-light">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12  ">
          <div class="card">
            <div class="card-body">
              <h2>รายการอุปกรณ์คอมพิวเตอร์ประจำสาขา</h2>
              <div class="container-fluid">
                <table class="table table-bordered table-responsive" id="example">
                  <thead >
                    <tr class="align-middle text-nowrap">
                      <th>No.</th>
                      <th>ชื่อ-สกุล</th>
                      <th>รหัสสาขา</th>
                      <th>ชื่อสาขา</th>
                      <th>อุปกรณ์ที่มี</th>
                      <th>Team</th>
                      <th>หัวหน้าสาขา</th>
                      <th>เบอร์โทรหัวหน้าสาขา</th>
                      <th>เบอร์โทรสาขา</th>
                      <th>เขต/อำเภอ</th>
                      <th>จังหวัด</th>
                      <th>ถนน</th>
                      <th>เวลาบันทึก</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $sql = mysqli_query($conn,"SELECT * FROM request a 
                    INNER JOIN kb_branch b 
                    on a.br_id = b.br_code")or die(mysqli_error($conn)); 
                    $i=1;
                    while ($rs = mysqli_fetch_assoc($sql)) { ?>
                    <tr>  
                      <td><?=$i?></td>
                      <td><?=$rs['name']?></td>
                      <td><?=$rs['br_id']?></td>
                      <td><?=$rs['br_name']?></td>
                      <td><?=$rs['old']?></td>
                      <td><?=$rs['br_team']?></td>
                      <td><?=$rs['br_manager_name']?></td>
                      <td><?=$rs['br_manager_phone']?></td>
                      <td><?=$rs['br_branch_phone']?></td>
                      <td><?=$rs['br_ampore']?></td>
                      <td><?=$rs['br_province']?></td>
                      <td><?=$rs['br_road']?></td>
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
    </div>
  </div>
</section>
<?php 

    $sql = mysqli_query($conn,"SELECT old,count(rq_id)as s_sum FROM request Group by old ")or die(mysqli_error($conn));
    $old     = array();
    $x       = array();
    while ($rows = mysqli_fetch_assoc($sql)) {
      array_push($old,$rows['old']);
      array_push($x,$rows['s_sum']);
    }

    ?>
<!-- Footer -->
<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
  </div>
  <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom JavaScript for this theme -->
<script src="js/scrolling-nav.js"></script>

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

  var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['<?=implode("','",$old);?>'],
          datasets: [{
            data: ['<?=implode("','",$x);?>'],
            backgroundColor: [        
            'rgba(46 ,139, 87 , 0.8)',
            'rgba(60 ,179 ,113, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 159, 64, 0.8)'
            ],
            borderColor: [
           
            'rgba(255,255,255, 5)',
            'rgba(255,255,255, 5)',
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
    $(document).ready(function() {
    var table = $('#example').DataTable({
      lengthChange: true,
      stateSave: true, 
      buttons: [
      { extend: 'excel',
        messageTop: 'รายงานเข้าการลงทะเบียนอุปกร์คอมพิวเตอร์ประจำสาขา',
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
 
      

    </script>
</body>
</html>
