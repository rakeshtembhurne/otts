<?php
class QuestionsController extends AppController
{


    /**
     * This action method is used to display paginated list of questions.
     *
     * @return void
     */
    public function index()
    {
        $this->Question->recursive = 0;
        $this->set('questions', $this->paginate());
    }//end index()


    /**
     * This action method is used to display details of the selected question.
     *
     * @param integer $id question id
     *
     * @return void
     */
    public function view($id = null)
    {
        $this->Question->id = $id;

        // If Question does not exists, throws an exception.
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }

        $this->set('question', $this->Question->read(null, $id));
    }//end view()


    /**
     * This action method is used to add new question.
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Question->create();
            if ($this->Question->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The question has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'));
            }
        }
        $subjects = $this->Question->Subject->find('list');
        $this->set(compact('subjects'));
    }//end add()


    /**
     * This action method is used to edit the selected question.
     *
     * @param integer $id question id
     *
     * @return void
     */
    public function edit($id = null)
    {
        $this->Question->id = $id;

        // If question does not exist, throws an exception.
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }

        // If form was submitted, saves the question.
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Question->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The question has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Question->read(null, $id);
        }

        $subjects = $this->Question->Subject->find('list');
        $this->set(compact('subjects'));
    }//end edit()


    /**
     * This action method is used to delete the selected question.
     *
     * @param integer $id question id
     *
     * @return void
     */
    public function delete($id = null)
    {
        // If this action method was not called by POST method, throws an exception.
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Question->id = $id;

        // If the question does not exists, throws an exception.
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }

        // Deletes the question.
        if ($this->Question->delete()) {
            $this->Session->setFlash(__('Question deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }

        // If the question was not deleted, sets flash message.
        $this->Session->setFlash(__('Question was not deleted'));
        $this->redirect(array('action' => 'index'));
    }//end delete()


}//end class
