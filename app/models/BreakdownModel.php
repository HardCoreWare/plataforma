<?php

class BreakdowntModel extends MySqlConnection{

    public function __construct($mySql){

        $this->attachMySql($mySql);

    }

    public function write($data){

        $this->mySql->insertBlock("Desglose",$data);

    }

    public function truncate(){

        $this->mySql->truncate("Desglose");

    }


}

?>