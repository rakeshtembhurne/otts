<?php

/**
 * Behavior to handle image resizing.
 *
 * PHP version 5
 *
 * @category Behavior
 * @package  Behavior
 * @author   Rakesh Tembhurne <rakesh@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */
// Include upload behavior's class file
if (!class_exists('UploadBehavior')) {
    App::import('Behavior', 'Upload');
}

/**
 * Image Upload behavior class class.
 *
 * @category Behavior
 * @package  Behavior
 * @author   Rakesh Tembhurne <rakesh@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */
class ImageUploadBehavior extends UploadBehavior
{


    /**
     * This method initiate Image Upload behavior by setting configuration options.
     *
     * @param Model &$model instance of model
     * @param array $config array of configuration settings.
     *
     * @return void
     */
    function setup(&$model, $config=array())
    {
        // Sets default mime types and extensions for images
        $this->__defaultSettings['allowedMime'] = array(
                                                   'image/jpeg',
                                                   'image/pjpeg',
                                                   'image/gif',
                                                   'image/png',
                                                   'image/x-png',
                                                   'image/bmp',
                                                  );
        $this->__defaultSettings['allowedExt']  = array(
                                                   'jpeg',
                                                   'jpg',
                                                   'gif',
                                                   'png',
                                                   'bmp',
                                                  );

        // Calls parent class's setup method.
        parent::setup($model, $config);
    }//end setup()


    /**
     * This callback method is called after processing the image upload.
     *
     * @param Model   &$model instance of model
     * @param array   $data   data to be uploaded
     * @param boolean $direct allows direct upload
     *
     * @return boolean
     */
    function _afterProcessUpload(&$model, $data, $direct)
    {
        // If any old file is present then delete its resized images
        if (isset($model->data[$model->name]['old_file_name'])) {
            $this->deleteResized($model, $model->data[$model->name]['old_file_name']);
        }

        return true;
    }//end _afterProcessUpload()


    /**
     * This callback method is called before processing the image upload.
     *
     * @param Model   &$model instance of model
     * @param array   $data   data to be uploaded
     * @param boolean $direct allows direct upload
     *
     * @return boolean
     */
    function _beforeProcessUpload(&$model, $data, $direct)
    {
        return true;
    }//end _beforeProcessUpload()


    /**
     * This method resizes the image with given id and other parameters.
     *
     * @param Model   &$model  instance of model
     * @param Integer $id      image id
     * @param Integer $width   image width
     * @param Integer $height  image height
     * @param string  $writeTo path to which keep resized image
     * @param string  $aspect  aspect of resize
     *
     * @return type
     */
    function resize(&$model, $id=null, $width = 600, $height = 400, $writeTo = false, $aspect = true)
    {
        // Sets model id
        if ($id === null && $model->id) {
            $id = $model->id;
        } elseif (!$id) {
            $id = null;
        }

        // Extacts settings
        extract($this->settings[$model->name]);

        // Gets image data if id was set.
        $readResult = $model->read(array($fileField, $dirField), $id);
        extract($readResult[$model->name]);

        // Gets full path of image and calls method for resizing
        $fullPath = $baseDir . $$dirField . DS . $$fileField;
        return $this->resizeFile($model, $fullPath, $width, $height, $writeTo, $aspect);
    }//end resize()


    /**
     * This method resizes image with given image path and other parameters.
     *
     * @param model   &$model   instance of model
     * @param string  $fullpath full path of image
     * @param integer $width    image width
     * @param integer $height   image height
     * @param string  $writeTo  path to which image is resized, boolean false if none
     * @param string  $aspect   resizing aspect
     *
     * @return boolean
     */
    function resizeFile(&$model, $fullpath, $width = 600, $height = 400, $writeTo = false, $aspect = true)
    {
        if (!$width && !$height) {
            return false;
        }
        extract($this->settings[$model->name]);
        if (!($size = getimagesize($fullpath))) {
            return false; // image doesn't exist
        }
        list($currentWidth, $currentHeight, $currentType) = $size;

        // By default don't crop image
        $clipX = $clipY = 0;

        // adjust to aspect.
        if (false !== $aspect) {
            // Resize by height
            if ('h' == $aspect) {
                $ratio = ($currentHeight / $height);
                // Resize proportionally
            } else if ('p' == $aspect) {
                $ratio = (max($currentWidth, $currentHeight) / $width);
                // Resize/crop to square
            } else if ('s' == $aspect) {
                $ratio = (min($currentWidth, $currentHeight) / $width);
                // Resize by width
            } else if ('w' == $aspect) {
                $ratio = ($currentWidth / $width);
            }
            // By default ratio must be greater than 1
            $ratio = max($ratio, 1);

            // If aspect is square/crop
            if ('s' == $aspect) {
                // New height/width
                $height = $width = (int) (min($currentWidth, $currentHeight) / $ratio);

                // If current height is greater than current width then change Y-side crop and current height
                if ($currentHeight > $currentWidth) {
                    $clipY         = (int) (($currentHeight - $currentWidth) / 2);
                    $currentHeight = $currentWidth;
                    // If current width is greater than current height then change X-side crop and
                    // current width
                } else if ($currentWidth > $currentHeight) {
                    $clipX        = (int) (($currentWidth - $currentHeight) / 2);
                    $currentWidth = $currentHeight;
                }
                // If aspect is not square/crop then build width/height
            } else {
                $width  = (int) ($currentWidth / $ratio);
                $height = (int) ($currentHeight / $ratio);
            }
            // If don't need to consider aspect and new width is greater than original width or height is
            // greater than original height then use respective original dimensions
        } else {
            if ($width > $currentWidth) {
                $width = $currentWidth;
            }
            if ($height > $currentHeight) {
                $height = $currentHeight;
            }
        }

        App::import('Utility', 'File');

        // If both width and height are same as current width and current height
        if ($width == $currentWidth && $height == $currentHeight) {
            if ($writeTo) {
                new File($writeTo, true, 0777);
                $return = copy($fullpath, $writeTo);
            } else {
                $return = file_get_contents($fullpath);
            }
        } else {
            $types = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp");
            $image = call_user_func('imagecreatefrom' . $types[$currentType], $fullpath);

            if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor($width, $height))) {
                imagecopyresampled(
                    $temp,
                    $image,
                    0,
                    0,
                    $clipX,
                    $clipY,
                    $width,
                    $height,
                    $currentWidth,
                    $currentHeight
                );
            } else {
                $temp = imagecreate($width, $height);
                imagecopyresized(
                    $temp,
                    $image,
                    0,
                    0,
                    $clipX,
                    $clipY,
                    $width,
                    $height,
                    $currentWidth,
                    $currentHeight
                );
            }
            $return = false;
            if ($writeTo) {
                new File($writeTo, true);
                if ('jpeg' == $types[$currentType]) {
                    $return = call_user_func("image" . $types[$currentType], $temp, $writeTo, 100);
                } else {
                    $return = call_user_func("image" . $types[$currentType], $temp, $writeTo);
                }
            } else {
                ob_start();

                if ('jpeg' == $types[$currentType]) {
                    call_user_func("image" . $types[$currentType], $temp, null, 100);
                } else {
                    call_user_func("image" . $types[$currentType], $temp);
                }
                $return = ob_get_clean();
            }
            imagedestroy($image);
            imagedestroy($temp);
        }
        return $return;
    }//end resizeFile()


    /**
     * This method deletes resized copies of image with given filename.
     *
     * @param model  &$model   instance of model
     * @param string $filename name of the file
     *
     * @return void
     */
    function deleteResized(&$model, $filename)
    {
        // Behavior settings for current model
        $settings = $this->settings[$model->name];

        // Base directory
        $baseDirectory = $settings['baseDir'] . $settings['dirFormat'] . DS;

        // Create folder object using base directory
        $folderObject = new Folder($baseDirectory);

        // Read contents in base directory
        $directoryContents = $folderObject->read(true, true);

        // Loop through directories in base directory
        foreach ($directoryContents[0] as $directoryName) {
            // Full path for file to delete
            $filepath = $baseDirectory . $directoryName . DS . $filename;

            // If file exists then delete it
            if (is_file($filepath)) {
                unlink($filepath);
            }
        }
    }//end deleteResized()


    /**
     * This callback method is called before deleting the image.
     *
     * @param model &$model instance of model
     *
     * @return boolean
     */
    function beforeDelete(&$model)
    {
        // Behavior settings for current model
        $settings = $this->settings[$model->name];

        // No need to proceed further if behavior is disabled
        if (!$settings['enabled']) {
            return true;
        }

        // Delete main image
        if (!parent::beforeDelete($model)) {
            return false;
        }

        // Name of image file
        $filename = (string) $model->data[$model->name][$settings['fileField']];

        // Delete re-sized images
        if ($filename) {
            $this->deleteResized($model, $filename);
        }

        // By default return true
        return true;
    }//end beforeDelete()


    /**
     * This callback method is called after saving the image.
     *
     * @param model &$model  instance of model
     * @param array $created data
     *
     * @return boolean
     */
    function afterSave(&$model, $created)
    {
        // Behavior settings for current model
        $settings = $this->settings[$model->name];

        // No need to proceed further if behavior is disabled
        if (!$settings['enabled']) {
            return;
        }

        parent::afterSave($model, $created);
        /*$modelName = $model->name;
        switch ($modelName) {
            case 'Picture':
                $this->__resizeImagesAfterUpload(
                    array('75:h'),
                    $model, $model->data[$modelName]['filename'],
                    $model->data[$modelName]['dir']
                );
                break;
        }*/
    }//end afterSave()


    /**
     * Method used to resize images just after saving record
     *
     * @param array  $resizedFolders Array containing resized folder names
     * @param obj    &$model         Model's object
     * @param string $filename       Name of the file to be resized
     * @param string $dir            Directory where image is stored
     * @param string $defaultDir     Default directory
     *
     * @return void
     */
    function __resizeImagesAfterUpload($resizedFolders, &$model, $filename, $dir, $defaultDir = 'files')
    {
        // Loop over resized folders
        foreach ($resizedFolders as $resizedFolder) {
            // Get image attributes
            list($height, $width, $aspect) = $this->__getImageAttributes($resizedFolder);

            // Build filepath and file name
            $filepath = WWW_ROOT . $defaultDir . DS . $dir . DS;
            $resized  = $filepath . $resizedFolder . DS . $filename;

            // original image
            $original = $filepath . $filename;

            // Resize image
            $this->resizeFile($model, $original, $width, $height, $resized, $aspect);
        }
    }//end __resizeImagesAfterUpload()


    /**
     * Method used to set Image Attributs
     *
     * @param int &$size resize value
     *
     * @return array $imageAttributes array of imageAttributes
     */
    function __getImageAttributes(&$size)
    {
        // $size = 100; (Proportional - 100 as height or width whichever is longer)
        if (ereg('^([1-9]+[0-9]*)$', $size)) {
            $aspect = 'p';
            $height = $width = $size;
        } else if (ereg('^([1-9]+[0-9]*:[h|s|w]+)$', $size)) {
            /**
             * $size = 100:h; (Proportional - 100 as height)
             * $size = 100:s; (Square/crop - 100 as height and width)
             * $size = 100:w; (Proportional - 100 as width)
             */
            list($dimension, $aspect) = explode(':', $size);
            $height                   = (('w' == $aspect) ? 0 : $dimension);
            $width                    = (('h' == $aspect) ? 0 : $dimension);
            // $size = 100x150; (Exact [not proportional and no cropping] - 100 as width and 150 as height)
        } else if (ereg('^([1-9]+[0-9]*x[1-9]+[0-9]*)$', $size)) {
            list($width, $height) = explode('x', $size);
            $aspect               = false;
        } else {
            // By default unset size
            unset($size);
        }

        return array(
                $height,
                $width,
                $aspect,
               );
    }//end __getImageAttributes()


}//end class
