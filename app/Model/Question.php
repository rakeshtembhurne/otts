<?php

class Question extends AppModel
{

    /**
     * This variable contains list of validation rules.
     *
     * @var array
     */
    public $validate = array(
                        'subject_id' => array('rule' => array('notempty')),
                        'title'      => array('rule' => array('notempty')),
                        'option_1'   => array('rule' => array('notempty')),
                        'option_2'   => array('rule' => array('notempty')),
                        'option_3'   => array('rule' => array('notempty')),
                        'option_4'   => array('rule' => array('notempty')),
                        'answer'     => array(
                                         'rule'    => array('notempty'),
                                         'message' => 'An option must be selected.',
                                        ),
                       );

    /**
     * This variable contains list of this models's belongsTo associations.
     *
     * @var array
     */
    public $belongsTo = array('Subject');

}//end class
