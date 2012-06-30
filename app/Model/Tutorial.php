<?php

class Tutorial extends AppModel
{

    /**
     * This variable contains list of validation rules.
     *
     * @var array
     */
    public $validate = array(
                        'subject_id' => array('rule' => array('notempty')),
                        'title'      => array('rule' => array('notempty')),
                       );

    /**
     * This variable contains list of this models's belongsTo associations.
     *
     * @var array
     */
    public $belongsTo = array('Subject');

    public $hasMany = array('Image');



    function beforeSave() {      
        return true;
    }
}//end class
