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

        $breakdown = $this->mySql->select("Desglose",["Monto","Descripcion","Dia"],"Id = '".$id."', AND = '".$year."'"," Dia ","assoc");

    }

    //
    public function truncate(){

        $this->mySql->truncate("Desglose");

    }


}

?>