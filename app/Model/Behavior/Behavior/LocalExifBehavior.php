<?php

/**
 * File used as exif behavior
 *
 * Contains code needed mainly for exif behavior
 *
 * @author Amit Badkas <amit@sanisoft.com>
 * @version 1.0
 * @package CheeseCake2
 */

// Include sanitize library class file and exif vendor class file
App::uses('Sanitize', 'Utility');
App::import('Vendor', 'exif/exif');

/**
 * Exif behavior
 *
 * @author Amit Badkas <amit@sanisoft.com>
 * @version 1.0
 * @package CheeseCake2
 */
class LocalExifBehavior extends ModelBehavior
{

    /**
     * Method called automatically by model's constructor
     *
     * @param object $model    Object of model
     * @param array  $settings Settings for behavior
     *
     * @return void
     */
    function setup(Model $Model, $settings) {
        if (!isset($this->settings[$Model->alias])) {
            $this->settings[$Model->alias] = array(
                'exifField'           => null,     // db table field where to store exif data
                'filename'            => 'filename', // filename of the file being uploaded
                'path'                => 'img'.DS.'photos'.DS, // path where above file is stored
                'exifDateField'       => null, // exif date fieldname, if want to saveto db table
                'exifDateFormat'      => 'Y-m-d H:i:s', // PHP's date() format of exif date
                'gpsLattitudeField'   => null, // field name if want to store GPS lattitude
                'gpsLongitudeField'   => null, // field name if want to store GPS longitude
            );
        }
        $this->settings[$Model->alias] = array_merge(
            $this->settings[$Model->alias], (array)$settings);
    }


    /**
     * This callback method extract exif data from image and sets fields as customized in settings.
     *
     * @param  Model   $model Object of model
     *
     * @return boolean Return method's status
     */
    function beforeValidate(&$model)
    {
        // If photo is uploaded
        if (isset($model->data[$model->name][$this->settings[$model->name]['filename']]) && 0 == $model->data[$model->name][$this->settings[$model->name]['filename']]['error'])
        {
            // Name of image file
            //$filename = $model->data[$model->name][$this->settings[$model->name]['filename']]['tmp_name'];
            $filename = WWW_ROOT . 'files'. DS .'pictures' . DS . $model->data[$model->name][$this->settings[$model->name]['filename']];

            // Read exif data from file
            $exif = read_exif_data_raw($filename, 0);
            // If exif data contains maker note then set it empty
            if (isset($exif['SubIFD']['MakerNote']))
            {
                $exif['SubIFD']['MakerNote'] = '';
            }

            // Create new sanitize object and clean exif data
            Sanitize::clean($exif);

            if (isset($exif['SubIFD']['DateTimeOriginal']) && isset($this->settings[$model->name]['exifDateField']))
            {
                $model->data[$model->name][$this->settings[$model->name]['exifDateField']]
                    = date(
                          $this->settings[$model->name]['exifDateFormat'],
                          strtotime($exif['SubIFD']['DateTimeOriginal'])
                      );
            }

            // If the GPS Latitude and Longitude is set then add to proper fields
            if (isset($exif['GPS'])) {
                if (isset($this->settings[$model->name]['gpsLattitudeField'])) {
                    $model->data[$model->name][$this->settings[$model->name]['gpsLattitudeField']]
                        = $exif['GPS']['Latitude'];
                }

                if (isset($this->settings[$model->name]['gpsLattitudeField'])) {
                    $model->data[$model->name][$this->settings[$model->name]['gpsLongitudeField']]
                        = $exif['GPS']['Longitude'];
                }
            }

            // Store serialized exif data in model's data
            if (isset($this->settings[$model->name]['exifField'])) {
                $model->data[$model->name][$this->settings[$model->name]['exifField']]
                    = serialize($exif);
            }
        }

        return true;
    }//end beforeSave()


}//end class
