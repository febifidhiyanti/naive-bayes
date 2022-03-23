<?php  

    $file_training = "./data.xlsx";        
    $train  = olahData(getData($file_training));
    
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
            $olah[$i] = array_map("strval", explode(" ", $d));        
            $i++;
        }
        unset($olah[6]);
        return $olah;
    }
?>