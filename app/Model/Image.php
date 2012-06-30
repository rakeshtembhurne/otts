<?php
class Image extends AppModel {

	public $belongsTo = array(
						 'Question', 
						 'Tutorial',
						);

	//public $validate  = array('filename' => array('rule' => array('notempty')));

	public function beforeSave() {
		//debug($this->data);
		//exit;
		return true;
	}
}