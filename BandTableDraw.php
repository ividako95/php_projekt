<?php
    class BandTableDraw{
        public function Draw($bandName, $songsData){
            $this->OpenTable($bandName);
            foreach ($songsData as $key => $value) {
                $this->WriteSongData($key, $value);
            }
            $this->CloseTable();
        }
        
        private function OpenTable($bandName){
            echo "<div style=\"text-align: center;\">
                    <h3>{$bandName}</h3>
                        <table border=\"1\" cellpadding=\"2\" cellspacing=\"2\"
                        style=\"width:60%; margin-left: auto; margin-right: auto;\">
                        <tr>
                            <th>Name</th>
                            <th>Emotion</th>
                            <th>Times repeated</th>
                        </tr>";
        }
        
        private function WriteSongData($songName, $data){
            echo "<tr>
                    <td rowspan=\"10\">{$songName}</td>";
                    $total = 0;
                    foreach ($data as $key => $value) {
                        if($key != "positive" && $key != "negative")
                            echo "<tr><td>{$key}</td><td>{$value}</td></tr>";
                        else
                            $total += ($key == "positive")? $value : -$value;
                    }
                    echo "<tr><td>Total</td><td>". $this->Polarity($total)." ({$total})" ."</td></tr></tr>";
        }
        
        private function Polarity($int){
            if($int < 0)
                return "negative";
            if($int > 0)
                return "positive";
            return "neutral";
        }
        
        private function CloseTable(){
            echo "</table>";
            echo "</div>";
        }
        
        public function DrawFinalData($bandData){
            echo "<div style=\"text-align: center;\">
                <h3>Final result</h3>
                        <table border=\"1\" style=\"width:60%; margin-left: auto; margin-right: auto;\">
                        <tr>
                            <th>Band</th>
                            <th>Emotion</th>
                            <th>Percentage</th>
                        </tr>";
            foreach ($bandData as $key => $value) {
                echo "<tr>
                    <td rowspan=\"9\">{$key}</td>";
                foreach ($value as $emotion => $percentage) {
                    if($emotion != "positive" && $emotion != "negative")
                        echo "<tr><td>{$emotion}</td><td>{$percentage}</td></tr>";
                }
                echo "</tr>";
            }
            echo "</table></div>";
        }
    }


