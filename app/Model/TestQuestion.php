<?php

class TestQuestion extends AppModel
{

    /**
     * This class variable is used to list Model's belongsTo associations.
     *
     * @var array
     */
    public $belongsTo = array('Test');

    public $hasAndBelongsToMany = array('Question');

}//end class
