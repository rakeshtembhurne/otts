<?php

class ImagesController extends AppController {


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Image->Behaviors->attach(
				'ImageUpload',
				array(
					'fileField' => 'filename',					
					'dirFormat' => 'images'
				)
			);
			debug($this->request->data);exit;
			$this->Image->create();
			if ($this->Image->save($this->request->data)) {
				$this->Session->setFlash(__('The board has been saved'),'success');
				$this->redirect(array('action' => 'add'));
			} else {
				debug($this->Image->validationErrors);
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

}
