<?php  
// ini_set("display_errors", "Off"); 

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

 //1a. Program utama 


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


  //menghitung otput dari hidden neuron dengan menggunakan fungsi tanh                      
  for($i = 0;$i<$jml_hidden;$i++)
  {
    $hiddenVal[$i] = 0.0;
    for($j = 0;$j<$jml_input;$j++)
    {
      $hiddenVal[$i] = $hiddenVal[$i] + ($inputan_data_train[$no_pola][$j] * $bobot_hidden_input[$j][$i]); //== || langkah 4== ||
    }
    $hiddenVal[$i] = (1/(1+(pow(2.71828183, -$hiddenVal[$i])))); //melakukan aktivasi rumus (2.2)
  }

  //menghitung output dari network, output neuoron adalah linear                       
  $outPred = 0.0;
  for($i = 0;$i<$jml_hidden;$i++)
  {
    $outPred = $outPred + $hiddenVal[$i] * $bobot_hidden_output[$i]; // == || langkah 5 || ==
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
    $ubah_bobot = $learning_rate_output * $error_this_pola * $hiddenVal[$k];
    $bobot_hidden_output[$k] = $bobot_hidden_output[$k] + $ubah_bobot; // == || langkah 6 || ==

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
  //menyesuaikan weight dari input-hidden                       
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
      $x = $x * $bobot_hidden_output[$i] * $error_this_pola * $learning_rate_input;
      $x = $x * $inputan_data_train[$no_pola][$k];
      $ubah_bobot = $x;
      $bobot_hidden_input[$k][$i] = $bobot_hidden_input[$k][$i] + $ubah_bobot; // == || langkah 8 || ==
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

  }
  // echo "Normalisasi DB ". $inputan_data_train[$i][0];


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

 
  
                                                          

 <?php for($i = 0;$i<$jml_pola;$i++)
  {
    $no_pola = $i;
    menghitung_network();

    if ($output_data_train[$no_pola] > $outPred) {
      $accuracy = (1-(($output_data_train[$no_pola]-$outPred)/($output_data_train[$no_pola]+$outPred)))*100;                            
    } else {
      $accuracy = (1-(($outPred-$output_data_train[$no_pola])/($output_data_train[$no_pola]+$outPred)))*100;                            
    } ?>  
    <?php // echo "pat = ".($no_pola+1)." actual = ".$output_data_train[$no_pola]." neural model = ".$outPred."</br>";
  }
  global $akurasi;
  $akurasi = $accuracy;
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

function mains() {  
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