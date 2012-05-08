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
