<?php
App::uses('AuthComponent', 'Controller/Component');
/**
 * File used as User model
 *
 * Contains code needed mainly for users controller
 *
 * @category Model
 */

/**
 * User model class
 *
 * @category Model
 */
class User extends AppModel
{

  // other code.
  public $name = 'User';

  //public $actsAs = array('Acl' => array('type' => 'requester'));

  //public $hasAndBelongsToMany = array('Subject');


  /**
   * Property used to store validation rules for model's fields.
   *
   * @var array Validation rules for model's fields
   * @since 1.0.0 Apr 18, 2008
   *
   * @access public
   */
  public $validate = array(
    'firstname' => array(
      'notempty' => array(
        'rule'    => array('notempty'),        
      ),                                                  
    ),
    'password' => array(
      'required' => array(
        'rule'    => array('notempty'),        
      ),
    ),
    'password2' => array(
      'confirm' => array(
        'rule'    => array('confirmPassword'),       
      ),   
      'required' => array(
        'rule' => array('notempty'),    
      ),
    ),
    'lastname' => array(
      'notempty' => array(
        'rule' => array('notempty'),      
      ),
    ),
    'email' => array(
      'notempty' => array(
        'rule' => array('notempty'),      
      ),
      'email' => array(
        'rule' => array('email'),      
      ),
      'unique' => array(
        'rule' => array('isUnique'),    
      ),
    ),
    'username' => array(
      'notempty' => array(
        'rule' => array('notempty'),      
      ),      
      'unique' => array(
        'rule' => array('isUnique'),    
      ),
    ),
    'mobile' => array(
      'notempty' => array(
        'rule' => array('notempty'),      
      ),
    ),    

  );  


  /**
   * Method used to beforeValidate in user sign-up
   *
   * @return void
   */
  function beforeValidate() 
  { 
    
    
    return true;
  }//end beforeValidate()

 
  /**
   * callback function
   *     
   * @return void.
   */
  public function beforeSave() {
    if(isset($this->data['User']['password'])) {
      $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    } 
    return true;
  }


  /**
   * Method used to check for password confirmation
   *
   * @return boolean If password is not match with confirm_password then return false otherwise return true
   */
  public function confirmPassword()
  {
    // Check password and confirm_password are same or not
    return ($this->data['User']['password'] == $this->data['User']['password2']);
  }//end confirmPassword()


  /**
   * Function Acl management
   *     
   * @return void.
   */
  function parentNode() {
    if (!$this->id && empty($this->data)) {
      return null;
    }
    if (isset($this->data['User']['group_id'])) {
      $groupId = $this->data['User']['group_id'];
    } else {
      $groupId = $this->field('group_id');
    }
    if (!$groupId) {
      return null;
    } else {
      return array('Group' => array('id' => $groupId));
    }
  }//end parentNode()




  /**
   * Callback function to handle logic after save operation.
   *
   * @param boolean $created Flag to determine whether record is created or updated.
   *
   * @access public
   *
   * @return void
   */ 
  public function afterSave()
  {
    // Call to function to save user group.
    $userId = $this->id;
    if (!empty($this->data['User']['group_id'])) {    
      $parentGroupId = $this->data['User']['group_id'];
    }
    if (!empty($userId) && !empty($parentGroupId)) {
      $this->setUserGroup($userId, $parentGroupId);
    } 
  }//end afterSave()


  /**
   * Function to set user group.
   *
   * @param integer $userId        User id.
   * @param integer $parentGroupId Group id.
   *
   * @access private
   *
   * @return void  
   */
  private function setUserGroup($userId, $parentGroupId)
  {
    $aro = ClassRegistry::init('Aro');
    // Condition to delete existing record from aros
    $conditions = array('Aro.foreign_key' => $userId);
    // Delete the member from aros table
    $aro->deleteAll($conditions);

    // Build data to save
    $data = array(
      'parent_id'   => $parentGroupId,
      'foreign_key' => $userId,
      'alias'       => 'User::' . $userId,
    );

    // Prepare model to save data
    $aro->create();
    // Save needed data
    $aro->save($data);

  }//end setUserGroup()


  
  /**
   * Function to get all the user groups
   * 
   * @access public
   *
   * @return array $userGroups User groups.
   */
  public function getUserGroups()
  {
    $aro        = ClassRegistry::init('Aro');
    $options    = array(
      'conditions' => array('Aro.foreign_key' => NULL),
      'fields'     => array(
        'id',
        'alias',
      ),
    );
    $userGroups = $aro->find('list', $options); 
    return $userGroups; 
  }//end getUserGroups()


}//end class
