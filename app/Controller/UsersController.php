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
                $this->Session->setFlash(__('Logged in successfully.'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again!'));
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
            $this->Session->setFlash(__('Logged out successfully.'));
        }
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


}//end class
