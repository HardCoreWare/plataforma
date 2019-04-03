<?php

class reporte extends Controller{

    public function mensual($params){

        //modelo de ciclo de donde obtenemos datosm principales
        $cicleModel = new CicleModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cicle=$cicleModel->getLast();
        $modules=$cicle['Modules'];
        $cicleModel->detachMySql();

        $paramArray=explode("-",$params);
        $year=$paramArray[0];
        $month=$paramArray[1];

        //modelo de guardado habilitado
        $storeModel=new StoreModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $report = $storeModel->tableMonth($modules,$year,$month);
        $storeModel->detachMySql();
        $storeModel=null;

        echo(json_encode($report));

    }

    public function modular($params){

        //modelo de ciclo de donde obtenemos datosm principales
        $cicleModel = new CicleModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cicle=$cicleModel->getLast();
        $modules=$cicle['Modules'];
        $cicleModel->detachMySql();

        $paramArray=explode("-",$params);
        $year=$paramArray[0];
        $module=$paramArray[1];

        //modelo de guardado habilitado
        $storeModel=new StoreModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $report = $storeModel->tableModule($cicle,$year,$module);
        $storeModel->detachMySql();
        $storeModel=null;

        echo(json_encode($report));

    }

    public function modular_acumulado($params){

        //modelo de ciclo de donde obtenemos datosm principales
        $cicleModel = new CicleModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cicle=$cicleModel->getLast();
        $modules=$cicle['Modules'];
        $cicleModel->detachMySql();

        $paramArray=explode("-",$params);
        $year=$paramArray[0];
        $module=$paramArray[1];

        //modelo de guardado habilitado
        $storeModel=new StoreModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $report = $storeModel->tableModuleAccumulated($cicle,$module);
        $storeModel->detachMySql();
        $storeModel=null;

        echo(json_encode($report));

    }

    public function acumulado($params){

        //modelo de ciclo de donde obtenemos datosm principales
        $cicleModel = new CicleModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $cicle=$cicleModel->getLast();
        $modules=$cicle['Modules'];
        $cicleModel->detachMySql();

        //
        $paramArray=explode("-",$params);
        $year=$paramArray[0];
        $month=$paramArray[1];

        //modelo de guardado habilitado
        $storeModel=new StoreModel(new PdoCrud(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE));
        $report = $storeModel->tableMonthAccumulated($modules,$year,$month);
        $storeModel->detachMySql();
        $storeModel=null;

        echo(json_encode($report));

    }

}

?>