<?php

class resumen extends Controller{

    public function indice(){

        //
        $cicleModel = new CicleModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cicle=$cicleModel->getLast();
        $cicleModel->detachMySql();
        $cicleModel=null;

        //
        $modules=$cicle['Modules'];
        $summaryModel = new SummaryModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        
        //
        if($summaryModel->check()){

            $summary = $summaryModel->table($modules);
            $summaryModel->detachMySql();
            $summaryModel = null;
            echo(json_encode($summary));
            
        }

        //
        else {

            $summaryModel->detachMySql();
            $summaryModel = null;
            echo("empty");
            
        }

    }

}


?>