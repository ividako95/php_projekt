<?php
    class Database{
        private $db;
        
        function __construct() {
            try {
                $this->db = new PDO('mysql:host=localhost;dbname=words', 'root', '');
            } catch (PDOException $e) {
                echo 'Connection error: ' . $e->getMessage();
            }
        }
        
        public function GetEmotionsFromWord($word) {
            $sql = $this->db->prepare('SELECT emotion
                                       FROM dictionary
                                       WHERE word = "' . $word . '" AND value = 1');
            $sql->setFetchMode(PDO::FETCH_NAMED);
            $sql->execute();
            return $sql;
        }
    }

?>