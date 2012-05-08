<?php

class Candidate extends AppModel
{

    /**
     * This class variable is used to list validation rules.
     *
     * @var array
     */
    public $validate = array(
                        'name'              => array('rule' => array('notEmpty')),
                        'email'             => array(
                                                'rule'    => array('email'),
                                                'message' => 'This field must be a valid email',
                                               ),
                        'experience_months' => array('rule' => array('notEmpty')),
                        'experience_years'  => array('rule' => array('notEmpty')),
                       );

    /**
     * This class variable is used to list model's hasMany associations.
     *
     * @var array
     */
    public $hasMany = array('Test' => array('dependent' => true));

}//end class
