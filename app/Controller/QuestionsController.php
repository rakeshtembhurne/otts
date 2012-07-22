<?php
class QuestionsController extends AppController
{


    /**
     * This action method is used to display paginated list of questions.
     *
     * @return void
     */
    public function admin_index($topicId = null)
    {
        $this->Question->recursive = 0;
        if (!empty($topicId)) {
            $this->paginate = array('conditions' => array('topic_id' => $topicId));    
        }      

        $this->set('questions', $this->paginate());
        $this->set('topics', $this->Question->Topic->find('list'));
    }//end index()


    /**
     * This action method is used to display details of the selected question.
     *
     * @param integer $id question id
     *
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->Question->id = $id;

        // If Question does not exists, throws an exception.
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }

        $this->set('question', $this->Question->read(null, $id));
    }//end admin_view()


    /**
     * This action method is used to add new question.
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {       
            $this->Question->create();

            //debug($this->request->data);exit;
            if ($this->Question->save($this->request->data)) {
                $this->Session->setFlash(__('The question has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'), 'error');
            }
        }        

        $contain = array('Subject.name');

        $topics = $this->Question->Topic->find(
            'all',
            compact('contain')
        );

        $topicsList = array();
        foreach ($topics as $topic){
            $topicsList[$topic['Subject']['name']][$topic['Topic']['id']] = $topic['Topic']['name'];
        }

        $topics = $topicsList;      
        //debug($topicsList);
        $this->set(compact('topics'));
    }//end add()


    /**
     * This action method is used to edit the selected question.
     *
     * @param integer $id question id
     *
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Question->id = $id;

        // If question does not exist, throws an exception.
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }

        // If form was submitted, saves the question.
        if ($this->request->is('post') || $this->request->is('put')) {            
            
            if ($this->Question->save($this->request->data)) {
                if (!empty($_FILES)) {
                    $this->Question->Image->Behaviors->attach(
                        'ImageUpload',
                        array(
                            'fileField' => 'filename',
                            'dirFormat' => 'images'
                        )
                    );
                    $this->request->data['Image'] = array_merge(
                        $this->request->data['Image'],
                        array('question_id' => $this->Question->id)
                    );                
                    if ($this->Question->Image->save($this->request->data)) {
                        //debug($this->request->data);exit;
                        $this->Session->setFlash(
                            __('The question has been saved'),
                            'success'                    
                        );
                    } else {
                        $this->Question->delete();
                        $this->Session->setFlash(__('The question image could not be saved. Please, try again.'), 'error');
                    }
                } else {
                    $this->Session->setFlash(
                            __('The question has been saved'),
                            'success'                    
                        );
                }
                
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'), 'error');
            }
        } else {
            $this->request->data = $this->Question->read(null, $id);
            $this->request->data['Question']['answer'] = unserialize($this->request->data['Question']['answer']);
        }

        $contain = array('Subject.name');

        $topics = $this->Question->Topic->find(
            'all',
            compact('contain')
        );

        $topicsList = array();
        foreach ($topics as $topic){
            $topicsList[$topic['Subject']['name']][$topic['Topic']['id']] = $topic['Topic']['name'];
        }

        $topics = $topicsList;      
       
        $images      = $this->Question->Image->find(
            'all', 
            array(
             'conditions' => array('Image.question_id' => $id),
             'contain' => false
            )
        );        
//debug($images);
        $question_id = $id;
        $this->set(compact('topics', 'question_id', 'images'));
    }//end edit()


    /**
     * This action method is used to delete the selected question.
     *
     * @param integer $id question id
     *
     * @return void
     */
    public function admin_delete($id = null)
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
            $this->Session->setFlash(__('Question deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }

        // If the question was not deleted, sets flash message.
        $this->Session->setFlash(__('Question was not deleted'));
        $this->redirect(array('action' => 'index'));
    }//end delete()


    public function admin_edit_question_image($id = null) {        
        $this->Question->id = $id;
        // If the question does not exists, throws an exception.
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }
        //debug($this->request->data);exit;
        $this->Question->Image->Behaviors->attach(
            'ImageUpload',
            array(
                'fileField' => 'filename',
                'dirFormat' => 'images'
            )
        );
        //debug($this->request->data);exit;
        if ($this->Question->Image->save($this->request->data)) {
            $this->Session->setFlash(__('Image Saved'), 'success');
        } else {
            //debug($this->Question->Image->validationErrors);            
            $this->Session->setFlash('Image could not be saved.', 'error');
        }
        $this->redirect($this->referer());
    }


}//end class
