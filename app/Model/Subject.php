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
      'course_id' => array('rule' => array('notempty'))
      );
    
    
     /**
     * This class variable contains list of this model's belongsTo associations.
     *
     * @var array
     */
    public $belongsTo = array(                     
                       'Course',
                      );

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
