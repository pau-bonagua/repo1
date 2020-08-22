<?php

class Validate
{
    public $result_data = [];
    public $unset_result;
    
    public function post($columns)
    {
        if(isset($_POST[$columns]))
        {
            $this->result_data[$columns] = $_POST[$columns];
        }
        else
        {
            $this->unset_result[] = $columns;
        }
    }

    public function session($columns)
    {
        
    }

    public function index_result($result)
    {

    }
}