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
                            
                            $query_hapus = "TRUNCATE dt_training";
                            $result = mysqli_query($conn, $query_hapus);
                          
                            for($i=0;$i<$sheetCount;$i++)
                            {                                
                                $Reader->ChangeSheet($i);                                
                                foreach ($Reader as $Row)
                                {                                                                  
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
                                    $jenis = "";
                                    if(isset($Row[19])) {
                                        $jenis = mysqli_real_escape_string($conn,$Row[19]);
                                    }
                                    $target = "";
                                    if(isset($Row[18])) {
                                        $target = mysqli_real_escape_string($conn,$Row[18]);
                                    }
                                    $masa_pakai = "";
                                    if(isset($Row[20])) {
                                        $masa_pakai = mysqli_real_escape_string($conn,$Row[20]);
                                    }                                     
                                    if (!empty($stand_lama) || !empty($merk_lama) || !empty($tipe_lama) || !empty($jenis) || !empty($target) || !empty($masa_pakai)) {
                                        $query = "insert into dt_training (merk, tipe, stand, jenis, target, masa_pakai) values('".$merk_lama."', '".$tipe_lama."', '".$stand_lama."', '".$jenis."', '".$target."', '".$masa_pakai."')";

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