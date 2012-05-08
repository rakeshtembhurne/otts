<?php

class Subject extends AppModel
{

    /**
     * This class variable contains array of validation rules.
     *
     * @var array
     */
    public $validate = array('name' => array('rule' => array('notempty')));

    /**
     * This class variable contains list of this model's hasMany associations.
     *
     * @var array
     */
    public $hasMany = array(
                       0          => 'Test',
                       'Question' => array('dependent' => true),
                      );

}//end class
