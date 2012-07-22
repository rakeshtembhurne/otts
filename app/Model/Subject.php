<?php

class Subject extends AppModel
{
//public $displayField = 'name';
    /**
     * This class variable contains array of validation rules.
     *
     * @var array
     */
    public $validate = array(
      'name' => array('rule' => array('notempty')),
      );
    
    
     public $hasMany = array('Topic','Test');
    
}//end class
