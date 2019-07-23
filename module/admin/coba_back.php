<?php  
include 'module/koneksi.php';

// deklarasi variabel terlebih dahulu
$numEpochs = 1000; //maksimum epoch
$numHidden = 3; //hidden layer number
$numInputs = 4; //jumlah inputan/tolak ukur/bobot
$LR_IH = 0.5; //LEARNING RATE INPUTz
$LR_HO = 0.5; //LEARNING RATE OUTPUT

$trainInputs = array();
$trainOutput = array();

$tracehold = array();
$numPatterns;

$maxMerk;
$minTipe;
$maxStand;
$minJenis;

$patNum;
$errThisPat;
$outPred;
$RMSerror;
$minTrace;

// the outputs of the hidden neurons

$hiddenVal = array();

// the weights
$weightsIH = array();
$weightsHO = array();


// inisialisasi random weight
	for($j = 0;$j<$numHidden;$j++)
    {
      $weightsHO[$j] = (rand()/32767 - 0.5)/2;
      for($i = 0;$i<$numInputs;$i++)
      {
        $weightsIH[$i][$j] = (rand()/32767 - 0.5)/5;
      }
    }

// inisialisasi data
    $countData = 0;
    $tempMerk = array();
	$tempTipe = array();
	$tempStand = array();
	$tempJenis = array();

	

	$query = mysqli_query($koneksi, "SELECT * FROM dt_training");

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

// melakukan normalisasi data

	for ($i=0; $i < $countData ; $i++) { 
		$trainInputs[$i][0] = ($trainInputs[$i][0]-$minMerk)/($maxMerk-$minMerk); //normalisasi untuk merk
		$trainInputs[$i][1] = ($trainInputs[$i][1]-$minTipe)/($maxTipe-$minTipe); //normaslisasi untuk tipe
		$trainInputs[$i][2] = ($trainInputs[$i][2]-$minStand)/($maxStand-$minStand); //normaslisasi untuk tipe
		$trainInputs[$i][3] = ($trainInputs[$i][3]-$minJenis)/($maxJenis-$minJenis); //normaslisasi untuk tipe
	}

// mencoba jaringan/network
	for($j = 0;$j <= $numEpochs;$j++)
	{
		for($i = 0;$i<$numPatterns;$i++)
		{
			//memilih pola/pattern secar random
			$patNum = rand(0,$numPatterns-1);		 	   	

			//menghitung output network dan eror dari pola			
			for($i = 0;$i<$numHidden;$i++)
			{
				$hiddenVal[$i] = 0.0;
				for($j = 0;$j<$numInputs;$j++)
				{
					$hiddenVal[$i] = $hiddenVal[$i] + ($trainInputs[$patNum][$j] * $weightsIH[$j][$i]);
				}
				$hiddenVal[$i] = tanh($hiddenVal[$i]);
			}

			//mengitung output network, output neuron adalah linear
			$outPred = 0.0;
			for($i = 0;$i<$numHidden;$i++)
			{
				$outPred = $outPred + $hiddenVal[$i] * $weightsHO[$i];
			}
				//menghitung eror
				$errThisPat = $outPred - $trainOutput[$patNum];

//mengubah weight
			for($k = 0;$k<$numHidden;$k++)
			{
				$weightChange = $LR_HO * $errThisPat * $hiddenVal[$k];
				$weightsHO[$k] = $weightsHO[$k] - $weightChange;

				//output weights secara regular
				if ($weightsHO[$k] < -5)
				{
					$weightsHO[$k] = -5;
				}
				elseif ($weightsHO[$k] > 5)
				{
					$weightsHO[$k] = 5;
				}
			}
//mengatur dan menyesuaikan bobot input-hidden
			for($i = 0;$i<$numHidden;$i++)
			{
			 	for($k = 0;$k<$numInputs;$k++)
			 	{
					$x = 1 - ($hiddenVal[$i] * $hiddenVal[$i]);
					$x = $x * $weightsHO[$i] * $errThisPat * $LR_IH;
					$x = $x * $trainInputs[$patNum][$k];
					$weightChange = $x;
					$weightsIH[$k][$i] = $weightsIH[$k][$i] - $weightChange;
					// echo "i: ".$i." k: ".$k." weight: ".$weightsIH[$k][$i]."</br>";
			 	}
			}
		}

//menampilkan kesalahan network secara keseluruha
		$RMSerror = 0.0;
		for($i = 0;$i<$numPatterns;$i++)
		{
			$patNum = $i;
				for($i = 0;$i<$numHidden;$i++)
	            {
	              $hiddenVal[$i] = 0.0;
	              for($j = 0;$j<$numInputs;$j++)
	              {
	                $hiddenVal[$i] = $hiddenVal[$i] + ($trainInputs[$patNum][$j] * $weightsIH[$j][$i]);
	              }
	              $hiddenVal[$i] = tanh($hiddenVal[$i]);
	            }
	            //mengkalkulasikan output dari network, output neuron adalah linear
	            $outPred = 0.0;
	            for($i = 0;$i<$numHidden;$i++)
	            {
	              $outPred = $outPred + $hiddenVal[$i] * $weightsHO[$i];
	            }
	              //menghitung error
	              $errThisPat = $outPred - $trainOutput[$patNum];
			$RMSerror = $RMSerror + ($errThisPat * $errThisPat);
		}
		$RMSerror = $RMSerror/$numPatterns;
		$RMSerror = sqrt($RMSerror);
		// echo "<div class='epoch'>epoch = ".$j."  RMS Error = ".$RMSerror."</div>";

	}

//menghitung trace
	for($i = 0; $i < $numPatterns; $i++ ){
		$patNum = $i;
		if ($trainOutput[$i] == 1) {
			for($i = 0;$i<$numHidden;$i++)
            {
              $hiddenVal[$i] = 0.0;
              for($j = 0;$j<$numInputs;$j++)
              {
                $hiddenVal[$i] = $hiddenVal[$i] + ($trainInputs[$patNum][$j] * $weightsIH[$j][$i]);
              }
              $hiddenVal[$i] = tanh($hiddenVal[$i]);
            }

           //mengitung output network, output neuron adalah linear
            $outPred = 0.0;
            for($i = 0;$i<$numHidden;$i++)
            {
              $outPred = $outPred + $hiddenVal[$i] * $weightsHO[$i];
            }
              //menghitung error
              $errThisPat = $outPred - $trainOutput[$patNum];
			array_push($tracehold, $outPred);
		} 
	}
	$minTrace = min($tracehold);

	if ($_GET['status'] == "cal") {

	$trainInputs[0][0] = $_POST['merk'];
	$trainInputs[0][1] = $_POST['tipe'];
	$trainInputs[0][2] = $_POST['stand'];
	$trainInputs[0][3] = $_POST['jenis'];

	$patNum = 0;

// melakukan normalisasi data inputan baru
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

	$trainInputs[$i][0] = ($trainInputs[$i][0]-$minMerk)/($maxMerk-$minMerk); //normalisasi untuk merk
	$trainInputs[$i][1] = ($trainInputs[$i][1]-$minTipe)/($maxTipe-$minTipe); //normaslisasi untuk tipe
	$trainInputs[$i][2] = ($trainInputs[$i][2]-$minStand)/($maxStand-$minStand); //normaslisasi untuk tipe
	$trainInputs[$i][3] = ($trainInputs[$i][3]-$minJenis)/($maxJenis-$minJenis); //normaslisasi untuk tipe

//menghitung network hidden
	for($i = 0;$i<$numHidden;$i++)
    {
      $hiddenVal[$i] = 0.0;

      for($j = 0;$j<$numInputs;$j++)
      {
        $hiddenVal[$i] = $hiddenVal[$i] + ($trainInputs[$patNum][$j] * $weightsIH[$j][$i]);
      }

      $hiddenVal[$i] = tanh($hiddenVal[$i]);

    }

//mengitung output network, output neuron adalah linear
    $outPred = 0.0;
    for($i = 0;$i<$numHidden;$i++)
    {
      $outPred = $outPred + $hiddenVal[$i] * $weightsHO[$i];
    }
      //Menghitung error
      $errThisPat = $outPred - $trainOutput[$patNum];
	if ($outPred >= $minTrace) {
		echo "<div id='result'>Diatas 10 Tahun</div>";
	} else {
	
		echo "<div id='result'>Dibawah 10 Tahun</div>";

	}

	echo "<div id='outputValue'>".$outPred."</div>";

	} elseif ($_GET['status'] == "train") {
		
		//menampilkan error
		echo "<table id='tableTrain' border>";
		echo "<tr>
					<th>No</th>
					<th>Actual</th>
					<th>Neural Model</th>
				</tr>";
		for($i = 0;$i<$numPatterns;$i++)
		{
			$patNum = $i;
			calcNet();

			if ($trainOutput[$patNum] > $outPred) {
				$accuracy = (1-(($trainOutput[$patNum]-$outPred)/($trainOutput[$patNum]+$outPred)))*100;
			} else {
				$accuracy = (1-(($outPred-$trainOutput[$patNum])/($trainOutput[$patNum]+$outPred)))*100;
			}

			echo "<tr>
					<td class='center'>".($patNum+1)."</td>
					<td class='center'><strong>".$trainOutput[$patNum]."</strong></td>
					<td>".$outPred."</td>
				</tr>";
			// echo "pat = ".($patNum+1)." actual = ".$trainOutput[$patNum]." neural model = ".$outPred."</br>";
		}

		echo "</table>";

	}
?>