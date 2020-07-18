<?php

namespace App\CustomClasses;

class ClientRequest{


/**
* Property for request date
*/
private $requestDate;

/**
 * Property for proyect location
 */
private $requestLocation;

/**
 * Property for client name
 */
private $name;

/**
 * Property for address request
 */
private $direccionProyecto;


/**
 * Property for client phone
 */
private $phone;

/**
 * Propertu for mail phone
 */
private $email;

    public function __construct($date, $requestLocation, $name, $direccionProyecto, $phone, $email){    
        $this->requestDate = $date;
        $this->requestLocation = $requestLocation;
        $this->name = $name;
        $this->direccionProyecto = $direccionProyecto;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * Getter for request date property
     */
    public function getrequestDatae(){
        return $this->requestDate;
    }

    /**
     * Getter for location request property
     */
    public function getrequestLocation(){
        return $this->requestLocation;
    }

    /**
     * Getter for name property
     */
    public function getname(){
        return $this->name;
    }

    /**
     * Getter for address request
     */
    public function getDireccion(){
        return $this->direccionProyecto;
    }

    /**
     * Getter for client phone
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * Getter form client email
     */
    public function getEmail(){
        return $this->email;
    }

}

