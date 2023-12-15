<?php

class Database
{
    private $hst = "localhost",
            $usr = "root",
            $pwd = "",
            $dbe = "marketplace";
    public  $conn;

    public function __construct(){
        $this->conn = mysqli_connect($this->hst,$this->usr,$this->pwd,$this->dbe);
    }
}

?>