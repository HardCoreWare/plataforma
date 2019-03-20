<?php

class GenerateFacade{

    private $accounts;
    private $report;

    // leemo cuentas y las guardamos
    public function readAccounts(MySqlIndexInterface $accountModel){

        //
        $this->accounts = $accountModel->index();
        $accountModel->detachMySql();
        $accountModel=null;

    }

    //escribimos nuevo reporte y anulamos todo
    public function writeReport(MySqlWriteInterface $reportModel){

        //
        $reportModel->write($this->report);
        $reportModel->detachMySql();
        $reportModel=null;
        $this->report=null;

    }
    
}

?>