<?php

class SummaryModel extends MySqlConnection implements MySqlIndexInterface{

    //inyectamos dependencia de lib desde el constructor
    public function __construct($mySql){

        $this->attachMySql($mySql);

    }

        //chacamos si la tabla tiene datos
    public function check(){

        //contamos todas las filas
        $count=intval($this->mySql->selectCount("Resumen","Id"," 1 "));

        //en caso de haber 1 fila o mas retornamos true 
        if($count){

            return true;

        }

        //en caso contrario retornamos false
        else{

            return false;

        }

    }

    public function index(){

        $summary=$this->mySql->select("Resumen",["Id,Cuenta,Super_Concepto,Concepto","Concepto","Pagado","Monto","Mes","Anualidad","Modulo"]," 1 ","Id");

        return $summary;

    }

    //obtenemos tabla con modulos presentes
    public function table($modules){

        //obtener ids presentes en tabla
        $ids=$this->mySql->selectDistinct("Resumen","Id"," 1 ","Id");

        //creamos resumen en blanco
        $summary=[];

        //iteramos por cada id
        foreach ($ids as $id) {

            $line=$this->mySql->selectRow("Resumen",["Id","Cuenta","Super_Concepto","Concepto","Pagado","Mes"],"Id ='".$id."'","Id");
        
            $line["Montos"]=[];
            
            //creamos total llevado a0
            $total=0;
            //iteramos por cada modulo agregando los montos
            for ($i=0; $i<count($modules);$i++) {

                //modulo
                $module=$modules[$i];

                //monto
                $ammount=$this->mySql->selectRow("Resumen",["Monto","Modulo"],"Id = '".$id."' AND Modulo= '".$module."'","Id");
                $line["Montos"][]=$ammount;

                //total
                $total+=floatval($ammount["Monto"]);

                //llegando al final agregamos el total en el segundo nivel
                if($i==4){

                    $totalModule=["Modulo"=>"Total","Monto"=>$total];
                    $line["Montos"][]=$totalModule;

                }

            }

            //agregamos linea al resumen
            $summary[]=$line;

        }

        for ($i=0; $i <count($summary); $i++) { 

            $summary[$i]['Id']=intval($summary[$i]['Id']);
            $summary[$i]['Pagado']=intval($summary[$i]['Pagado']);
            $summary[$i]['Editable']=intval($summary[$i]['Editable']);

        }

        //retornamos resumen
        return $summary;

    }

    //
    public function write($data){

        $this->mySql->insertBlock("Resumen",$data);

    }

    //
    public function truncate(){

        $this->mySql->truncate("Resumen");

    }

}

?>