<?php

class AccountFacade{

    //se deben implementar:
    //-index
    //-conectar y desconectar
    public function getAccounts(MySqlIndexInterface $accountModel){

        //tomamos cuentas y desacoplamos
        $accounts = $accountModel->index();
        $accountModel->detachMySql();

        return $accounts;

    }

    //se deben implementar:
    //-update
    //-conectar y desconectar
    public function updateAccounts(MySqlUpdateInterface $accountModel,$post){

        //si esta bien estructurado el metodo
        if(isset($post)){

            //decodificamos post como array asociativo
            $postData=json_decode($post,true);

            $accountModel->update($postData);
            $accountModel->detachMySql();
    
        }

    }

}

?>