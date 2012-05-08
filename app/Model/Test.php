<?php

class Test extends AppModel
{

    /**
     * This variable attaches containable behaviour to the class.
     *
     * @var array
     */
    public $actsAs = array('Containable');

    /**
     * This class variable contains list of Validation rules.
     *
     * @var array
     */
    public $validate = array(
                        'candidate_id' => array(
                                           'rule'       => array('numeric'),
                                           'allowEmpty' => false,
                                           'message'    => 'Candidate must be selected.',
                                          ),
                        'subject_id'   => array(
                                           'rule'       => array('numeric'),
                                           'allowEmpty' => false,
                                           'message'    => 'Subject must be selected.',
                                          ),
                        'code'         => array('rule' => array('notempty')),
                       );


    /**
     * This class variable contains list of model's belongsTo associations.
     *
     * @var array
     */
    public $belongsTo = array(
                         'Candidate',
                         'Subject',
                        );


    /**
     * This class variable contains list of model's hasMany associations.
     *
     * @var array
     */
    public $hasMany = array('TestQuestion' => array('dependent' => true));


    /**
     * This method is used to generate unique random string to be used as code.
     *
     * @param type $length lenght of the random string
     *
     * @return string
     */
    private function __randomAlphaNum($length)
    {
        $alphNums  = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $newString = str_shuffle(str_repeat($alphNums, rand(1, $length)));

        return substr($newString, rand(0,strlen($newString)-$length), $length);
    }//end __randomAlphaNum()


    /**
     * This method is used for modifying test data.
     *
     * @param array $formData  form data submitted by user
     * @param array $questions list of random questions
     *
     * @return array
     */
    public function modifyTestData($formData, $questions)
    {
        // For each question adjusts data for saving.
        foreach ($questions as $que) {
            $formData['TestQuestion'][] = array(
                                           'title'    => $que['Question']['title'],
                                           'option_1' => $que['Question']['option_1'],
                                           'option_2' => $que['Question']['option_2'],
                                           'option_3' => $que['Question']['option_3'],
                                           'option_4' => $que['Question']['option_4'],
                                           'answer'   => $que['Question']['answer'],
                                           'subject'  => $que['Subject']['name'],
                                          );
        }

        // Adds unique code to data.
        $formData['Test']['code'] = $this->__randomAlphaNum(4);
        return $formData;
    }//end modifyTestData()


    /**
     * This method is used to get total score and total questions count of the test.
     *
     * @param integer $testId test id
     *
     * @return array
     */
    public function getTestScore($testId)
    {
        // Count total questions
        $totalQuestions = $this->TestQuestion->find(
            'count',
            array('conditions' => array('TestQuestion.test_id' => $testId))
        );
        // Count total correct answers
        $scoreConditions = array(
                            0                      => 'TestQuestion.answer = TestQuestion.selected_option',
                            'TestQuestion.test_id' => $testId,
                           );
        $totalScore      = $this->TestQuestion->find(
            'count',
            array('conditions' => $scoreConditions)
        );

        // Return the score
        return compact('totalScore', 'totalQuestions');
    }//end getTestScore()


}//end class
