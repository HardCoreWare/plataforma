<?php

class desglose extends Controller{

    public function importar(){

        //modelo de ciclo de donde obtenemos datosm principales
        $cicleModel = new CicleModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cicle=$cicleModel->getLast();
        $year=$cicle['Anualidad'];
        $month=$cicle['Mes'];
        $modules=$cicle['Modules'];
        $cicleModel->detachMySql();

        //obtenemos cuentas del model de cuentas
        $accountModel=new AccountModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $accounts=$accountModel->index();
        $accountModel->detachMySql();
        $accountModel=null;

        $report=[];

        //iteramos por cada unidad de negocio
        for ($i=0; $i < count($modules); $i++) { 



        }

        //obtenemos cecos por modulo
        $cecosModel = new cecosModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cecos=[];
        $cecos[0] = $cecosModel->cecosString('BANCO');
        $cecosModel->detachMySql();
        $cecosModel=null;

        //actualizamos reporte en base a consultas de bigquery
        $importModel = new ImportBreakdownModel(new BigQuery('informe-211921'));
        $report[0]=$importModel->import($accounts,$cecos[0],$year,$month,'BANCO');

        $importModel->detachBigQuery();
        $importModel=null;

        echo(json_encode($report[0]));

    }

}


?>