<?php
class Topic extends AppModel {

	public $validate = array(
						'name' => array(
									'rule'       => array('notempty'),
									'message'    => 'The topic name must not be empty',
									'allowEmpty' => false,
									'required'   => true,
								  ),
						'subject_id' => array(
								        'rule'       => 'notempty',
										'message'    => 'Please select any subject',
										'allowEmpty' => false,
										'required'   => true,
								      )
					   );

	public $belongsTo = array('Subject');

	/**
     * This class variable contains list of this model's hasMany associations.
     *
     * @var array
     */
    public $hasMany = array(
                       //0          => 'Test',
                       'Question' => array('dependent' => true),
                      );


}//end Topic()
