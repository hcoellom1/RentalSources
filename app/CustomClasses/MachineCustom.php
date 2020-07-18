<?php

class MachineCustom{


    private $machineDescription;

    private $phoneOwner;

    private $mailOwner;

    public function __construct($machineDescription, $phoneOwner, $mailOwner){
        $this->machineDescription = $machineDescription;
        $this->phoneOwner = $phoneOwner;
        $this->mailOwner = $mailOwner;
    }

    public function getMachineDescription(){
        return $this->machineDescription;
    }

    public function getPhoneOwner(){
        return $this->phoneOwner;
    }

    public function getMailOwner(){
        return $this->mailOwner;
    }

}