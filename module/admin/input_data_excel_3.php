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
                    ini_set('max_execution_time', 0);     
                    include "script.php";
                    $conn = mysqli_connect("localhost","root","","nadia");
                    require_once('./assets/vendor/php-excel-reader/excel_reader2.php');
                    require_once('./assets/vendor/SpreadsheetReader.php');
                    if (isset($_POST["import"]))
                    {                                          
                      $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
                      
                      if(in_array($_FILES["file"]["type"],$allowedFileType)){

                            $targetPath = 'uploads/'.$_FILES['file']['name'];
                            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
                            
                            $Reader = new SpreadsheetReader($targetPath);                            
                            $sheetCount = count($Reader->sheets());
                            
                            $query_hapus = "TRUNCATE tbl_data";
                            $result = mysqli_query($conn, $query_hapus);

                            mains();     
                            traceH();                                                                 

                            for($i=0;$i<$sheetCount;$i++)
                            {                                
                                $Reader->ChangeSheet($i);                                
                                foreach ($Reader as $Row)
                                {   

                                    $id_pelanggan = "";
                                    if(isset($Row[0])) {
                                        $id_pelanggan = mysqli_real_escape_string($conn,$Row[0]);
                                    }                                  
                                    $nama = "";
                                    if(isset($Row[1])) {
                                        $nama = mysqli_real_escape_string($conn,$Row[1]);
                                    }
                                    $alamat = "";
                                    if(isset($Row[2])) {
                                        $alamat = mysqli_real_escape_string($conn,$Row[2]);
                                    }
                                    $tarip = "";
                                    if(isset($Row[3])) {
                                        $tarip = mysqli_real_escape_string($conn,$Row[3]);
                                    }
                                    $daya = "";
                                    if(isset($Row[4])) {
                                        $daya = mysqli_real_escape_string($conn,$Row[4]);
                                    }
                                    $stand_lama = "";
                                    if(isset($Row[6])) {
                                        $stand_lama = mysqli_real_escape_string($conn,$Row[6]);
                                    }                                     
                                    $merk_lama = "";
                                    if(isset($Row[7])) {
                                        $merk_lama = mysqli_real_escape_string($conn,$Row[7]);
                                    }                                     
                                    $tipe_lama = "";
                                    if(isset($Row[8])) {
                                        $tipe_lama = mysqli_real_escape_string($conn,$Row[8]);
                                    }                                     
                                    $no_seri_lama = "";
                                    if(isset($Row[9])) {
                                        $no_seri_lama = mysqli_real_escape_string($conn,$Row[9]);
                                    }                                     
                                    $tahun_lama = "";
                                    if(isset($Row[10])) {
                                        $tahun_lama = mysqli_real_escape_string($conn,$Row[10]);
                                    }                                                                                
                                    $jenis = "";
                                    if(isset($Row[19])) {
                                        $jenis = mysqli_real_escape_string($conn,$Row[19]);                                        
                                    }
                                    $masa_pakai = "";
                                    if(isset($Row[18])) {
                                        $masa_pakai = mysqli_real_escape_string($conn,$Row[18]);
                                    }                                     
                                    if (!empty($id_pelanggan) || !empty($nama) || !empty($alamat) || !empty($tarip) || !empty($daya) || !empty($stand_lama) || !empty($merk_lama) || !empty($tipe_lama) || !empty($no_seri_lama) || !empty($tahun_lama) || !empty($jenis) || !empty($masa_pakai)) {
                                                                                                                  
                                       
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

                                              $inputan_data_train[0][0] = $merk_lama;
                                              $inputan_data_train[0][1] = $tipe_lama;
                                              $inputan_data_train[0][2] = $stand_lama;
                                              $inputan_data_train[0][3] = $jenis;

                                              $no_pola = 0;

                                              dataNormalization();

                                              menghitung_network();                   

                                              if ($outPred >= $minTrace) {
                                                  $prediksi = 1;                                                   
                                                                               
                                                  }
                                              else if ($outPred < $minTrace){                                                  
                                               $prediksi = 0;                                               
                                              }
                                      

                                               $query = "insert into tbl_data (id_pelanggan, nama, alamat, tarip, daya, stand_lama, merk_lama, tipe_lama, no_seri_lama, tahun_lama, jenis, masa_pakai, masa_prediksi) values('".$id_pelanggan."','".$nama."', '".$alamat."', '".$tarip."', '".$daya."', '".$stand_lama."', '".$merk_lama."', '".$tipe_lama."', '".$no_seri_lama."', '".$tahun_lama."', '".$jenis."', '".$masa_pakai."', '".$prediksi."')";

                                              $result = mysqli_query($conn, $query);                                    
                                              if (! empty($result)) {
                                                  $type = "success";
                                                  $message = "Data Telah Di Import Ke Database";
                                              } else {
                                                  $type = "error";
                                                  $message = "Problem in Importing Excel Data";
                                              }
                                                                                                       
                                            }                                        
                                    
                                }
                            
                             }
                      }
                      else
                      { 
                            $type = "error";
                            $message = "Invalid File Type. Upload Excel File.";
                      }
                    }
                    ?>              

                    <body>
                        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>

                        <h2>Import Data ke Database</h2>
                        
                        <div class="outer-container">
                            <form action="" method="post"
                                name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                <div>
                                    <label>Pilih File Excel</label> <input type="file" name="file"
                                        id="file" accept=".xls,.xlsx"><br>
                                    <button type="submit" id="submit" name="import"
                                        class="btn-submit">Import</button>
                            
                                </div>
                            
                            </form>                            
                            
                        </div>                        

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
<?php include 'module/templates/footer.php'; ?>