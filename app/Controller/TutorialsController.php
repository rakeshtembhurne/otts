<?php
class TutorialsController extends AppController
{


    /**
     * This action method is used to display paginated list of tutorials.
     *
     * @return void
     */
    public function admin_index($subjectId = null)
    {
        $this->Tutorial->recursive = 0;
        if (!empty($subjectId)) {
            $this->paginate = array('conditions' => array('subject_id' => $subjectId));    
        }      

        $this->set('tutorials', $this->paginate());
        $this->set('subjects', $this->Tutorial->Subject->find('list'));
    }//end index()


    /**
     * This action method is used to display details of the selected tutorial.
     *
     * @param integer $id tutorial id
     *
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->Tutorial->id = $id;

        // If Tutorial does not exists, throws an exception.
        if (!$this->Tutorial->exists()) {
            throw new NotFoundException(__('Invalid tutorial'));
        }

        $this->set('tutorial', $this->Tutorial->read(null, $id));
    }//end admin_view()


    /**
     * This action method is used to add new tutorial.
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Tutorial->create();
            if ($this->Tutorial->save($this->request->data)) {
                $this->Session->setFlash(__('The tutorial has been saved'), 'success');
              //  $this->redirect(array('action' => 'edit', $this->Tutorial->id));
            } else {
                $this->Session->setFlash(__('The tutorial could not be saved. Please, try again.'), 'error');
            }
        }        

      
        $subjects = $this->Tutorial->Subject->find(
            'all',
            array(
                //'fields' => array('id', 'name'),
                'contain' => array(
                    'Course' => array(
                        'fields' => array('name'),
                        'Board' => array('fields' => array('name'))
                    )
                ),
                'group' => 'Course.name',                
            )
        );       
        $subjectList = array();
        foreach ($subjects as $subject){
            $subjectList[$subject['Course']['Board']['name'].' : '.$subject['Course']['name']] = array($subject['Subject']['id'] => $subject['Subject']['name']);
        }

        $subjects = $subjectList;      
        $this->set(compact('subjects'));
    }//end add()


    /**
     * This action method is used to edit the selected tutorial.
     *
     * @param integer $id tutorial id
     *
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Tutorial->id = $id;

        // If tutorial does not exist, throws an exception.
        if (!$this->Tutorial->exists()) {
            throw new NotFoundException(__('Invalid tutorial'));
        }

        if ($this->request->is('post') || $this->request->is('put')) { 
            if ($this->Tutorial->save($this->request->data)) {
                $this->Session->setFlash(__('The tutorial has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tutorial could not be saved. Please, try again.'), 'error');
            }
        } else {
            $this->request->data = $this->Tutorial->read(null, $id);            
        }

        $subjects = $this->Tutorial->Subject->find(
            'all',
            array(
                //'fields' => array('id', 'name'),
                'contain' => array(
                    'Course' => array(
                        'fields' => array('name'),
                        'Board' => array('fields' => array('name'))
                    )
                ),
                'group' => 'Course.name',                
            )
        );       
        $subjectList = array();
        foreach ($subjects as $subject){
            $subjectList[$subject['Course']['Board']['name'].' : '.$subject['Course']['name']] = array($subject['Subject']['id'] => $subject['Subject']['name']);
        }

        $subjects = $subjectList;
        $this->set(compact('subjects'));
    }//end edit()


    /**
     * This action method is used to delete the selected tutorial.
     *
     * @param integer $id tutorial id
     *
     * @return void
     */
    public function admin_delete($id = null)
    {
        // If this action method was not called by POST method, throws an exception.
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Tutorial->id = $id;

        // If the tutorial does not exists, throws an exception.
        if (!$this->Tutorial->exists()) {
            throw new NotFoundException(__('Invalid tutorial'));
        }

        // Deletes the tutorial.
        if ($this->Tutorial->delete()) {
            $this->Session->setFlash(__('Tutorial deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }

        // If the tutorial was not deleted, sets flash message.
        $this->Session->setFlash(__('Tutorial was not deleted'));
        $this->redirect(array('action' => 'index'));
    }//end delete()


    public function admin_edit_tutorial_image($id = null) {        
        $this->Tutorial->id = $id;
        // If the tutorial does not exists, throws an exception.
        if (!$this->Tutorial->exists()) {
            throw new NotFoundException(__('Invalid tutorial'));
        }
        //debug($this->request->data);exit;
        $this->Tutorial->Image->Behaviors->attach(
            'ImageUpload',
            array(
                'fileField' => 'filename',
                'dirFormat' => 'images'
            )
        );
        //debug($this->request->data);exit;
        if ($this->Tutorial->Image->save($this->request->data)) {
            $this->Session->setFlash(__('Image Saved'), 'success');
        } else {
            //debug($this->Tutorial->Image->validationErrors);            
            $this->Session->setFlash('Image could not be saved.', 'error');
        }
        $this->redirect($this->referer());
    }


     /**
     * This action method is used to display details of selected test.
     *
     * @param integer $id test id
     *
     * @return void
     */
     public function student_index($subjectId = null)
    {   
        if (empty($subjectId)) {
            throw new NotFoundException(__('Invalid subject'));
        }
        $this->Tutorial->recursive = 0;
        $this->paginate = array('conditions' => array('Tutorial.subject_id' => $subjectId));
        $tutorials = $this->paginate();
        $this->set(compact('tutorials'));
    }//end index()


    /**
     * This action method is used to display details of the selected tutorial.
     *
     * @param integer $id tutorial id
     *
     * @return void
     */
    public function student_view($id = null)
    {
        $this->Tutorial->id = $id;

        // If Tutorial does not exists, throws an exception.
        if (!$this->Tutorial->exists()) {
            throw new NotFoundException(__('Invalid tutorial'));
        }

        $this->set('tutorial', $this->Tutorial->read(null, $id));
        $this->render('admin_view');
    }//end admin_view()



}//end class
