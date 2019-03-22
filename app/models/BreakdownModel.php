<?php

class BreakdownModel extends MySqlConnection implements MySqlTruncateInterface,MySqlWriteInterface{

    //
    public function __construct($mySql){

        $this->attachMySql($mySql);

    }

    //
    public function write($data){

        $this->mySql->insertBlock("Desglose",$data);

    }

    //
    public function search($id,$year,$month,$day){

        $this->mySql->select("Desglose",["Monto","Descripcion","Dia"]," 1 "," Dia ","assoc");

    }

    //
    public function truncate(){

        $this->mySql->truncate("Desglose");

    }


}

?>