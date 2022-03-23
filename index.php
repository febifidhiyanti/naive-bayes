<?php 
    require 'naivebayes.php';

    $data = olahData(getData("data.xlsx"));    
    
    function getData($file){
        $fh = fopen($file, "r");
        $i = 0;
    
        while (!feof($fh)) {
            $line[$i] = fgets($fh);
            $i++;
        }
               
        fclose($fh);
        return $line;
    }
    
    function olahData($data){
        $i = 0;
        $olah = null;
        foreach ($data as $d) {
            $olah[$i] = array_map("trim", explode(" ", $d));        
            $i++;
        }
        
        return $olah;
    }    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Näive Bayes Classifier</title>

    <!-- Bootstrap -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-narrow.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <form method="post">
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="umur">Pilih kondisi umur :</label>                        
                        <select name="umur" id="in_umur" class="form-control">
                            <option value="">None</option>
                            <option value="<=30"><=30</option>
                            <option value="30-40">30-40</option>
                            <option value=">40">>40</option>
                        </select>                        
                    </div>                    
                    <div class="col-md-4">
                        <label for="gaji">Pilih kondisi gaji :</label>                        
                        <select name="gaji" id="in_gaji" class="form-control">
                            <option value="">None</option>
                            <option value="Tinggi">Tinggi</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Rendah">Rendah</option>
                        </select>                        
                    </div>
                    <div class="col-md-4">
                        <label for="status">Pilih tingkat status :</label>
                        <select name="status" id="in_status" class="form-control">
                            <option value="">None</option>
                            <option value="Single">Single</option>
                            <option value="Menikah">Menikah</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="hutang">Pilih keterangan hutang :</label>
                        <select name="hutang" id="in_hutang" class="form-control">
                            <option value="">None</option>
                            <option value="Punya">Punya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>                                                            
                    <div class="col-md-12" style="margin : 30px 0">
                        <button class="btn btn-primary btn-block" type="submit">Cari</button>                            
                    </div>                        
                </div>                
            </form>
        </div>
        
        <?php
        if (isset($_POST)) {
            $data_test = @[$_POST['umur'], $_POST['gaji'] ,$_POST['status'] ,$_POST['hutang']];

            $nb = new NaiveBayes($data, ["Umur", "Gaji", "Status", "Hutang"]);
        
            $result = $nb->run()->predict($data_test);
            
            ?>
            
        <div class="row">            
            <div class="col-md-6">
                <pre>
                    <?php print_r($result); ?>
                </pre>
            </div>
            <div class="col-md-6">
                <label>Apakah membeli laptop baru ?</label>
                <?= array_keys($result)[0] ?>
            </div>
        </div>

        <?php            
        }        
        ?>
        

    </div> <!-- /container -->

    <!-- jQuery Slim (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./bootstrap/js/jquery.slim.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
