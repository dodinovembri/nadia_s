  <!-- script untuk grafik -->
   <script src="assets/js/highcharts.js"></script>
   <script src="assets/js/exporting.js"></script>
   <script src="assets/js/export-data.js"></script>
   <!-- akhir script grafik -->
  <!-- Left side column. contains the logo and sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

<!-- menghitung jumlah user -->
<?php  
  include 'module/koneksi.php';
  $query = "SELECT COUNT(*) as jml_user FROM user";
  $hasil = mysqli_query($koneksi, $query);

  while ($jml = mysqli_fetch_array($hasil)) {
    $jumlah_user = $jml['jml_user'];
  }
?>

<?php 
  $query_grafik = "SELECT merk.merk as merk, COUNT(*) AS jumlah FROM tbl_data JOIN merk ON tbl_data.merk_lama = merk.id_merk GROUP BY tbl_data.merk_lama";
  $hasil_grafik = mysqli_query($koneksi, $query_grafik);
  $jml[] = "";
  $merk[] = "";
  foreach ($hasil_grafik as $row) {
    $jml[] = $row['jumlah'];
    $merk[] = $row['merk'];      
  }

  foreach ($jml as $ke => $var2) {
      $array2[] = (int)$var2;      
  }

  foreach ($merk as $ke => $var3) {
    $array3[] = $var3;       
  }
?>
<!-- akhir hitungan -->

<!-- untuk grafik pie -->
<?php  
  $query_pie_dibawah_10 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_dibawah_10 FROM tbl_data WHERE masa_pakai=0");
  foreach ($query_pie_dibawah_10 as $qpdb10) {
    $total_dibawah_10 = $qpdb10['jumlah_dibawah_10'];
  }

  $query_pie_diatas_10 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_diatas_10 FROM tbl_data WHERE masa_pakai=1");
  foreach ($query_pie_diatas_10 as $qpda10) {
    $total_diatas_10 = $qpda10['jumlah_diatas_10'];
  }
?>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">         
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">                      
                    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="col-md-6">                      
                    <div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>                     
                </div>                   
              </div>                      
            </div>
          </div> 
        </div>      
      </div>      
              <!-- /.row -->
     </section>
            <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  Highcharts.chart('container', {
  chart: {
    type: 'column'    
  },
  title: {
    text: 'Grafik Penggunaan Merk Meteran'
  },  
  xAxis: {
    categories: <?php echo json_encode($array3); ?>,
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Jumlah',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  tooltip: {
    valueSuffix: ' Unit'
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'Jumlah ',
    data: <?php echo json_encode($array2); ?>
  }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('container2', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Persentase Meteran'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'red'
        }
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Dibawah 10 Tahun',
      y: <?php echo $total_dibawah_10; ?>,
      sliced: true,
      selected: true
    }, {
      name: 'Diatas 10 Tahun',
      y: <?php echo $total_diatas_10; ?>
    }]
  }]
});
</script>

<?php include 'module/templates/footer.php'; ?>