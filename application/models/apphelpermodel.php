<?php
class Apphelpermodel extends CI_Model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function sortarray($array,$colnum,$order){
        echo var_dump($array);
        array_multisort($array,$colnum);
        echo var_dump($array);
    }
}
