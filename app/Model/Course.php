<?php
class Course extends AppModel {

	public $validate = array(
						'name' => array(
									'rule'       => array('notempty'),
									'message'    => 'The course name must not be empty',
									'allowEmpty' => false,
									'required'   => true,
								  ),
						'board_id' => array(
								        'rule'       => 'notempty',
										'message'    => 'Please select any board',
										'allowEmpty' => false,
										'required'   => true,
								      )
					   );

	public $belongsTo = array('Board');

	public $hasMany = array('Subject');

}//end Course()
