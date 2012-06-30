<?php
class Board extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array('name' => array('rule' => array('notempty')));


		public $hasMany = array('Course');
}