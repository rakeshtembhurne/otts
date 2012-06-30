<?php

/**
 * Behaviror for managing slugs
 *
 * PHP version 5.3
 *
 * @category Behavior
 * @package  Behavior
 * @author   Amit Badkas <amit@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */

/**
 * Slug Behavior
 *
 * @category Model
 * @package  Model
 * @author   Amit Badkas <amit@sanisoft.com>
 * @license  http://nagpurbirds.org Private
 * @link     http://nagpurbirds.org
 */
class SlugBehavior extends ModelBehavior
{


    /**
     * Method called automatically by model's constructor
     *
     * @param model &$model   Object of model
     * @param array $settings Settings for behavior
     *
     * @return void
     */
    function setup(&$model, $settings = array())
    {
        // Initialize behavior's default settings
        $default = array(
                    'length'       => 100,
                    'slug'         => 'slug',
                    'separator'    => '-',
                    'overwrite'    => false,
                    'label'        => array('title'),
                    'noFirstIndex' => false,
                   );

        // If behavior's settings not set for given model then use default
        if (!isset($this->settings[$model->name])) {
            $this->settings[$model->name] = $default;
        }

        // If label is not set in settings as an array then set it
        if (is_array($settings) && isset($settings['label']) && !is_array($settings['label'])) {
            $settings['label'] = array($settings['label']);
        }

        // Merge behavior's default settings and model's settings
        if (is_array($settings)) {
            $this->settings[$model->name] = array_merge($this->settings[$model->name], $settings);
        }
    }//end setup()


    /**
     * Method called automatically by model's save
     *
     * @param model &$model Object of model
     *
     * @return boolean Return method's status
     */
    function beforeSave(&$model)
    {
        // Loop through labels to create slug by joining them
        foreach ($this->settings[$model->name]['label'] as $field) {
            // If model does not have field in any of labels then invalidate that field and return false
            if (!$model->hasField($field)) {
                $model->invalidate($field, __('The "' . $model->name . '" model does not contain desired field "' . $field . '" to create slug from it.', true));
                return false;
            }
        }

        // If given model not contain field to store slug then invalidate first label and return false
        if (!$model->hasField($this->settings[$model->name]['slug'])) {
            $model->invalidate(
                $this->settings[$model->name]['label'][0],
                __('The "' . $model->name . '" model does not contain desired field to store slug.', true)
            );
            return false;
        }

        // If user wants to overwrite slug (in case of photo editing)
        // or model's primary field's value is empty (in case of photo adding)
        if ($this->settings[$model->name]['overwrite'] || empty($model->{$model->primaryKey})) {
            // Initialize variable
            $label = '';

            // Loop through labels to create slug by joining them using space
            foreach ($this->settings[$model->name]['label'] as $field) {
                $label .= (!empty($label)) ? ' ' : ''; //ife(!empty($label), ' ', '');
                $label .= $model->data[$model->name][$field];
            }

            // If built label is empty then invalidate first label and return false
            if (empty($label)) {
                $model->invalidate(
                    $this->settings[$model->name]['label'][0],
                    __('Unable to create slug using given fields.', true)
                );
                return false;
            }

            // Build slug
            $slug = $this->__slug($label, $this->settings[$model->name]);

            // Initialize variable to store conditions to fetch slug like records
            $conditions['conditions'] =
                array($model->name . '.' . $this->settings[$model->name]['slug'] . ' LIKE "' . $slug . '%"');

            // If model's primary field's value is not empty then add condition to not consider its record
            if (!empty($model->{$model->primaryKey})) {
                $conditions[$model->name . '.' . $model->primaryKey] = '!= ' . $model->{$model->primaryKey};

                $conditions['fields'] = array(
                                         $model->name . '.' . $model->primaryKey,
                                         $model->name . '.' . $this->settings[$model->name]['slug'],
                                        );
            }

            $conditions['contain'] = false;
            // Find records with given conditions
            $result = $model->find('all', $conditions);

            // If any result found
            if (count($result) > 0) {
                // Initialize variable
                $slugs = array();

                // Loop through list of records to store slug in array
                foreach ($result as $data) {
                    $slugs[] = $data[$model->name][$this->settings[$model->name]['slug']];
                }
            }

            // If any slugs found
            if (!$this->settings[$model->name]['overwrite'] && isset($slugs) && count($slugs) > 0) {
                // Initialize variables
                $index         = 1;
                $begginingSlug = $slug;

                // Run loop till index variable's value is greater than zero
                while ($index > 0) {
                    if ($this->settings[$model->name]['noFirstIndex'] == true && $index == 1) {
                        $newSlug = $begginingSlug;
                    } else {
                        $newSlug = $begginingSlug . $this->settings[$model->name]['separator'] . $index;
                    }

                    // If new slug is not already in use then use it
                    if (!in_array($newSlug, $slugs)) {
                        $slug  = $newSlug;
                        $index = -1;
                    }

                    // Increment index variable by one
                    $index++;
                }
            }

            // Store slug in data
            $model->data[$model->name][$this->settings[$model->name]['slug']] = $slug;
        }

        // By default return true
        return true;
    }//end beforeSave()


    /**
     * Method used to build slug
     *
     * @param string $string   Slug
     * @param array  $settings Settings for behavior for current model
     *
     * @return string Slug
     */
    function __slug($string, $settings)
    {
        // Make string lowercase
        $string = strtolower($string);

        // Remove non-alphanumeric characters from string
        $string = preg_replace('/[^a-z0-9' . $settings['separator'] . ']/i', $settings['separator'], $string);
        // FIXME: following line shows error when using empty string as separator.
        //$string = preg_replace(
        //    '/' . $settings['separator'] . '[' . $settings['separator'] . ']*/',
        //    $settings['separator'],
        //    $string
        //);

        // If string's length is more than length given in settings then trim string
        if (strlen($string) > $settings['length']) {
            $string = substr($string, 0, $settings['length']);
        }

        // Remove separator if it comes at the start/end of string
        $string = preg_replace('/' . $settings['separator'] . '$/', '', $string);
        $string = preg_replace('/^' . $settings['separator'] . '/', '', $string);

        // Return manipulated string
        return $string;
    }//end __slug()


}//end class
