  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
           <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <?php
                      include 'module/koneksi.php';
                      ini_set("display_errors", "Off"); 

                      // deklarasi variabel terlebih dahulu
                      $numEpochs = 10000; //maksimum epoch
                      $numHidden = 3; // jumlah layar hidden
                      $learning_rate_input = 0.01; // nilai learning rate input
                      $learning_rate_output = 0.01; //nilai learning rate output

                      $numInputs = 4;
                      $numPatterns; 

                      $maxMerk;
                      $minMerk;
                      $maxTipe;
                      $minTipe;
                      $maxStand;
                      $minStand;
                      $maxJenis;
                      $minJenis;

                      $patNum;
                      $errThisPat;
                      $outPred;
                      $RMSerror;

                      $trainInputs = array();
                      $trainOutput = array();
                      $tracehold = array();
                      $minTrace;

                      // untuk output neuron
                      $hiddenVal = array();
                      // untuk weight
                      $weightsIH = array();
                      $weightsHO = array();

//1. Program start
                      main(); //memanggil fungsi main program

                      traceH();

                      if ($_POST['status'] == "cal") {
                        
                        global $trainInputs;
                        global $trainOutput;
                        global $patNum;
                        global $outPred;
                        global $minMerk;
                        global $maxMerk;
                        global $minTipe;
                        global $maxTipe;
                        global $minStand;
                        global $maxStand;
                        global $minJenis;
                        global $maxJenis;
                        global $minTrace;

                        // echo $minTrace;
                        // echo "<br><br>";
                        $minTrace = $minTrace + 0.2;
                        // $minTrace = round($minTrace);

                        
                        // echo $trainInputs[0][0];
                         // echo "<br><br>";


                        $trainInputs[0][0] = $_POST['merk'];
                        $trainInputs[0][1] = $_POST['tipe'];
                        $trainInputs[0][2] = $_POST['stand'];
                        $trainInputs[0][3] = $_POST['jenis'];

                        $patNum = 0;

                        dataNormalization();

                        calcNet();                        

                        // $minTrace = round($minTrace);

                        echo " Hasil Prediksi ". $outPred;
                        echo "<br>";
                        echo " Target dari DB ". $minTrace;
                        echo "<br>";

                        echo "Jika Prediksi >= dari Target DB Diatas 10 tahun";

                        if ($outPred >= $minTrace) { ?>
                          
                        <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-check"></i> Hasil Prediksi!</h4>
                          Prediksi Kwh Menggunakan Neural Network Algoritma Backpropagation adalah <strong><u><span style="color: yellow">Diatas 10 Tahun</span></u></strong> Untuk Masa Pakai
                        </div>
                          

                        <?php } else { ?>
                        
                        <div class="alert alert-warning  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-check"></i> Hasil Prediksi!</h4>
                          Prediksi Kwh Menggunakan Neural Network Algoritma Backpropagation adalah <strong><u><span style="color: blue">Dibawah 10 Tahun</span></u></strong> Untuk Masa Pakai
                        </div>

                        <?php } ?>
                        <label class="col-md-4"></label>
                          <div class="col-md-4"><div class="callout callout-info">
                            <h4>Akurasi Pengukuran!</h4>
                            <p>Nilai Prediksi Adalah <?php echo $outPred; ?></p>
                          </div></div>                                

                      <?php } elseif ($_POST['status'] == "train") {
                        
                        displayResults();

                      }

                      function traceH(){
                        global $numPatterns;
                        global $patNum;
                        global $outPred;
                        global $tracehold;
                        global $trainOutput;
                        global $minTrace;

                        for($i = 0; $i < $numPatterns; $i++ ){
                          
                          $patNum = $i;


                          if ($trainOutput[$i] == 1) {

                            calcNet();

                            array_push($tracehold, $outPred);

                          } 


                        }

                        $minTrace = min($tracehold);

                        // echo "minimal trace ". $minTrace;
                        
                      }

//1a. Program utama 
                      function main() {

                        global $numEpochs;
                        global $numPatterns;
                        global $patNum;
                        global $RMSerror;

                        // inisialisasi dengan random weight
                        initWeights(); //memanggil fungsi initWeights

                        // inisialisasi data
                        initData();

                        // train network
                        for($j = 0;$j <= $numEpochs;$j++)
                        {
                          for($i = 0;$i<$numPatterns;$i++)
                          {
                            //memilih pola random                            
                            $patNum = rand(0,$numPatterns-1);         

                            //menghitung output network sekaran dan pola error
                            calcNet();

                            //mengubah network weight
                            WeightChangesHO();
                            WeightChangesIH();
                          }

                          //menampilkan network error
                          calcOverallError();
                          // echo "<div class='epoch'>epoch = ".$j."  RMS Error = ".$RMSerror."</div>";
                        } 
                       }
// Akhir Dari Program Utama

                      //***********************************
                      function calcNet(){
                        global $numHidden;
                        global $hiddenVal;
                        global $weightsIH;
                        global $weightsHO;
                        global $trainInputs;
                        global $trainOutput;
                        global $numInputs;
                        global $patNum;
                        global $errThisPat;
                        global $outPred;


                        //menghitung otput dari hidden neuron dengan menggunakan fungsi tanh                      
                        for($i = 0;$i<$numHidden;$i++)
                        {
                          $hiddenVal[$i] = 0.0;
                          for($j = 0;$j<$numInputs;$j++)
                          {
                            $hiddenVal[$i] = $hiddenVal[$i] + ($trainInputs[$patNum][$j] * $weightsIH[$j][$i]);
                          }
                          $hiddenVal[$i] = tanh($hiddenVal[$i]);
                        }

                        //menghitung output dari network, output neuoron adalah linear                       
                        $outPred = 0.0;
                        for($i = 0;$i<$numHidden;$i++)
                        {
                          $outPred = $outPred + $hiddenVal[$i] * $weightsHO[$i];
                        }
                          //menghitung error
                          $errThisPat = $outPred - $trainOutput[$patNum];
                      }


                      //************************************
                      function WeightChangesHO(){
                        //menyesuaikan weight dari hidden-output                       
                        global $numHidden;
                        global $learning_rate_output;
                        global $errThisPat; 
                        global $hiddenVal;
                        global $weightsHO;

                        for($k = 0;$k<$numHidden;$k++)
                        {
                          $weightChange = $learning_rate_output * $errThisPat * $hiddenVal[$k];
                          $weightsHO[$k] = $weightsHO[$k] - $weightChange;

                          //output weight secara regular                          
                          if ($weightsHO[$k] < -5)
                          {
                            $weightsHO[$k] = -5;
                          }
                          elseif ($weightsHO[$k] > 5)
                          {
                            $weightsHO[$k] = 5;
                          }
                        }
                      }
                  
                      function WeightChangesIH(){
                        //menyesuaikan weight dari input-hidden                       
                        global $trainInputs;
                        global $numHidden;
                        global $numInputs;
                        global $hiddenVal;
                        global $weightsHO;
                        global $weightsIH;
                        global $learning_rate_input;
                        global $patNum;
                        global $errThisPat; 

                        for($i = 0;$i<$numHidden;$i++)
                        {
                          for($k = 0;$k<$numInputs;$k++)
                          {
                            $x = 1 - ($hiddenVal[$i] * $hiddenVal[$i]);
                            $x = $x * $weightsHO[$i] * $errThisPat * $learning_rate_input;
                            $x = $x * $trainInputs[$patNum][$k];
                            $weightChange = $x;
                            $weightsIH[$k][$i] = $weightsIH[$k][$i] - $weightChange;
                            // echo "i: ".$i." k: ".$k." weight: ".$weightsIH[$k][$i]."</br>";
                          }
                        }
                       }
                      
                      function initWeights(){
                        global $numHidden;
                        global $numInputs;
                        global $weightsIH;
                        global $weightsHO;

                        for($j = 0;$j<$numHidden;$j++)
                        {
                          $weightsHO[$j] = (rand()/32767 - 0.5)/2;
                          for($i = 0;$i<$numInputs;$i++)
                          {
                            $weightsIH[$i][$j] = (rand()/32767 - 0.5)/5;
                          }
                        }

                      }
                      
                      function initData(){
                        global $trainInputs; 
                        global $trainOutput;
                        global $numPatterns;

                        global $maxMerk;
                        global $minMerk;
                        global $maxTipe;
                        global $minTipe; 
                        global $maxStand;
                        global $minStand;
                        global $maxJenis;
                        global $minJenis; 

                        $countData = 0;
                        $tempMerk = array();
                        $tempTipe = array();
                        $tempStand = array();
                        $tempJenis = array();

                        include 'module/koneksi.php';
                        $query = mysqli_query($koneksi, "SELECT * FROM dt_training GROUP BY merk, tipe, stand, jenis");

                        while ($row = mysqli_fetch_array($query)) {
                          $merkData = $row['merk'];
                          $tipeData = $row['tipe'];
                          $standData = $row['stand'];
                          $jenisData = $row['jenis'];
                          $targetData = $row['target'];

                          $trainInputs[$countData][0] = $merkData;
                          $trainInputs[$countData][1] = $tipeData;
                          $trainInputs[$countData][2] = $standData;
                          $trainInputs[$countData][3] = $jenisData;
                          $trainOutput[$countData] = $targetData;

                          $countData++;
                        }

                        $numPatterns = $countData;

                        for ($i=0; $i < $countData ; $i++) 
                        { 
                          array_push($tempMerk, $trainInputs[$i][0]);
                          array_push($tempTipe, $trainInputs[$i][1]);
                          array_push($tempStand, $trainInputs[$i][2]);
                          array_push($tempJenis, $trainInputs[$i][3]);
                        }

                        $maxMerk = max($tempMerk);
                        $minMerk = min($tempMerk);
                        $maxTipe = max($tempTipe);
                        $minTipe = min($tempTipe);
                        $maxStand = max($tempStand);
                        $minStand = min($tempStand);
                        $maxJenis = max($tempJenis);
                        $minJenis = min($tempJenis);

//melakukan normalisasi terhadap data

                        for ($i=0; $i < $countData ; $i++) { 
                          $trainInputs[$i][0] = ($trainInputs[$i][0]-$minMerk)/($maxMerk-$minMerk); //normalisasi untuk merk
                          $trainInputs[$i][1] = ($trainInputs[$i][1]-$minTipe)/($maxTipe-$minTipe); //normaslisasi untuk tipe
                          $trainInputs[$i][2] = ($trainInputs[$i][2]-$minStand)/($maxStand-$minStand); //normaslisasi untuk tipe
                          $trainInputs[$i][3] = ($trainInputs[$i][3]-$minJenis)/($maxJenis-$minJenis); //normaslisasi untuk tipe
                      
                        }
                        // echo "Normalisasi DB ". $trainInputs[$i][0];


                       }

                      //************************************

                      function dataNormalization(){
                        global $maxMerk;
                        global $minMerk;
                        global $maxTipe;
                        global $minTipe;
                        global $maxStand;
                        global $minStand;
                        global $maxJenis;
                        global $minJenis; 
                        global $trainInputs;

                        if ($trainInputs[0][0] < $minMerk) { 
                          $minMerk = $trainInputs[0][0]; 
                        } elseif ($trainInputs[0][0] > $maxMerk) {
                          $maxMerk = $trainInputs[0][0];
                        }

                        if ($trainInputs[0][1] < $minTipe) {
                          $minTipe = $trainInputs[0][1];
                        } elseif ($trainInputs[0][1] > $maxTipe) {
                          $maxTipe = $trainInputs[0][1];
                        }

                        if ($trainInputs[0][2] < $minStand) { 
                          $minStand = $trainInputs[0][2]; 
                        } elseif ($trainInputs[0][2] > $maxStand) {
                          $maxStand = $trainInputs[0][2];
                        }

                        if ($trainInputs[0][3] < $minJenis) {
                          $minJenis = $trainInputs[0][3];
                        } elseif ($trainInputs[0][3] > $maxJenis) {
                          $maxJenis = $trainInputs[0][3];
                        }

                        $trainInputs[0][0] = ($trainInputs[0][0]-$minMerk)/($maxMerk-$minMerk);
                        $trainInputs[0][1] = ($trainInputs[0][1]-$minTipe)/($maxTipe-$minTipe);
                        $trainInputs[0][2] = ($trainInputs[0][2]-$minStand)/($maxStand-$minStand);
                        $trainInputs[0][3] = ($trainInputs[0][3]-$minJenis)/($maxJenis-$minJenis);

                        // echo " Normalisasi Input ". $trainInputs[0][0];

                      }
                      
                      function displayResults(){
                        global $numPatterns;
                        global $patNum;
                        global $outPred;
                        global $trainOutput; ?>

                        <div >
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-check"></i> Hasil Prediksi!</h4>
                          <div class="panel-body table-responsive">
                          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Target Data</th>
                                  <th>Neural Model</th>
                                </tr>
                              </thead>                                                      

                       <?php for($i = 0;$i<$numPatterns;$i++)
                        {
                          $patNum = $i;
                          calcNet();

                          if ($trainOutput[$patNum] > $outPred) {
                            $accuracy = (1-(($trainOutput[$patNum]-$outPred)/($trainOutput[$patNum]+$outPred)))*100;
                          } else {
                            $accuracy = (1-(($outPred-$trainOutput[$patNum])/($trainOutput[$patNum]+$outPred)))*100;
                          } ?>

                          <tr>
                              <td class='center'><?php echo ($patNum+1); ?></td>
                              <td class='center'><strong><?php echo $trainOutput[$patNum]; ?></strong></td>
                              <td><?php echo $outPred; ?></td>
                          </tr>
                              
                          <?php // echo "pat = ".($patNum+1)." actual = ".$trainOutput[$patNum]." neural model = ".$outPred."</br>";
                        }

                        // echo $outPred;

                        echo "</table>";  
                        echo "</div>";                      
                        echo "<div>Tingkat Keakuratan Prediksi Adalah "."<strong>".$accuracy."</strong>"."%.</div>";
                      }


                      //************************************
                      function calcOverallError(){
                        global $numPatterns;
                        global $patNum; 
                        global $errThisPat;
                        global $RMSerror; 

                        $RMSerror = 0.0;
                        for($i = 0;$i<$numPatterns;$i++)
                        {
                          $patNum = $i;
                          calcNet();
                          $RMSerror = $RMSerror + ($errThisPat * $errThisPat);
                        }
                        $RMSerror = $RMSerror/$numPatterns;
                        $RMSerror = sqrt($RMSerror);

                        // echo $RMSerror;
                      }


                      ?>

                       </div>
                                </div>
                                <!-- /.row -->
                              </div>
                            </div>
                            <!-- /.box -->
                          </div>
                          <!-- /.col -->
                        </div>      
                        <!-- /.row -->
                      </section>
                    </div>


<footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">Nadia</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>

<script src="assets/adminlte/dist/js/adminlte.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootswatch.js"></script>

<!-- tabel -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
 $('#example').dataTable( {
        "language": {
            "url": "assets/css/datatables/Indonesian.json"
        }
    } );
} );
</script> 

</html>