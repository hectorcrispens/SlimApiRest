<?php

use models\RedBean_SimpleModel;

namespace App\Domain\Log{
class Model_Log extends RedBean_SimpleModel{
           
    public function dispense() {
        global $lifeCycle;
        $lifeCycle .= "called dispense() ".$this->bean;
    }
    }
}