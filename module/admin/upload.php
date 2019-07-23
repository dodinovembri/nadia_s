  <div class="content-wrapper">
   <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <?php
                      include 'module/koneksi.php';
                      ini_set("display_errors", "Off"); 

                      // deklarasi variabel terlebih dahulu
                      $jml_epochs = 10000; //maksimum epoch
                      $jml_hidden = 3; // jumlah layar hidden
                      $learning_rate_input = 0.2; // nilai learning rate input
                      $learning_rate_output = 0.2; //nilai learning rate output
                      $jml_input = 4;
                      $jml_pola; //berdasarkan banyak data

                      $maxMerk;
                      $minMerk;
                      $maxTipe;
                      $minTipe;
                      $maxStand;
                      $minStand;
                      $maxJenis;
                      $minJenis;

                      $no_pola;
                      $error_this_pola;
                      $outPred;
                      $RMSerror;

                      $inputan_data_train = array();
                      $output_data_train = array();
                      $tracehold = array();
                      $minTrace;

                      // untuk output neuron
                      $hiddenVal = array();
                      // untuk weight
                      $bobot_hidden_input = array();
                      $bobot_hidden_output = array();

                      $akurasi;

                      //1. Program start
                      main(); //memanggil fungsi main program

                      traceH();
                      $status = "cal";
                      if ($status == "cal") {
                        
                        global $inputan_data_train;
                        global $output_data_train;
                        global $no_pola;
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
                        // $minTrace = $minTrace + 0.2;
                        // $minTrace = round($minTrace);

                        
                        // echo $inputan_data_train[0][0];
                         // echo "<br><br>";


                        $inputan_data_train[0][0] = 2;
                        $inputan_data_train[0][1] = 3;
                        $inputan_data_train[0][2] = 1;
                        $inputan_data_train[0][3] = 1;

                        $no_pola = 0;

                        dataNormalization(); //menerima sinyal inputan == || langkah 3 || == dan akan diteruskan ke semua unit tersembunyi

                        menghitung_network(); //fungsi yang menghitung snyal input                  

                        // echo $outPred. " || " .$minTrace;
                        // echo "<br>";                                            

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
                        global $jml_pola;
                        global $no_pola;
                        global $outPred;
                        global $tracehold;
                        global $output_data_train;
                        global $minTrace;

                        for($i = 0; $i < $jml_pola; $i++ ){
                          
                          $no_pola = $i;


                          if ($output_data_train[$i] == 1) {

                            menghitung_network();

                            array_push($tracehold, $outPred);

                          } 


                        }

                        $minTrace = min($tracehold);

                        // echo "minimal trace ". $minTrace;
                        
                      }

                      //1a. Program utama 
                      function main() {
                        global $jml_epochs;
                        global $jml_pola;
                        global $no_pola;
                        global $RMSerror;
                        // inisialisasi dengan random weight
                        inisialisasi_bobot(); //memanggil fungsi inisialisasi_bobot ==|| Langkah 0 = inisialisasi bobot ||===
                        // inisialisasi data
                        inisialisasi_data();
                        // train network
                        for($j = 0;$j <= $jml_epochs;$j++)
                        {
                          for($i = 0;$i<$jml_pola;$i++)
                          {
                            //memilih pola random                            
                            $no_pola = rand(0,$jml_pola-1);         
                            //menghitung output network sekaran dan pola error
                            menghitung_network();
                            //Perubahan  bobot network                                                    
                            perubahan_bobot_hidden_output();
                            perubahan_bobot_hidden_input();
                          }
                          //menampilkan network error
                          menghitung_error_keseluruhan();
                          // echo "<div >epoch = ".$j."  RMS Error = ".$RMSerror."</div>";
                        } 
                       }
                      // Akhir Dari Program Utama
                     
                      function menghitung_network(){
                        global $jml_hidden;
                        global $hiddenVal;
                        global $bobot_hidden_input;
                        global $bobot_hidden_output;
                        global $inputan_data_train;
                        global $output_data_train;
                        global $jml_input;
                        global $no_pola;
                        global $error_this_pola;
                        global $outPred;


                        //menghitung otput dari hidden neuron dan aktivasi                   
                        for($i = 0;$i<$jml_hidden;$i++)
                        {
                          $hiddenVal[$i] = 0.0;
                          for($j = 0;$j<$jml_input;$j++)
                          {
                            $hiddenVal[$i] = $hiddenVal[$i] + ($inputan_data_train[$no_pola][$j] * $bobot_hidden_input[$j][$i]);// rumus (2.1) //== || langkah 4 == ||     
                            // echo $inputan_data_train[$no_pola][$j]                      ;
                          }
                          $hiddenVal[$i] = (1/(1+(pow(2.71828183, -$hiddenVal[$i])))); //melakukan aktivasi rumus (2.2)
                          // $hiddenVal[$i] = tanh($hiddenVal[$i]); //melakukan aktivasi
                          // echo $hiddenVal[$i];                           
                          // echo "<br>";
                        }                        

                        //menghitung output dari network, output neuoron adalah linear                       
                        $outPred = 0.0;
                        for($i = 0;$i<$jml_hidden;$i++)
                        {
                          $outPred = $outPred + $hiddenVal[$i] * $bobot_hidden_output[$i]; // == || langkah 5 || ==   rumus (2.3)  
                          $outPred = (1/(1+(pow(2.71828183, -$outPred)))); //rumus 2.4                     
                        }                                
                          //menghitung error
                          $error_this_pola = $outPred - $output_data_train[$no_pola];                         
                      }


                      //************************************
                      function perubahan_bobot_hidden_output(){
                        //menyesuaikan weight dari hidden-output                       
                        global $jml_hidden;
                        global $learning_rate_output;
                        global $error_this_pola; 
                        global $hiddenVal;
                        global $bobot_hidden_output;

                        for($k = 0;$k<$jml_hidden;$k++)
                        {
                          $ubah_bobot = $learning_rate_output * $error_this_pola * $hiddenVal[$k]; //rumus (2.6) langkah 6
                         
                          $bobot_hidden_output[$k] = $bobot_hidden_output[$k] + $ubah_bobot; // == || langkah 8 || == memperbaiki bias dan bobot output
                          // echo "i: ".$i." k: ".$k." weight: ".$bobot_hidden_output[$k]."</br>";

                          //output weight secara regular                          
                          if ($bobot_hidden_output[$k] < -5)
                          {
                            $bobot_hidden_output[$k] = -5;
                          }
                          elseif ($bobot_hidden_output[$k] > 5)
                          {
                            $bobot_hidden_output[$k] = 5;
                          }
                        }
                      }
                  
                      function perubahan_bobot_hidden_input(){
                        //menyesuaikan bobot dari input-hidden                       
                        global $inputan_data_train;
                        global $jml_hidden;
                        global $jml_input;
                        global $hiddenVal;
                        global $bobot_hidden_output;
                        global $bobot_hidden_input;
                        global $learning_rate_input;
                        global $no_pola;
                        global $error_this_pola; 

                        for($i = 0;$i<$jml_hidden;$i++)
                        {
                          for($k = 0;$k<$jml_input;$k++)
                          {
                            $x = 1 - ($hiddenVal[$i] * $hiddenVal[$i]);
                            $x = $x * $bobot_hidden_output[$i] * $error_this_pola * $learning_rate_input;// rumus (2.7) langkah 7
                            $x = $x * $inputan_data_train[$no_pola][$k];
                            $ubah_bobot = $x;
                            $bobot_hidden_input[$k][$i] = $bobot_hidden_input[$k][$i] + $ubah_bobot; // rumus (2.11) == || langkah 8 || == memperbaiki bias dan bobot input
                            // echo "i: ".$i." k: ".$k." weight: ".$bobot_hidden_input[$k][$i]."</br>";
                          }
                        }
                       }
                      
                      function inisialisasi_bobot(){
                        global $jml_hidden;
                        global $jml_input;
                        global $bobot_hidden_input;
                        global $bobot_hidden_output;

                        for($j = 0;$j<$jml_hidden;$j++)
                        {
                          $bobot_hidden_output[$j] = rand()/getrandmax()*0.5-0.5; //bilangan acak kecil

                          for($i = 0;$i<$jml_input;$i++)
                          {
                            $bobot_hidden_input[$i][$j] = rand()/getrandmax()*0.5-0.5; //bilangan acak kecil
                            // echo $bobot_hidden_input[$i][$j]; //untuk menampilkan nilai inisialisasi bobot
                            // echo "<br>";
                          }                          
                        }

                      }
                      
                      function inisialisasi_data(){
                        global $inputan_data_train; 
                        global $output_data_train;
                        global $jml_pola;

                        global $maxMerk;
                        global $minMerk;
                        global $maxTipe;
                        global $minTipe; 
                        global $maxStand;
                        global $minStand;
                        global $maxJenis;
                        global $minJenis; 

                        $jml_data = 0;
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

                          $inputan_data_train[$jml_data][0] = $merkData;
                          $inputan_data_train[$jml_data][1] = $tipeData;
                          $inputan_data_train[$jml_data][2] = $standData;
                          $inputan_data_train[$jml_data][3] = $jenisData;
                          $output_data_train[$jml_data] = $targetData;

                          $jml_data++;
                        }

                        $jml_pola = $jml_data;

                        for ($i=0; $i < $jml_data ; $i++) 
                        { 
                          array_push($tempMerk, $inputan_data_train[$i][0]);
                          array_push($tempTipe, $inputan_data_train[$i][1]);
                          array_push($tempStand, $inputan_data_train[$i][2]);
                          array_push($tempJenis, $inputan_data_train[$i][3]);
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

                        for ($i=0; $i < $jml_data ; $i++) { 
                          $inputan_data_train[$i][0] = ($inputan_data_train[$i][0]-$minMerk)/($maxMerk-$minMerk); //normalisasi untuk merk
                          $inputan_data_train[$i][1] = ($inputan_data_train[$i][1]-$minTipe)/($maxTipe-$minTipe); //normaslisasi untuk tipe
                          $inputan_data_train[$i][2] = ($inputan_data_train[$i][2]-$minStand)/($maxStand-$minStand); //normaslisasi untuk tipe
                          $inputan_data_train[$i][3] = ($inputan_data_train[$i][3]-$minJenis)/($maxJenis-$minJenis); //normaslisasi untuk tipe
                          // echo "Normalisasi DB ". $inputan_data_train[$i][0];
                          // echo "<br>";
                        }



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
                        global $inputan_data_train;

                        if ($inputan_data_train[0][0] < $minMerk) { 
                          $minMerk = $inputan_data_train[0][0]; 
                        } elseif ($inputan_data_train[0][0] > $maxMerk) {
                          $maxMerk = $inputan_data_train[0][0];
                        }

                        if ($inputan_data_train[0][1] < $minTipe) {
                          $minTipe = $inputan_data_train[0][1];
                        } elseif ($inputan_data_train[0][1] > $maxTipe) {
                          $maxTipe = $inputan_data_train[0][1];
                        }

                        if ($inputan_data_train[0][2] < $minStand) { 
                          $minStand = $inputan_data_train[0][2]; 
                        } elseif ($inputan_data_train[0][2] > $maxStand) {
                          $maxStand = $inputan_data_train[0][2];
                        }

                        if ($inputan_data_train[0][3] < $minJenis) {
                          $minJenis = $inputan_data_train[0][3];
                        } elseif ($inputan_data_train[0][3] > $maxJenis) {
                          $maxJenis = $inputan_data_train[0][3];
                        }

                        $inputan_data_train[0][0] = ($inputan_data_train[0][0]-$minMerk)/($maxMerk-$minMerk);
                        $inputan_data_train[0][1] = ($inputan_data_train[0][1]-$minTipe)/($maxTipe-$minTipe);
                        $inputan_data_train[0][2] = ($inputan_data_train[0][2]-$minStand)/($maxStand-$minStand);
                        $inputan_data_train[0][3] = ($inputan_data_train[0][3]-$minJenis)/($maxJenis-$minJenis);

                        // echo " Normalisasi Input ". $inputan_data_train[0][0];

                      }
                      
                      function displayResults(){
                        global $jml_pola;
                        global $no_pola;
                        global $outPred;
                        global $output_data_train; ?>

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
                        
                                                                                

                       <?php for($i = 0;$i<$jml_pola;$i++)
                        {
                          $no_pola = $i;
                          menghitung_network();

                          if ($output_data_train[$no_pola] > $outPred) {
                            $accuracy = (1-(($output_data_train[$no_pola]-$outPred)/($output_data_train[$no_pola]+$outPred)))*100;                            
                          } else {
                            $accuracy = (1-(($outPred-$output_data_train[$no_pola])/($output_data_train[$no_pola]+$outPred)))*100;                            
                           } ?>

                          <tr>
                              <td class='center'><?php echo ($no_pola+1); ?></td>
                              <td class='center'><strong><?php echo $output_data_train[$no_pola]; ?></strong></td>
                              <td><?php echo $outPred; ?></td>
                          </tr>
                              
                          <?php // echo "pat = ".($no_pola+1)." actual = ".$output_data_train[$no_pola]." neural model = ".$outPred."</br>";
                        }

                        // echo $outPred;

                        echo "</table>";  
                        echo "</div>";                      
                        echo "<div>Tingkat Keakuratan Prediksi Adalah "."<strong>".$accuracy."</strong>"."%.</div>";
                      }


                      //************************************
                      function menghitung_error_keseluruhan(){
                        global $jml_pola;
                        global $no_pola; 
                        global $error_this_pola;
                        global $RMSerror; 

                        $RMSerror = 0.0;
                        for($i = 0;$i<$jml_pola;$i++)
                        {
                          $no_pola = $i;
                          menghitung_network();
                          $RMSerror = $RMSerror + ($error_this_pola * $error_this_pola);
                        }
                        $RMSerror = $RMSerror/$jml_pola;
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