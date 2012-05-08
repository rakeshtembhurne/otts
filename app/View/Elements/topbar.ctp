<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <?php
                echo $this->Html->link(__('OTTS'), Router::url('/', true), array('class' => 'brand'));
                $anonymousMenu = array(
                    array(
                        'title'    => 'Boards',
                        'dropdown' => array(
                            array(
                                'title'   => 'Board',
                                'url'     => array('controller' => 'boards', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'boards', 'action' => 'add', 'admin' => true),
                            ),
                        ),
                    ),
                    array(
                        'title'    => 'Courses',
                        'dropdown' => array(
                            array(
                                'title'   => 'Course',
                                'url'     => array('controller' => 'courses', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'courses', 'action' => 'add', 'admin' => true),
                            ),
                        ),
                    ),
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
                        'title'    => 'Candidate',
                        'dropdown' => array(
                            array(
                                'title'   => 'List',
                                'url'     => array('controller' => 'candidates', 'action' => 'index', 'admin' => true),
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'candidates', 'action' => 'add', 'admin' => true),
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
                        ),
                    ),
                );
            $adminMenu = array(
                array(
                    'title'   => 'Home',
                    'url'     => Router::url('/', true),
                ),
            );
            $logInMenu = array(
                array(
                    'title'   => 'Log In',
                    'url'     => array('controller' => 'users', 'action' =>'login', 'admin' => false),
                ),
            );
            $logOutMenu = array(
                array(
                    'title' => 'Settings',
                    'url'   => array('controller' => 'users', 'action' =>'settings', 'admin' => true),
                ),
                array(
                    'title' => 'Log Out',
                    'url'   => array('controller' => 'users', 'action' =>'logout', 'admin' => false),
                ),
            );

            ?>
            <?php if($this->Session->read('Auth.User.role') === 'admin'): ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $adminMenu, 'secondary' => false)); ?>
            <?php else: ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $anonymousMenu, 'secondary' => false)); ?>
            <?php endif; ?>

            <?php if($this->Session->read('Auth.User.id')): ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $logOutMenu, 'secondary' => true)); ?>
            <?php else: ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $logInMenu, 'secondary' => true)); ?>
            <?php endif; ?>    
        </div>
    </div>
</div>

 

