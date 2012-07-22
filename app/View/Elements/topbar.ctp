<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <?php
                echo $this->Html->link(__('OTTS'), Router::url('/', true), array('class' => 'brand'));
                $adminMenu = array(
                    array(
                        'title'    => 'Subject',
                        'dropdown' => array(
                            array(
                                'title'   => 'List',
                                'url'     => array('controller' => 'subjects', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'subjects', 'action' => 'add', 'admin' => true),
                            ),
                        ),
                    ),
                    array(
                        'title'    => 'Topics',
                        'dropdown' => array(
                            array(
                                'title'   => 'Topics',
                                'url'     => array('controller' => 'topics', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'topics', 'action' => 'add', 'admin' => true),
                            ),
                        ),
                    ),                                        
                    array(
                        'title'    => 'Question',
                        'dropdown' => array(
                            array(
                                'title'   => 'List',
                                'url'     => array('controller' => 'questions', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'questions', 'action' => 'add', 'admin' => true),
                            ),
                        ),
                    ),                    
                    array(
                        'title'    => 'Tests',
                        'dropdown' => array(
                            array(
                                'title'   => 'Test',
                                'url'     => array('controller' => 'tests', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'tests', 'action' => 'add', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Take Test',
                                'url'     => array('controller' => 'tests', 'action' => 'take_test', 'admin' => false),
                            ),
                        ),
                    ),
                    array(
                        'title'    => 'User',
                        'dropdown' => array(
                            array(
                                'title'   => 'Admin',
                                'url'     => array('controller' => 'users', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Employee',
                                'url'     => array('controller' => 'users', 'action' => 'employee', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Student',
                                'url'     => array('controller' => 'users', 'action' => 'student', 'admin' => true),
                            ),
                        ),
                    ),
                );
            $studentMenu = array(
                array(
                    'title'   => 'Home',
                    'url'     => array('controller' => 'users', 'action' =>'home', 'student' => true),
                ),
            );
            $logInMenu = array(
                array(
                    'title'   => 'Log In',
                    'url'     => array('controller' => 'users', 'action' =>'login', 'admin' => false),
                ),
            );
            $username = $this->Session->read("Auth.User.firstname"). ' '.$this->Session->read("Auth.User.lastname"); 
            
            $uiName = ($username != ' ') ? $username : 'User';            
            $logOutMenu = array(
                array(
                        'title'    => $uiName,
                        'dropdown' => array(
                            array(
                                'title'   => 'My Account',
                                'url'     => array('controller' => 'users', 'action' => 'account', 'admin' => false, 'student' => false),
                            ),
                            array(
                                'title'   => 'Profile',
                                'url'     => array('controller' => 'users', 'action' => 'profile', 'admin' => false, 'student' => false),
                            ),                            
                        ),
                    ),
                array(
                    'title' => 'Log Out',
                    'url'   => array('controller' => 'users', 'action' =>'logout', 'admin' => false),
                ),
            );

            ?>
            <?php if($this->Session->read('Auth.User.userGroup') === 'Student') { ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $studentMenu, 'secondary' => false)); ?>
            <?php } elseif($this->Session->read('Auth.User.userGroup') === 'Admin') { ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $adminMenu, 'secondary' => false)); ?>
            <?php } ?>

            <?php if($this->Session->read('Auth.User.id')): ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $logOutMenu, 'secondary' => true)); ?>
            <?php else: ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $logInMenu, 'secondary' => true)); ?>
            <?php endif; ?>    
        </div>
    </div>
</div>
