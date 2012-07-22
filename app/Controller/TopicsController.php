<?php
App::uses('AppController', 'Controller');
/**
 * Topics Controller
 *
 * @property Topic $Topic
 */
class TopicsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Topic->recursive = 0;
		$this->set('topics', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid topic'));
		}
		$this->set('topic', $this->Topic->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Topic->create();
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(__('The topic has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The topic could not be saved. Please, try again.'));
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
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid topic'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(__('The topic has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The topic could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Topic->read(null, $id);
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
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid topic'));
		}
		if ($this->Topic->delete()) {
			$this->Session->setFlash(__('Topic deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Topic was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Topic->recursive = 0;
		$this->set('topics', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid topic'));
		}
		$this->set('topic', $this->Topic->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			debug($this->request->data);
			$this->Topic->create();
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(__('The topic has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				debug($this->Topic->validationErrors);
				$this->Session->setFlash(__('The topic could not be saved. Please, try again.'), 'error');
			}
		}
		$this->set('subjects', $this->Topic->Subject->find('list'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid topic'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(__('The topic has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The topic could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Topic->read(null, $id);
		}
		$this->set('subjects', $this->Topic->Subject->find('list'));
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
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid topic'));
		}
		if ($this->Topic->delete()) {
			$this->Session->setFlash(__('Topic deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Topic was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
