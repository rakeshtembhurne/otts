<?php
/* Question Test cases generated on: 2011-12-30 15:23:38 : 1325238818*/
App::uses('Question', 'Model');

/**
 * Question Test Case
 *
 */
class QuestionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.question', 'app.subject');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Question = ClassRegistry::init('Question');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Question);

		parent::tearDown();
	}

}
