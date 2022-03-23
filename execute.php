<?php 
    require 'naivebayes.php';

    $data = olahData(getData("data.xlsx"));    
    
    $data_test = ["<=30","Rendah","Menikah","Punya"];

    $nb = new NaiveBayes($data, ["Umur", "Gaji", "Status", "Hutang"]);

    print_r($nb->run()->predict($data_test));
    
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