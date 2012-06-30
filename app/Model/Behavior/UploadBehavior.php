<?php

/**
 * Behavior to handle file uploading.
 *
 * PHP version 5
 *
 * @category Behavior
 * @package  UploadBehavior
 * @author   Amit Badkas <amit@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */

/**
 * Upload behavior class
 *
 * @category Behavior
 * @package  UploadBehavior
 * @author   Amit Badkas <amit@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */
class UploadBehavior extends ModelBehavior
{

    /**
     * This class variable contains list of default upload settings.
     *
     * Settings:
     * 'allowedMime' => '*', //array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
     * 'allowedExt' => '*', //array('jpg','jpeg','gif','png'),
     * 'baseDir' : The constaants DS, APP, WWW_ROOT can be used if wrapped in {} To use a variable,
     *             wrap in {} if the var is not defined during setup it is assumed to be the name
     *             of a field in the submitted data
     * 'dirFormat' : //'dirFormat' => '{$class}{DS}{$foreign_id}', // include {$baseDir} to have absolute
     *                paths include {$baseDir} to have absolute paths
     * 'fileFormat' : include {$dir} to store the dir & filename in one field.
     *                'fileFormat' => '{$filename}_{$description}', // include {$dir} to store the dir &
     *                filename in one field
     *
     * @var array
     */
    var $__defaultSettings = array(
                              'enabled'           => true,
                              'fileField'         => 'filename',
                              'dirField'          => 'dir',
                              'allowedMime'       => '*',
                              'allowedExt'        => '*',
                              'allowedSize'       => '8',
                              'allowedSizeUnits'  => 'MB',
                              'overwriteExisting' => false,
                              'baseDir'           => '{WWW_ROOT}files{DS}',
                              'dirFormat'         => '',
                              'fileFormat'        => '{$filename}',
                              'pathReplacements'  => array(),
                              '_setupError'       => false,
                             );


    /**
     * This method initiate Upload behavior by setting configuration options.
     *
     * @param Model &$model instance of model
     * @param array $config array of configuration settings.
     *
     * @return void
     */
    function setup(&$model, $config=array())
    {
        // Merges default settings and user defined settings
        $settings = am($this->__defaultSettings, $config);
        App::import('Utility', 'Folder');
        $this->settings[$model->name] = $settings;

        // Extracts settings into variables.
        extract($this->settings[$model->name]);

        // Changes path replacement settings.
        $this->addReplace($model, '{WWW_ROOT}', WWW_ROOT);
        $this->addReplace($model, '{APP}', APP);
        $this->addReplace($model, '{DS}', DS);
        $path     = $this->__replacePseudoConstants($model, $baseDir);
        $fullpath = $path . $dirFormat;

        // Creates new folder if file does not exist, triggers error if not writable or does not exist.
        if (!file_exists($fullpath)) {
            new Folder($fullpath, true);
            // If file does not exist, triggers error
            if (!file_exists($fullpath)) {
                trigger_error(
                    __('Directory %1$s doesn\'t exist and cannot be created. %2$s', $fullpath, __METHOD__),
                    E_USER_WARNING
                );
                $this->settings[$model->name]['enabled']     = false;
                $this->settings[$model->name]['_setupError'] = true;
            }
        } elseif (!is_writable($fullpath)) {
            // If directory is not writable, triggers error
            trigger_error(
                __('Directory %1$s is not writable. %2$s', $fullpath, __METHOD__),
                E_USER_WARNING
            );
            $this->settings[$model->name]['enabled']     = false;
            $this->settings[$model->name]['_setupError'] = true;
        };
        // Sets modified path in settings
        $this->settings[$model->name]['baseDir'] = $path;
        if (!$enabled) {
            return;
        }

        // Adds new validation rules related to upload.
        $this->setupUploadValidations($model);
    }//end setup()


    /**
     * This method changes the state of 'enable' setting
     *
     * @param model   &$model instance of model
     * @param boolean $enable to enable or not
     *
     * @return boolean
     */
    function enableUpload(&$model, $enable = null)
    {
        if ($enable !== null) {
            $this->settings[$model->name]['enabled'] = $enable;
        }
        return $this->settings[$model->name]['enabled'];
    }//end enableUpload()


    /**
     * This method changes the pathReplacements setting.
     *
     * @param model   &$model  instance of model
     * @param string  $find    string to find
     * @param repalce $replace string to replace
     *
     * @return void
     */
    function addReplace(&$model, $find, $replace = '')
    {
        $this->settings[$model->name]['pathReplacements'][$find] = $replace;
    }//end addReplace()


    /**
     * This callback method is used delete a file before model's delete method.
     *
     * @param model &$model instance of the model
     *
     * @return boolean
     */
    function beforeDelete(&$model)
    {
        // Extracts settings into vairbles.
        extract($this->settings[$model->name]);
        if (!$enabled) {
            return true;
        }

        // If field exists for model, creates filename by reading the record from databse table.
        if ($model->hasField($dirField)) {
            $data     = $model->read(array($dirField, $fileField));
            $dirField = $data[$model->name]['dir'];
            $filename = $data[$model->name][$fileField];
            $filename = $dirField . DS . $filename;
        } else {
            // Creates field from fileField provided
            $filename                              = $model->field($fileField);
            $model->data[$model->name][$fileField] = $filename;
            $filename                              = $dirFormat . DS . $filename;
        }

        // deletes the file and returns true if deleted, false otherwise.
        if (is_file($baseDir . $filename) && !unlink($baseDir . $filename)) {
            return false;
        }
        return true;
    }//end beforeDelete()


    /**
     * This callback method is used to start upload before saving data.
     *
     * @param model &$model instance of the model
     *
     * @return boolean
     */
    function beforeSave(&$model)
    {
        // Checks if behavior is enabled or not.
        extract($this->settings[$model->name]);
        if (!$enabled) {
            return true;
        }

        // before saving, performs upload
        return $this->_processUpload($model);
    }//end beforeSave()


    /**
     * This method checks for upload setup configurations.
     *
     * @param model &$model    instance of the model
     * @param array $fieldData form field data
     *
     * @return boolean
     */
    function checkUploadSetup(&$model, $fieldData)
    {
        // Extracts the settings into variables and checks if there are errors or Behavior is enabled or not
        extract($this->settings[$model->name]);
        if ($_setupError) {
            return false;
        }
        if (!$enabled) {
            return true;
        }
        //TODO check if this error is appearing correctly
        if (!is_array($fieldData)) {
            $errMessage = 'The form field (%1$s) is not an array, check the form has '.
                          'enctype=\'multipart/form-data\'. If you are using the form helper include'.
                          ' \'type\' => \'file\' in the second parameter. %2$s';
            trigger_error(__($errMessage, $fileField, __METHOD__), E_USER_WARNING);
            return false;
        }
        return true;
    }//end checkUploadSetup()


    /**
     * This method checks for error occured during file upload.
     *
     * @param model &$model    instance of the model
     * @param array $fieldData form field data
     *
     * @return boolean
     */
    function checkUploadError(&$model, $fieldData)
    {
        extract($this->settings[$model->name]);
        if (!$enabled || $_setupError || !is_array($fieldData)) {
            return true;
        }
        //if ($fieldData['size'] && $fieldData['error']) {
        if ($fieldData[$fileField]['error']) {
            return false;
        }
        return true;
    }//end checkUploadError()


    /**
     * This method checks for mime types of file being uploaded.
     *
     * @param model &$model    instance of model
     * @param array $fieldData form field data'
     *
     * @return boolean
     */
    function checkUploadMime(&$model, $fieldData)
    {
        extract($this->settings[$model->name]);
        if (!$enabled || $_setupError || !is_array($fieldData) || $allowedMime == '*') {
            return true;
        }
        if (is_array($allowedMime)) {
            //if (in_array($fieldData['type'], $allowedMime)) {
            if (in_array($fieldData[$fileField]['type'], $allowedMime)) {
                return true;
            }
            //} elseif ($allowedMime == $fieldData['type']) {
        } elseif ($allowedMime == $fieldData[$fileField]['type']) {
            return true;
        }
        return false;
    }//end checkUploadMime()


    /**
     * This method checks for file extensions of file being uploaded.
     *
     * @param model &$model    instance of model
     * @param array $fieldData form field data'
     *
     * @return boolean
     */
    function checkUploadExt(&$model, $fieldData)
    {
        extract($this->settings[$model->name]);
        if (!$enabled || $_setupError || !is_array($fieldData) || $allowedExt == '*') {
            return true;
        }
        //$info = pathinfo($fieldData['name']);
        $info = pathinfo($fieldData[$fileField]['name']);
        //$fileExt = low ($info['extension']);
        $fileExt = strtolower((isset($info['extension']) ? $info['extension'] : ''));
        if (is_array($allowedExt)) {
            if (in_array($fileExt, $allowedExt)) {
                return true;
            }
        } elseif ($allowedExt == $fileExt) {
            return true;
        }
        return false;
    }//end checkUploadExt()


    /**
     * This method checks size of file being uploaded.
     *
     * @param model &$model    instance of model
     * @param array $fieldData form field data'
     *
     * @return boolean
     */
    function checkUploadSize(&$model, $fieldData)
    {
        // Extracts settings into variables, and checks if it is okay to check for upload size.
        extract($this->settings[$model->name]);
        if (!$enabled || $_setupError || !is_array($fieldData) || !$fieldData[$fileField]['size']
            || $allowedSize == '*') {
            return true;
        }

        // Calculates size depending upon unit provided
        $factor = 1;
        switch ($allowedSizeUnits) {
            case 'KB':
                $factor = 1024;
                break;
            case 'MB':
                $factor = 1024 * 1024;
                break;
        }

        // Returns true if filesize is less than permitted values.
        if ($fieldData[$fileField]['size'] <= ($allowedSize * $factor)) {
            return true;
        }

        return false;
    }//end checkUploadSize()


    /**
     * Gets absolute path of the file.
     *
     * @param model   &$model     instance of model
     * @param integer $id         id of the file
     * @param boolean $folderOnly option if path upto folder is required
     *
     * @return string
     */
    function absolutePath(&$model, $id = null, $folderOnly = false)
    {
        if (!$id) {
            $id = $model->id;
        }
        extract($this->settings[$model->name]);
        $path = $baseDir;
        if ($model->hasField($dirField)) {
            if (isset($model->data[$model->name][$dirField])) {
                $dir = $model->data[$model->name][$dirField];
            } else {
                $dir = $model->field($dirField);
            }
            $path .= $dir . DS;
        }
        if ($folderOnly) {
            return $path;
        }
        if (isset($model->data[$model->name][$dirField])) {
            $path .= $model->data[$model->name][$dirField] . DS . $model->data[$model->name][$fileField];
        } else {
            $path .= $model->field($fileField);
        }
        return $path;
    }//end absolutePath()


    /**
     * This method calls private process upload method.
     *
     * @param model &$model instance of model
     * @param array $data   data to pass for upload
     *
     * @return boolean
     */
    function processUpload(&$model, $data = array())
    {
        return $this->_processUpload($model, $data, true);
    }//end processUpload()


    /**
     * This method validates upload being done.
     *
     * @param model &$model instance of model
     *
     * @return void
     */
    function setupUploadValidations(&$model)
    {
        extract($this->settings[$model->name]);
        if (isset($model->validate[$fileField])) {
            $existingValidations = $model->validate[$fileField];
            if (!is_array($existingValidations)) {
                $existingValidations = array($existingValidations);
            }
        } else {
            $existingValidations = array();
        }

        $uploadNotPossibleMessage   = 'Upload not possible. There is a problem with the setup on the '.
                                      'server, more info available in the logs.';
        $validations['uploadSetup'] =
            array(
             'last'    => true,
             'rule'    => 'checkUploadSetup',
             'message' => __($uploadNotPossibleMessage, true)
            );
        $validations['uploadError'] =
            array(
             'last'    => true,
             'rule'    => 'checkUploadError',
             'message' => __('An error was generated during the upload.', true)
            );
        if ($allowedMime != '*') {
            if (is_array($allowedMime)) {
                $allowedMimes = implode(',', $allowedMime);
            } else {
                $allowedMimes = $allowedMime;
            }
            $validations['uploadMime'] =
                array(
                 'last'    => true,
                 'rule'    => 'checkUploadMime',
                 'message' => __(
                     'The submitted mime type is not permitted, only %s permitted.',
                     $allowedMimes
                 ),
                );
        }
        if ($allowedExt != '*') {
            if (is_array($allowedExt)) {
                $allowedExts = implode(',', $allowedExt);
            } else {
                $allowedExts = $allowedExt;
            }
            $validations['uploadExt'] =
                array(
                 'last'    => true,
                 'rule'    => 'checkUploadExt',
                 'message' => __(
                     'The submitted file extension is not permitted, only %s permitted.',
                     $allowedExts
                 ),
                );
        }
        $validations['uploadSize'] =
            array(
             'last'    => true,
             'rule'    => 'checkUploadSize',
             'message' => __(
                 'The file uploaded is too big, files more than %1$d %2$s not permitted.',
                 $allowedSize,
                 $allowedSizeUnits
             ),
            );

        //Runs Behavior validations first.
        $model->validate[$fileField] = am($validations, $existingValidations);
    }//end setupUploadValidations()


    /**
     * This callback method is used before processing the upload.
     *
     * @param model   &$model instance of model
     * @param array   $data   data being uploaded
     * @param boolean $direct wheter upload is called directly
     *
     * @return boolean
     */
    function _afterProcessUpload(&$model, $data, $direct)
    {
        return true;
    }//end _afterProcessUpload()


    /**
     * This callback method is used before processing the upload.
     *
     * @param model   &$model instance of model
     * @param array   $data   data being uploaded
     * @param boolean $direct wheter upload is called directly
     *
     * @return boolean
     */
    function _beforeProcessUpload(&$model, $data, $direct)
    {
        return true;
    }//end _beforeProcessUpload()


    /**
     * This private method is used to get the file name of by replacing pseudo constants from file.
     *
     * @param model  $model  instance of model
     * @param string $string from which file name is to be extracted
     *
     * @return string
     */
    function _getFilename($model, $string)
    {
        extract($this->settings[$model->name]);
        if (strpos($string, '{') === false) {
            return Inflector::underscore(preg_replace('@[^\p{L}0-9]@u', '', $string));
        }
        return $this->__replacePseudoConstants($model, $string);
    }//end _getFilename()


    /**
     * This method is used to get path by replacing pseudo constants and create if path does not exist.
     *
     * @param model  $model instance of model
     * @param string $path  path to check
     *
     * @return string
     */
    function _getPath($model, $path)
    {
        extract($this->settings[$model->name]);
        if (strpos($path, '{') === false) {
            return $path;
        }
        $path = $this->__replacePseudoConstants($model, $path);
        new Folder($baseDir . $path, true);
        return $path;
    }//end _getPath()


    /**
     * This private method is used to upload the file.
     *
     * @param model   &$model instance of model
     * @param array   $data   data to upload
     * @param boolean $direct wheter upload is to be done directly
     *
     * @return boolean
     */
    function _processUpload(&$model, $data = array(), $direct = false)
    {
        if ($data) {
            $model->data = $data;
        }
        // Double check for upload start
        extract($this->settings[$model->name]);
        if (!isset($model->data[$model->name][$fileField])) {
            if ($direct) {
                $directMessage = 'The method processUpload has been explicitly called but the filename '.
                                 'field (%1$s) is not present in the submitted data. %2$s';
                trigger_error(__($message, $fileField, __METHOD__), E_USER_WARNING);
                return false;
            }
            return true;
        }
        // Double check for upload end

        if (!$this->_beforeProcessUpload($model, $data, $direct)) {
            return false;
        }
        extract($this->settings[$model->name]);

        // Get file path
        $info      = pathinfo($model->data[$model->name][$fileField]['name']);
        $extension = $info['extension'];

        if (!isset($info['filename'])) {
            $info['filename'] = substr($info['basename'], 0, -strlen('.' . $extension));
        }

        $filename = $info['filename'];
        $dir      = $this->_getPath($model, $dirFormat);

        if (!$dir) {
            trigger_error(__('Couldn\'t determine or create the directory. %s', __METHOD__), E_USER_WARNING);
            return false;
        }
        $this->addReplace($model, '{$dir}', $dir);

        // Get filename
        App::import('Utility', 'Sanitize');
        $this->addReplace($model, '{$filename}', Sanitize::paranoid($filename, array('_', '-')));
        $filename                                      = $this->_getFilename($model, $fileFormat);
        $model->data[$model->name][$fileField]['name'] = $filename . '.' . $extension;

        // Create save path
        $saveAs = $dir . DS . $filename . '.' . $extension;

        // Check if file exists
        if (file_exists($baseDir . $saveAs)) {
            if ($overwriteExisting) {
                if (!unlink($baseDir . $saveAs)) {
                    trigger_error(
                        __(
                            'The file %1$s already exists and cannot be deleted. %2$s',
                            $baseDir . $saveAs,
                            __METHOD__
                        ),
                        E_USER_WARNING
                    );
                    return false;
                }
            } else {
                $count = 2;
                while (file_exists($baseDir . $dir . DS . $filename . '_' . $count . '.' . $extension)) {
                    $count++;
                }
                $model->data[$model->name][$fileField]['name'] = $filename . '_' . $count . '.' . $extension;

                $saveAs = $dir . DS . $filename . '_' . $count . '.' . $extension;
            }
        }

        // Attempt to move uploaded file
        if (!move_uploaded_file($model->data[$model->name][$fileField]['tmp_name'], $baseDir . $saveAs)) {
            trigger_error(__('Couldn\'t move the uploaded file. %s', __METHOD__), E_USER_WARNING);
            return false;
        }

        // Change uploaded file's permissions
        chmod($baseDir . $saveAs, 0777);

        // If any old file is present then delete it
        if (isset($model->data[$model->name]['old_file_name'])) {
            @unlink($baseDir . $dir . DS . $model->data[$model->name]['old_file_name']);
        }

        // Update model data
        if (!$model->hasField($dirField)) {
            //$model->data[$model->name][$fileField] = $dir . $model->data[$model->name][$fileField];
        }
        $model->data[$model->name][$dirField]  = $dir;
        $model->data[$model->name]['mimetype'] = $model->data[$model->name][$fileField]['type'];
        $model->data[$model->name]['filesize'] = $model->data[$model->name][$fileField]['size'];
        $model->data[$model->name][$fileField] = $model->data[$model->name][$fileField]['name'];
        $this->_afterProcessUpload($model, $data, $direct);
        return true;
    }//end _processUpload()


    /**
     * This action method is used to replace pseudo cosntants from given string
     *
     * @param model  $model   instance of model
     * @param string &$string string in which to replace pseudo constants
     *
     * @return string
     */
    function __replacePseudoConstants($model, &$string)
    {
        extract($this->settings[$model->name]);
        $random = uniqid(""); // generate a random var each time called.
        preg_match_all('@{\$([^{}]*)}@', $string, $r);
        foreach ($r[1] as $i => $match) {
            if (!isset($this->settings[$model->name]['pathReplacements'][$r[0][$i]])) {
                if (isset($$match)) {
                    $this->addReplace($model, $r[0][$i], $$match);
                } elseif (isset($model->data[$model->name][$match])) {
                    $this->addReplace($model, $r[0][$i], $model->data[$model->name][$match]);
                } else {
                    trigger_error(
                        __(
                            'Cannot replace %1$s as the variable $%2$s cannot be determined. %3$s',
                            $match,
                            $match,
                            __METHOD__
                        ),
                        E_USER_WARNING
                    );
                }
            }
        }
        $markers      = array_keys($this->settings[$model->name]['pathReplacements']);
        $replacements = array_values($this->settings[$model->name]['pathReplacements']);
        return str_replace($markers, $replacements, $string);
    }//end __replacePseudoConstants()


}//end class
