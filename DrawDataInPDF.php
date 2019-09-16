<?php
    class DrawDataInPDF{
        private $pdf;
        function __construct() {
            ob_start();
            require('fpdf.php');
            $this->pdf = new FPDF();
            $this->pdf->addPage();
            $this->pdf->setFont("Arial", 'B', 14);
        }
        
        public function DrawTable($bandName, $data) {
            $this->pdf->Ln();
            $this->pdf->Cell(60,5,$bandName, 'LTR',0,'L',0);
            $this->pdf->Cell(60,5,'Emotion',1,0,'L',0);
            $this->pdf->Cell(60,5,'Value',1,0,'L',0);
            $this->pdf->Ln();
            foreach ($data as $songName => $emotions) {
                $total = 0;
                $i = count($emotions)-2;
                foreach ($emotions as $emotion => $value) {
                    if($emotion != "positive" && $emotion != "negative"){
                        $this->pdf->Cell(60,5,($i == (count($emotions)-2)/2)?$songName:' ', ($i == count($emotions)-2)?'LTR':'LR',0,'L',0);
                        $this->pdf->Cell(60,5,$emotion,1,0,'L',0);
                        $this->pdf->Cell(60,5,$value,1,0,'L',0);
                        $this->pdf->Ln();
                        --$i;
                    }
                    else
                        $total += ($emotion == "positive")? $value : -$value;
                }
                $this->pdf->Cell(60,5,' ', 'LBR',0,'L',0);
                $this->pdf->Cell(60,5,'Total',1,0,'L',0);
                $this->pdf->Cell(60,5,$this->Polarity($total)."({$total})",1,0,'L',0);
                $this->pdf->Ln();
            }
        }
        
        private function Polarity($int){
            if($int < 0)
                return "negative";
            if($int > 0)
                return "positive";
            return "neutral";
        }
        
        public function DrawFinalData($bandData){
            $this->pdf->Ln();
            $this->pdf->Cell(60,5,'Band name',1,0,'L',0);
            $this->pdf->Cell(60,5,'Emotion',1,0,'L',0);
            $this->pdf->Cell(60,5,'Value',1,0,'L',0);
            $this->pdf->Ln();
            
            foreach ($bandData as $bandName => $emotions) {
                $i = count($emotions)-2;
                foreach ($emotions as $emotion => $value) {
                    if($emotion != "positive" && $emotion != "negative"){
                        $this->pdf->Cell(60,5,($i == (count($emotions)-2)/2)?$bandName:' ', $this->Border(--$i, count($emotions)-2),0,'L',0);
                        $this->pdf->Cell(60,5,$emotion,1,0,'L',0);
                        $this->pdf->Cell(60,5,$value,1,0,'L',0);
                        $this->pdf->Ln();
                    }
                }
            }
        }
        
        private function Border($i, $count) {
            if($i==$count)
                return 'LTR';
            if($i==0)
                return 'LBR';
            return 'LR';
        }
        
        public function Push() {
            $this->pdf->output();
            ob_end_flush();
        }
    }


