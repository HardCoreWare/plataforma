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

        //obtenemos cecos por modulo
        $cecosModel = new cecosModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cecos=[];
        $cecos[0] = $cecosModel->cecosString('BANCO');
        $cecos[1] = $cecosModel->cecosString('OPERADORA');
        $cecos[2] = $cecosModel->cecosString('SERVICIOS');
        $cecos[3] = $cecosModel->cecosString('GRUPO');
        $cecos[4] = $cecosModel->cecosString('CASA');
        $cecosModel->detachMySql();
        $cecosModel=null;

        //actualizamos reporte en base a consultas de bigquery
        $importModel = new ImportModel(new BigQuery('informe-211921'));
        $report[0]=$importModel->import($accounts,$cecos[0],$year,$month,'BANCO');
        $report[1]=$importModel->import($accounts,$cecos[1],$year,$month,'OPERADORA');
        $report[2]=$importModel->import($accounts,$cecos[2],$year,$month,'SERVICIOS');
        $report[3]=$importModel->import($accounts,$cecos[3],$year,$month,'GRUPO');
        $report[4]=$importModel->import($accounts,$cecos[4],$year,$month,'CASA');
        $importModel->detachBigQuery();
        $importModel=null;

    }

}


?>