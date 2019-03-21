<?php

class BreakdowntModel extends MySqlConnection{

    public function write($data){

        $this->mySql->insertBlock("Desglose",$data);

    }


}

?>