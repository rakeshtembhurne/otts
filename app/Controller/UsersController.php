<?php
class UsersController extends AppController
{


    /**
     * This action method is used to log user in.
     *
     * @return void
     */
    public function login()
    {
        // User logs in successfully
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $groupInfo = $this->getParentGroup((int)$this->Auth->user('id'));        
                if (!empty($groupInfo['parent_group'])) {
                  $this->Session->write('Auth.User.userGroup', $groupInfo['parent_group']);
                } 
                //this function returns redirect path by user's role
                $this->getRedirectPath();
                //$this->Session->setFlash(__('Logged in successfully.'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again!'), 'error');
            }
        }
    }//end login()


    /**
     * This action method is used to log user out.
     *
     * @return void
     */
    public function logout()
    {
        if ($this->Auth->logout()) {
            $this->Session->setFlash(__('Logged out successfully.'), 'success');
        }
        $this->Session->destroy();
       
        $this->redirect($this->Auth->logoutRedirect);
    }//end logout()


    /**
     * This action method is used to display paginated users.
     *
     * @return void
     */
    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }//end index()


    /**
     * This action method is used to display details of the user.
     *
     * @param integer $id user id
     *
     * @return void
     */
    public function view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }//end view()


    /**
     * This action method is used to edit user details.
     *
     * @param integer $id user id
     *
     * @return void
     */
    public function edit($id = null)
    {
        $this->User->id = $id;

        // If user does not exists, throws exception.
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        // If form is submitted, save user.
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
                exit;
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }//end edit()
    
    
    public function signup() { 
         
      if($this->request->is('post')) {  
        $options = array(
          'to'          => 'jitendra.thakur2008@gmail.com',
          'from'        => 'no-reply@otts.com',
          'replyTo'     => null,
          'cc'          => array(),
          'bcc'         => array(),
          'subject'     => 'Account information',
          'template'    => null,
          'emailFormat' => 'html',
          'attachments' => array(),
          'viewVars'    => null,
        );

       $this->_sendEmail($options);

        $this->request->data['User']['group_id'] = Configure::read('studentGroupId');
        if($this->User->save($this->request->data)) {
         
          if ($this->Auth->login()) {         
            $groupInfo = $this->getParentGroup((int)$this->Auth->user('id'));        
            if (!empty($groupInfo['parent_group'])) {
              $this->Session->write('Auth.User.userGroup', $groupInfo['parent_group']);
            } 
            //this function returns redirect path by user's role
            $this->getRedirectPath();
            $this->redirect($this->Auth->redirect());
          }
        }
      }    
      $userId = $this->Auth->user('id');
      if(!empty($userId)) {
        $this->getRedirectPath();
        $this->redirect($this->Auth->redirect());
      }
      //$this->layout = 'login';

    }//end signup()


    function student_home() {        
        $this->set('user', $this->User->read(null, $this->Session->read('Auth.User.id')));
    }



    /**
     * This action method is used to display paginated admin users.
     *
     * @return void
     */
    public function admin_index()
    {   
        $this->User->bindModel(array(
            'hasOne' => array(
                'Aro' => array(
                    'foreignKey' => 'foreign_key',
                    'conditions' => array(
                        'Aro.parent_id' => Configure::read('adminGroupId'),                        
                    ),
                    'type' => 'inner'
                )
            )
        ));        
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }//end admin_index()


    /**
     * This action method is used to display paginated student users.
     *
     * @return void
     */
    public function admin_student()
    {   
        if ($this->request->is('post') || $this->request->is('put')) {            
            $email = $this->request->data['User']['email'];
        }
        $this->User->bindModel(array(
            'hasOne' => array(
                'Aro' => array(
                    'foreignKey' => 'foreign_key',
                    'conditions' => array(
                        'Aro.parent_id' => Configure::read('studentGroupId'),                        
                    ),
                    'type' => 'inner'
                )
            ),
            
        ));     
        if(!empty($email)) {
            $this->paginate = array('conditions' => array('User.email' => $email));
        }
        //$this->User->bindModel(array('hasAndBelongsToMany' => array('Subject')));
        $this->User->recursive = 0;        
        $this->set('users', $this->paginate());
    }//end student_index()


    /**
     * This action method is used to display paginated employee users.
     *
     * @return void
     */
    public function admin_employee()
    {   
        $this->User->bindModel(array(
            'hasOne' => array(
                'Aro' => array(
                    'foreignKey' => 'foreign_key',
                    'conditions' => array(
                        'Aro.parent_id' => Configure::read('employeeGroupId'),                        
                    ),
                    'type' => 'inner'
                )
            )
        ));        
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }//end employee_index()


    /**
     * This action method is used to add admin user.          
     *
     * @return void
     */
    public function admin_add()
    {
        
        // If form is submitted, save user.
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['group_id'] = Configure::read('adminGroupId');
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'success');
                $this->redirect(array('action' => 'index', 'admin' => true));
                
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
        }             
    }//end admin_add()


    /**
     * This action method is used to add employee user.          
     *
     * @return void
     */
    public function admin_employee_add()
    {
        
        // If form is submitted, save user.
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['group_id'] = Configure::read('employeeGroupId');
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'success');
                $this->redirect(array('action' => 'employee', 'admin' => true));
                
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
        }             
    }//end admin_employee_add()


    /**
     * This action method is used to display details of the admin user.
     *
     * @param integer $id user id
     *
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }//end admin_view()


    /**
     * This action method is used to admin edit user details.
     *
     * @param integer $id user id
     *
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->User->id = $id;

        // If user does not exists, throws exception.
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        // If form is submitted, save user.
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));               
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }//end admin_edit()


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

        // If User does not exist, throws an exception.
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid User'));
        }

        // Deletes the User.
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }

        // If User was not deleted, sets error message and redirects.
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }//end admin_delete()



    /**
     * This action method is used to user account details.     
     *
     * @return void
     */
    public function account()
    {
        $id = $this->Session->read('Auth.User.id');

        // If form is submitted, save user.
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The Account information has been updated'), 'success');                             
            } else {
                $this->Session->setFlash(__('he Account information has not been updated. Please, try again.'), 'error');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }//end admin_edit()


    /**
     * This action method is used to display profile user.    
     *
     * @return void
     */
    public function profile()
    {
        $id = $this->Session->read('Auth.User.id');
        $this->set('user', $this->User->read(null, $id));
    }//end admin_view()


    function admin_approve_student() {
        $this->autoRender = false;
        
        if (isset($this->request->data['tnt'])) {
            $data['tnt'] = '0';
            if ($this->request->data['tnt'] == 'true')   {
                $data['tnt'] = '1';    
            }

        } else if(isset($this->request->data['quiz'])) {
            $data['quiz'] = '0';
            if ($this->request->data['quiz'] == 'true')   {
                $data['quiz'] = '1';    
            }

        }        
        
        $data['id'] = $this->request->data['studentId'];
        if ($this->User->save($data)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * This action method is used to admin edit user details.
     *
     * @param integer $id user id
     *
     * @return void
     */
    public function admin_student_edit($id = null)
    {
        $this->User->bindModel(array('hasAndBelongsToMany' => array('Subject')));
        $subjects = $this->User->Subject->find(
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

        $this->User->id = $id;
        //debug($this->User->read());
        //If user does not exists, throws exception.
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        // If form is submitted, save user.
        if ($this->request->is('post') || $this->request->is('put')) {    
               
            if ($this->User->save($this->request->data)) {
                ClassRegistry::init('subjects_users')->deleteAll(array('user_id' => $this->request->data['User']['id']));
                foreach($this->request->data['User']['Subject'] as $subjectId) {
                    $data['user_id'] = $this->request->data['User']['id'];
                    $data['subject_id'] = $subjectId;
                    ClassRegistry::init('subjects_users')->create();
                    ClassRegistry::init('subjects_users')->save($data);
                }
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'student'));
                exit;
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->User->bindModel(array('hasAndBelongsToMany' => array('Subject')));
            $this->request->data = $this->User->read();           
        }
    }//end admin_student_edit()


    /**
     * This action method is used to display details of the admin user.
     *
     * @param integer $id user id
     *
     * @return void
     */
    public function admin_student_view($id = null)
    {
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->User->bindModel(array('hasAndBelongsToMany' => array('Subject')));   
        $this->set('user', $this->User->read(null, $id));
    }//end admin_student_view()


}//end class
