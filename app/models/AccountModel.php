<?php

class Accounts extends MySqlConnection implements MySqlUpdateInterface,MySqlIndexInterface{

    //inyectamos dependencia de lib desde el constructor
    public function __construct($mySql){

        $this->attachMySql($mySql);

    }

    //obtenemos todas las cuentas
    public function index(){

        $accounts = $this->mySql->select("Cuentas",["Id","Cuenta","Editable","Pagado","Super_Concepto","Concepto","Filtro"]," 1 ","Id","assoc");

        for ($i=0; $i <count($accounts); $i++) { 

            

        }
        

        return $accounts;

    }

    //function para cambiar si una cuenta es editable o no
    public function update($postData){

        foreach ($postData as $data) {

            $dml = "UPDATE Cuentas SET Editable = ".$data['value']." WHERE Id = ".$data['id'].";";
            $this->mySql->query($dml);

        }

    }

}


?>