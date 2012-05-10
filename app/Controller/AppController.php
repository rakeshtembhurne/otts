<?php
class AppController extends Controller
{

/**
 * This class variable is used to list component classes used by controllers.
 *
 * @var array
 */
public $components = array(
                          0      => 'Session',
                          'Auth' => array(
                                     'loginRedirect'  => array(
                                                          'controller' => 'subjects',
                                                          'action'     => 'index',
                                                         ),
                                     'logoutRedirect' => array(
                                                          'controller' => 'tests',
                                                          'action'     => 'take_test',
                                                         ),
                                    )
                         );
                         
 /*public $components = array(     
    'Acl',
    'Auth' => array(
      'loginAction' => array(
        'controller' => 'users',
        'action'     => 'login',
        'admin'      => false,
        'teacher'    => false,
        'student'    => false,
      ),        
      'authenticate' => array(
        'Form' => array(
          'fields' => array(
            'username' => 'email'
          )
        )
      ),
       'authorize' => 'Controller',
     ),
    'Session'
  );
 
   protected function getRedirectPath() {
    if ($this->Session->read('Auth.User.userGroup') == 'Admin') {
      $this->Auth->loginRedirect = array(
        'controller' => 'schools',
        'action'     => 'index',
        'admin'      => true,
        'plugin'     => false
      );
    } else if($this->Session->read('Auth.User.userGroup') == 'Employee') {
      $this->Auth->loginRedirect = array(
        'controller' => 'schools',
        'action'     => 'index',
        'admin'      => true,
        'plugin'     => false
      );
    } else if($this->Session->read('Auth.User.userGroup') == 'Teacher') {
      $this->Auth->loginRedirect = array(
        'controller' => 'teachers',
        'action'     => 'home',
        'teacher'      => true,
        'plugin'     => false
      );
    } else if($this->Session->read('Auth.User.userGroup') == 'Student') {
      $this->Auth->loginRedirect = array(
        'controller' => 'students',
        'action'     => 'home',
        'student'      => true,
        'plugin'     => false
      );      
    }
  }//end getRedirectPath()
 
function isAuthorized()
  {
    
    // Build ARO alias as per user id
    $aroAlias = 'User::' . (int)$this->Auth->user('id');

    // Condition to use to check for ARO existence
    $condition = array('Aro.alias' => $aroAlias);

    // Get logged in user's parent's id
    $parentId = (int)$this->Acl->Aro->field('Aro.parent_id', $condition);

    // If logged in user is of 'Admin' group then allow him everything
    if ($parentId && 'Admin' == $this->Acl->Aro->field('Aro.alias', array('Aro.id' => $parentId))) {
      $this->set('isAdmin', true);
      return true;
    }

    // Build ACO alias
    $acoAlias = $this->name . '::' . $this->action;

    // If ACO does not exist then return true
    if (!$this->Acl->Aco->hasAny(array('Aco.alias' => $acoAlias))) {
      return true;
    }

    // If ARO does not exist then return false
    if (!$this->Acl->Aro->hasAny($condition)) {
      return false;
    }


    // Return true/false according to user's access
    return $this->Acl->check($aroAlias, $acoAlias);
  }//end isAuthorized()


   public function getParentGroup($userId = null)
  {
      // Get the member id
      if (empty($userId)) {
          $userId = $this->Auth->user('id');
      }

      // Condition to find parent id of the member
      $conditions = array('Aro.foreign_key' => $userId);
      // Find parent id of logged in user
      $parentId = $this->Acl->Aro->field('parent_id', $conditions);
      // Condition to find parent alias
      $conditions = array('Aro.id' => $parentId);
      // Find parent alias
      return array(
              'parent_id'    => $parentId,
              'parent_group' => $this->Acl->Aro->field('alias', $conditions),
             );
  }
    private function allowUser()
  {
    // Build ACO alias
    $acoAlias = $this->name . '::' . $this->action;

    // If user is not logged in and current controller/action allowed to 'Anonymous' then allow that action
    if (0 >= (int)$this->Auth->user('id') && $this->Acl->check('Anonymous', $acoAlias)) {
      $this->Auth->allow($this->action);
    }
  }
 
 
 public function index() {}
  public function components() {}
  public function base_css() {}
  public function javascript() {}
   
   
   protected function _sendEmail($options = array())
  {
    // First use email component
    App::uses('CakeEmail', 'Network/Email');
    $email = new CakeEmail();

    $defaults = array(
      'to'          => null,
      'from'        => null,
      'replyTo'     => null,
      'cc'          => array(),
      'bcc'         => array(),
      'subject'     => null,
      'template'    => null,
      'emailFormat' => 'html',
      'attachments' => array(),
      'viewVars'    => null,
    );
    // Merge the passed options with the default ones
    $options = array_merge($defaults, $options);
    // If we don't have a replyTo then set 'from' as 'replyTo'
    if (empty($options['replyTo'])) {
      $options['replyTo'] = $options['from'];
    }

    // Set the options in Email component
    foreach ($options as $option => $value) {
      $email->{$option}($value);
    }

    // Send the email
    return $email->send();
  }*/
   
   /**
     * This class variable is used to list helper used by all views.
     *
     * @var type
     */
    public $helpers = array(
                       'Html',
                       'Form',
                       'Session',
                       'Js',
                      );


    /**
     * This callback method is used to allow access to anonymous users.
     *
     * @return void
     */
    function beforeFilter()
    {
		
		//$this->allowUser();
        $this->Auth->allow('login', 'logout', 'take_test', 'view_score', 'question');
    }//end beforeFilter()


    public function beforeRender()
    {
        $this->set(
            'twitterBootstrapCreateOptions', 
            array(
             'class'         => 'form-horizontal',
             'inputDefaults' => array(
                                 'div'     => array('class' => 'control-group'),
                                 'label'   => array('class' => 'control-label'),
                                 'error'   => array('attributes' => array(
                                                                     'wrap' => 'span',
                                                                     'class' => 'help-inline',
                                                                    )
                                              ),
                                 'between' => '<div class="controls">',
                                 'after'   => '</div>',
                                 'format'  => array('before', 'label', 'between', 'input', 'error', 'after')
                                ),
            )
        );
        $this->set(
            'twitterBootstrapEndOptions',
            array(
                'label' => __('Submit'),
                'class' => 'btn btn-primary',
                'div'   => array('class' => 'form-actions'),
            )
        );
    }


}//end class
