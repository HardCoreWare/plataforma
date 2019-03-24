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

        if($day!=="all"){

            $breakdown = $this->mySql->select("Desglose",["Id","Monto","Descripcion","Dia","Modulo"],"Id = '".$id."' AND Anualidad = '".$year."' AND Mes = '".$month."' AND Dia = '".$day."'"," Id ","assoc");

        }


        return $breakdown;

    }

    //
    public function truncate(){

        $this->mySql->truncate("Desglose");

    }


}

?>