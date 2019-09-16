<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include 'Database.php';
            include 'BandTableDraw.php';
            include 'DrawDataInPDF.php';
            
            $db = new Database();
            $metallica = array();
            $nirvana = array();
            
            $flag=true;   // flag-> true za PDF, false za HTML
            
            $i=0;          
            $CSVHandle = fopen("songs.csv", "r");
            while (($row = fgetcsv($CSVHandle, 0, ";")) !== FALSE){
                if($row[0]=="performer")
                    continue;
                //if(++$i>=10) 
                    //break;  
                if($row[0] == "M")
                {
                    $metallica[$row[1]] = array('anger'=>0,'anticipation'=>0,'disgust'=>0,'fear'=>0,'joy'=>0,'negative'=>0,'positive'=>0,'sadness'=>0,'surprise'=>0,'trust'=>0);
                }
                else if($row[0] == "N")
                {
                    $nirvana[$row[1]] = array('anger'=>0,'anticipation'=>0,'disgust'=>0,'fear'=>0,'joy'=>0,'negative'=>0,'positive'=>0,'sadness'=>0,'surprise'=>0,'trust'=>0);
                }
                
                $verse = strtok($row[2], ",");
                while($verse !== false){
                    $words = explode(" ", $verse);
                    foreach ($words as $word) {
                        $emotions = $db->GetEmotionsFromWord($word);
                        foreach ($emotions as $value) {
                            if($row[0] == "M")
                            {
                                ++$metallica[$row[1]][$value["emotion"]];
                            }
                            else if($row[0] == "N")
                            {
                                ++$nirvana[$row[1]][$value["emotion"]];
                            }
                        }
                    }
                    $verse=strtok(' ');
                }
            }
            
            if($flag){
                $pdf = new DrawDataInPDF();
                $pdf->DrawTable("Metallica", $metallica);
                $pdf->DrawTable("Nirvana", $nirvana);
            }else{
                $tableDraw = new BandTableDraw();
                $tableDraw->Draw("Metallica", $metallica);
                $tableDraw->Draw("Nirvana", $nirvana);
            }
            
            $result["Metallica"]=array('anger'=>0,'anticipation'=>0,'disgust'=>0,'fear'=>0,'joy'=>0,'negative'=>0,'positive'=>0,'sadness'=>0,'surprise'=>0,'trust'=>0);
            $result["Nirvana"]=array('anger'=>0,'anticipation'=>0,'disgust'=>0,'fear'=>0,'joy'=>0,'negative'=>0,'positive'=>0,'sadness'=>0,'surprise'=>0,'trust'=>0);
            
            foreach ($metallica as $songName => $emotionArray) {
                foreach ($emotionArray as $emotion => $value) {
                    if($value > 0)
                        ++$result["Metallica"][$emotion];
                }
            }
            foreach ($nirvana as $songName => $emotionArray) {
                foreach ($emotionArray as $emotion => $value) {
                    if($value > 0)
                        ++$result["Nirvana"][$emotion];
                }
            }
            
            foreach ($result["Metallica"] as $emotion => $value) {
                $result["Metallica"][$emotion]= 100 * $result["Metallica"][$emotion] / count($metallica)."%";
            }
            
            foreach ($result["Nirvana"] as $emotion => $value) {
                $result["Nirvana"][$emotion] = 100 * $result["Nirvana"][$emotion] / count($nirvana)."%";
            }
            
            if($flag){
                $pdf->DrawFinalData($result);
                $pdf->Push();
            }else{
                $tableDraw->DrawFinalData($result);
            }
        ?>
    </body>
</html>
