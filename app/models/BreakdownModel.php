<?php

class BreakdownModel extends MySqlConnection{

    //
    public function __construct($mySql){

        $this->attachMySql($mySql);

    }

    //
    public function write($data){

        $this->mySql->insertBlock("Desglose",$data);

    }

    //
    public function index(){

        $this->mySql->select("Desglose",["Importe","Descripcion"]);

    }

    //
    public function search($id,$year,$month,$day){

        

    }

    //
    public function truncate(){

        $this->mySql->truncate("Desglose");

    }


}

?>