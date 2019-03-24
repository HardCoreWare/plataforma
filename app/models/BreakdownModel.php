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
    public function search($id,$year,$month,$day,$module){

        if($day!=="all"){

            $breakdown = $this->mySql->select("Desglose",["Id","Monto","Descripcion","Dia","Modulo","Ceco"],"Id = '".$id."' AND Anualidad = '".$year."' AND Mes = '".$month."' AND Modulo = '".$module."' AND Dia = '".$day."'"," Id ","assoc");

        }

        else{

            $breakdown = $this->mySql->select("Desglose",["Id","Monto","Descripcion","Dia","Modulo","Ceco"],"Id = '".$id."' AND Anualidad = '".$year."' AND Mes = '".$month."' AND Modulo = '".$module."'"," Id ","assoc");

        }


        return $breakdown;

    }

    //
    public function truncate(){

        $this->mySql->truncate("Desglose");

    }


}

?>