<?php
class CandidatesController extends AppController
{


    /**
     * This action method is used to display paginated list of candidates.
     *
     * @return void
     */
    public function index()
    {
        $this->Candidate->recursive = 0;
        $this->set('candidates', $this->paginate());
    }//end index()


    /**
     * This action method is used to display details of selected candidates.
     *
     * @param integer $id candidate id
     *
     * @return void
     */
    public function view($id = null)
    {
        $this->Candidate->id = $id;

        // If the candidate does not exist, throws an exception.
        if (!$this->Candidate->exists()) {
            throw new NotFoundException(__('Invalid candidate'));
        }
        $this->set('candidate', $this->Candidate->read(null, $id));
    }//end view()


    /**
     * This action method is used to add a new candidate.
     *
     * @return void
     */
    public function add()
    {
        // If form was submitted, proceed to save the submitted data.
        if ($this->request->is('post')) {
            $this->Candidate->create();

            // Saves data submitted with form.
            if ($this->Candidate->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The candidate has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The candidate could not be saved. Please, try again.'));
            }
        }
    }//end add()


    /**
     * This action method is used to edit details of selected candiate.
     *
     * @param integer $id candidate id
     *
     * @return void
     */
    public function edit($id = null)
    {
        $this->Candidate->id = $id;

        // If the candidate does not exist, throws an exception.
        if (!$this->Candidate->exists()) {
            throw new NotFoundException(__('Invalid candidate'));
        }

        // If form was submitted, proceeds to save the submitted data.
        if ($this->request->is('post') || $this->request->is('put')) {

            // Saves the submitted data.
            if ($this->Candidate->save($this->request->data)) {
                $this->Session->setFlash(
                    __('The candidate has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The candidate could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Candidate->read(null, $id);
        }
    }//end edit()


    /**
     * This action method is used to delete the selected candidate.
     *
     * @param intger $id candidate id
     *
     * @return void
     */
    public function delete($id = null)
    {
        // If this action method was not called with POST method, throws an exception.
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        // If the candidate does not exists, throws an exception.
        $this->Candidate->id = $id;
        if (!$this->Candidate->exists()) {
            throw new NotFoundException(__('Invalid candidate'));
        }

        // Deletes the candidate.
        if ($this->Candidate->delete()) {
            $this->Session->setFlash(__('Candidate deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }

        // If the candidate was not deleted, sets flash message and redirects.
        $this->Session->setFlash(__('Candidate was not deleted'));
        $this->redirect(array('action' => 'index'));
    }//end delete()


}//end class
