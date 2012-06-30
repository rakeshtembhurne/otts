<?php

/**
 * Behavior to handle file uploading from url.
 *
 * PHP version 5
 *
 * @category Behavior
 * @package  UploadBehavior
 * @author   Rakesh Tembhurne <amit@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */

/**
 * Upload behavior class
 *
 * @category Behavior
 * @package  UploadBehavior
 * @author   Rakesh Tembhurne <amit@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */
class UrlUploadBehavior extends ModelBehavior
{


    /**
     * This method is applied to attach user specified settings to model if given.
     *
     * @param Model &$model   instance of Model
     * @param array $settings list of settings
     *
     * @return void
     */
    function setup(&$model, $settings = array())
    {
        if (!isset($this->settings[$model->alias])) {
            $this->settings[$model->alias] =
                array('uploadDir' => WWW_ROOT . 'files' . DS . 'pictures' . DS);
        }
        $this->settings[$model->alias] = array_merge($this->settings[$model->alias], (array) $settings);
    }//end setup()


    /**
     * This callback method calls private method to proceeds toward upload.
     *
     * @param Model &$model instance of model
     *
     * @return type
     */
    function beforeSave(&$model)
    {
        return $this->_processUpload($model);
    }//end beforeSave()


    /**
     * This private method downloads the file from url.
     *
     * @param Model &$model instance of model
     *
     * @return boolean
     */
    function _processUpload(&$model)
    {
        // Takes out filename from url
        $filename = basename($this->settings[$model->name]['url']);

        // downloads file and stores content of the file in variable
        $fileContents = file_get_contents($this->settings[$model->name]['url']);

        // File in which to store
        $saveAs = $this->settings[$model->name]['uploadDir'] . $filename;

        // Setting the permissions using File utility
        App::import('Utility', 'File');
        $file = new File($saveAs, true, 0777);

        return $file->write($fileContents);
    }//end _processUpload()


}//end class
