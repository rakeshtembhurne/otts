<?php
/* Candidate Test cases generated on: 2011-12-30 15:17:12 : 1325238432*/
App::uses('Candidate', 'Model');

/**
 * Candidate Test Case
 *
 */
class CandidateTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.candidate', 'app.test');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Candidate = ClassRegistry::init('Candidate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Candidate);

		parent::tearDown();
	}

}
