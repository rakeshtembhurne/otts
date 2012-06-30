<?php
App::uses('AppController', 'Controller');
/**
 * Boards Controller
 *
 * @property Board $Board
 */
class BoardsController extends AppController {

	public $uses = array('Board', 'User');


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Board->recursive = 0;
		$this->set('boards', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Board->id = $id;
		if (!$this->Board->exists()) {
			throw new NotFoundException(__('Invalid board'));
		}
		$this->set('board', $this->Board->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Board->create();
			if ($this->Board->save($this->request->data)) {
				$this->Session->setFlash(__('The board has been saved'),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board could not be saved. Please, try again.'), 'error');
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Board->id = $id;
		if (!$this->Board->exists()) {
			throw new NotFoundException(__('Invalid board'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Board->save($this->request->data)) {
				$this->Session->setFlash(__('The board has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Board->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Board->id = $id;
		if (!$this->Board->exists()) {
			throw new NotFoundException(__('Invalid board'));
		}
		if ($this->Board->delete()) {
			$this->Session->setFlash(__('Board deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Board was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->Board->recursive = 0;		
		$this->set('boards', $this->paginate());
	}


/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {		
		if ($this->request->is('post')) {
			$this->Board->create();
			if ($this->Board->save($this->request->data)) {
				$this->Session->setFlash(__('The board has been saved'),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board could not be saved. Please, try again.'), 'error');
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Board->id = $id;
		if (!$this->Board->exists()) {
			throw new NotFoundException(__('Invalid board'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Board->save($this->request->data)) {
				$this->Session->setFlash(__('The board has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Board->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Board->id = $id;
		if (!$this->Board->exists()) {
			throw new NotFoundException(__('Invalid board'));
		}
		if ($this->Board->delete()) {
			$this->Session->setFlash(__('Board deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Board was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function student_index() {
		//$this->Board->recursive = 0;
		$this->User->bindModel(array('hasAndBelongsToMany' => array('Subject')));
		$option = array(
			'conditions' => array(
				'User.id' => $this->Auth->user('id')
			),
			'contain' => array('Subject' => array('Course' => 'Board'))
		);
		$boards = $this->User->find('first', $option);		
        $this->set(compact('boards'));        
	}

}//end class
