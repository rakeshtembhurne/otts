<?php
class TestQuestionsController extends AppController
{


    /**
     * This method is used to display paginated list of test questions.
     *
     * @return void
     */
    public function index()
    {
        $this->TestQuestion->recursive = 0;
        $this->set('testQuestions', $this->paginate());
    }//end index()


    /**
     * This action method is used to display details of selected test question.
     *
     * @param integer $id test question id
     *
     * @return void
     */
    public function view($id = null)
    {
        $this->TestQuestion->id = $id;
        if (!$this->TestQuestion->exists()) {
            throw new NotFoundException(__('Invalid test question'));
        }
        $this->set('testQuestion', $this->TestQuestion->read(null, $id));
    }//end view()


    /**
     * This action method is used to add new test question.
     *
     * @return void
     */
    public function add()
    {
        // If the form is submitted, proceeds to save.
        if ($this->request->is('post')) {
            $this->TestQuestion->create();

            // Saves the test question.
            if ($this->TestQuestion->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The test question has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The test question could not be saved. Please, try again.'));
            }
        }
        $tests = $this->TestQuestion->Test->find('list');
        $this->set(compact('tests'));
    }//end add()


    /**
     * This action method is used to edit the selected test question.
     *
     * @param integer $id test question id
     *
     * @return void
     */
    public function edit($id = null)
    {
        $this->TestQuestion->id = $id;

        // If the test question does not exist, throws an exception.
        if (!$this->TestQuestion->exists()) {
            throw new NotFoundException(__('Invalid test question'));
        }

        // If the form was submitted, saves the form.
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->TestQuestion->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The test question has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The test question could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->TestQuestion->read(null, $id);
        }
        $tests = $this->TestQuestion->Test->find('list');
        $this->set(compact('tests'));
    }//end edit()


    /**
     * This action method is used to delete selected test question.
     *
     * @param integer $id test question id
     *
     * @return void
     */
    public function delete($id = null)
    {
        // If this action method was not called with POST method, throws an exception.
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        // If the test question does not exist, throws an exception.
        $this->TestQuestion->id = $id;
        if (!$this->TestQuestion->exists()) {
            throw new NotFoundException(__('Invalid test question'));
        }

        // Deletes the test question.
        if ($this->TestQuestion->delete()) {
            $this->Session->setFlash(__('Test question deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }

        // If the test question was not deleted, sets flash message and redirects.
        $this->Session->setFlash(__('Test question was not deleted'));
        $this->redirect(array('action' => 'index'));
    }//end delete()


}//end class
