<?php
/* TestQuestion Test cases generated on: 2011-12-30 15:30:35 : 1325239235*/
App::uses('TestQuestion', 'Model');

/**
 * TestQuestion Test Case
 *
 */
class TestQuestionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.test_question', 'app.test');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->TestQuestion = ClassRegistry::init('TestQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TestQuestion);

		parent::tearDown();
	}

}
