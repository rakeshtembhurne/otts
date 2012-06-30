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
                        
                       );

    /**
     * This variable contains list of this models's belongsTo associations.
     *
     * @var array
     */
    public $belongsTo = array('Subject');

    public $hasMany = array('Image');

    function beforeValidate()
    {      
        //this code is used to validate topic if user do not select any topic     
        //this code is used to validate if answer option are empty        
        
        if ($this->data['Question']['answer']) {           
            $num = 0;
            foreach ($this->data['Question']['answer'] as $option) {       
                if (empty($option)) {
                    $num++;
                }      
            }
            if ($num == 4) {
                //if user not providing value at least in two option field then validate  
                $this->invalidate('answer', 'required');           
            }
            $answer = serialize($this->data['Question']['answer']);
            $this->data['Question']['answer'] = $answer; 
        }   
        return true;    
    }//end beforeValidate()

    function beforeSave() {
        //debug($this->data);
        //exit;
        return true;
    }
}//end class
