<?php

class ResetFacade{

    private $accounts;

    public function readAccounts(MySqlIndexInterface $accountModel){

        $this->accounts = $accountModel->index();
        $customModel->detachMySql();

    }

    public function truncateReport(MySqlTruncateInterface $reportModel){

        $reportModel->truncate();
        $customModel->detachMySql();


    }

    public function overwriteCustom(MySqlOverwriteInterface $customModel,$cicleModel){

        $cicle=$cicleModel->getLast();
        $modules=$cicle['Modules'];
        $cicleModel->detachMySql();

        $customModel->truncate();
        $customModel->overwrite($this->accounts,$modules);
        $customModel->detachMySql();

        
    }
    
}

?>