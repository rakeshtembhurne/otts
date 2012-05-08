<?php
/* Candidates Test cases generated on: 2011-12-30 15:37:13 : 1325239633*/
App::uses('Candidates', 'Controller');

/**
 * TestCandidates *
 */
class TestCandidates extends Candidates {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * Candidates Test Case
 *
 */
class CandidatesTestCase extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Candidates = new TestCandidates();
		$this->->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Candidates);

		parent::tearDown();
	}

}
