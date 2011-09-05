<?php
/**
 * Library class for number related data
 *
 *
 * @author Alexander 'alkemann' Morland
 *
 */
namespace dummy_data\models\lib;

class Special {

    public static function fromList($options = array()) {
        $list = isset($options['list'])&&!empty ($options['list']) ? $options['list'] : array('One','Two','Three');
        return $list[array_rand($list)];
    }
}
