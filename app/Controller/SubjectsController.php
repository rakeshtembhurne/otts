<?php
class SubjectsController extends AppController
{


    /**
     * This action method id used to display list of all subjects.
     *
     * @return void
     */
    public function admin_index()
    {
        $this->Subject->recursive = 0;
        $this->set('subjects', $this->paginate());
    }//end index()


    /**
     * This action method is used to display details of the subject
     *
     * @param integer $id subject id
     *
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->Subject->id = $id;

        // If subject does not exist, throws an exception.
        if (!$this->Subject->exists()) {
            throw new NotFoundException(__('Invalid subject'));
        }

        $this->set('subject', $this->Subject->read(null, $id));
    }//end admin_view()


    /**
     * This action method is used to add new subject.
     *
     * @return void
     */
    public function admin_add($courseId = null)
    {
        // Adds subject only if form is submitted.
        if ($this->request->is('post')) {
            $this->Subject->create();

            // Saves subject.
            if ($this->Subject->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The subject has been saved'),  'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The subject could not be saved. Please, try again.'), 'error');
            }
        }    

        
       
    }//end add()


    /**
     * This action method is used to edit the subject.
     *
     * @param integer $id subject id
     *
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Subject->id = $id;

        // If subject does not exist, throws an exception.
        if (!$this->Subject->exists()) {
            throw new NotFoundException(__('Invalid subject'));
        }

        // If form is submitted saves the post.
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Subject->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The subject has been saved'),
                    'success'
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The subject could not be saved. Please, try again.'),'error');
            }
        } else {
            $this->request->data = $this->Subject->read(null, $id);
        }
        
    }//end edit()


    /**
     * delete method
     *
     * @param integer $id subject id
     *
     * @return void
     */
    public function admin_delete($id = null)
    {
        // If this action method was not called with POST method, throws an exception.
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        // If Subject does not exist, throws an exception.
        $this->Subject->id = $id;
        if (!$this->Subject->exists()) {
            throw new NotFoundException(__('Invalid subject'));
        }

        // Deletes the subject.
        if ($this->Subject->delete()) {
            $this->Session->setFlash(__('Subject deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }

        // If subject was not deleted, sets error message and redirects.
        $this->Session->setFlash(__('Subject was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }//end delete()


}//end class
