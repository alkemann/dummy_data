<?php
/**
 * Data hub for the generation
 */

namespace dummy_data\models;

#use ;

/**
 *  This file is based upon the PhpFaker by Caius Durling
 * 
 * 
 * @license MIT
 * @author Caius Durling
 * @author Alexander 'alkemann' Morland
 * @version 2.0
 * @modified 20 june 2009
 */
class Data { 
	
	/**
	 * List of current generator classes.
	 * Expand this list when creating new classes. 
	 * Classes added here should be iincluded in one 
	 * of the tree list[Type]Generator methods bellow.
	 *
	 * @var array
	 * @access private
	 * @author Alexander Morland
	 */
	private static $generator_classes = array(
		'Address' => array(		
			'Uk',
			'Usa'
		),
		'Company' => array(),
		'English' => array(),
		'Name' => array(),
		'Number' => array(),
		'Time' => array(),
		'Web' => array()
	);

	/**
	 * Accesses the specified generator method and returns the random value
	 *
	 * @author Alexander Morland
	 * @param string $class
	 * @param string $method
	 * @param array $options
	 * @return mixed
	 */
	public static function generate($class, $method, $options = array()) {
		$class = '\\dummy_data\\models\\lib\\'.$class;
		return $class::$method($options);
	}
	
	/**
	 * Returns array of all current generator classes
	 * If a $recursive value of FALSE is used, only first
	 * level classes will be returned.
	 *
	 * @author Alexander Morland
	 * @param boolean $recursive
	 * @return array
	 */
	public static function listClasses($recursive = true) {
		$ret = array();
		if ($recursive) {
			$ret =& self::$generator_classes;
		} else {
			$ret = array_keys(self::$generator_classes);
		}		
		return $ret;
	}

	public static function listGenerators() {
		return ((array) static::listStringGenerators()) +
			((array) static::listTimeGenerators()) +
			((array) static::listNumberGenerators());
	}

	/**
	 * Returns array list of all generators in the specified class
	 *
	 * @author Alexander Morland
	 * @param string $class
	 * @return array
	 */
	public static function listMethods($class) {
		$methods = get_class_methods('\\dummy_data\\models\\lib\\'.$class);
		$ret = array();
		foreach ($methods as $one) {
			if (substr($one,0,2) != '__' && substr($one,0,8) != 'generate') {
				$ret[$class.'->'.$one] = $one;
			}
		}
		return $ret;
	}
	
	/**
	 * Returns list of all Number related generators, 
	 * grouped by class. Only Number class exist at this time.
	 *
	 * @author Alexander Morland
	 * @return array
	 */
	public static function listNumberGenerators() {
		return array(
			'Number' => self::listMethods('Number')
		);
	}
	
	/**
	 * Returns list of all date and time related generators, 
	 * grouped by class. Only Time class exist at this time.
	 *
	 * @author Alexander Morland
	 * @return array
	 */
	public static function listTimeGenerators() {
		return array('Time' => self::listMethods('Time') );
	}
	
	/**
	 * Returns list of all string related generators, 
	 * grouped by class. 
	 *
	 * @author Alexander Morland
	 * @return array
	 */
	public static function listStringGenerators() {
		$ret = array(
			'Name' => self::listMethods('Name'),
			'English' => self::listMethods('English'),
			'Web' => self::listMethods('Web'),
			'Company' => self::listMethods('Company'),
			'Address' => self::listMethods('Address'),
			'Uk' => self::listMethods('Uk'),
			'Usa' => self::listMethods('Usa'),
			'Lorem' => self::listMethods('Lorem')
		);
		return $ret;
	}

	/**
	 * Returns list of generator classes that extend the given class
	 *
	 * @example $address_classes = DummyWrapper::listSubClasses('Address');
	 * @param string $class
	 * @return array
	 */
	public static function listSubClasses($class) {
		return self::$generator_classes[$class];
	}
	
	/**
	 * Returns a random element from a passed array
	 *
	 * @param array $array 
	 * @return string
	 * @author Caius Durling
	 */	
	public static function random(&$array) {
		return $array[mt_rand(0, count($array)-1)];
	}
	
	/**
	 * Returns a random number between 0 and 9
	 *
	 * @return integer
	 * @author Caius Durling
	 */
	public static function rand_num() {
		return mt_rand(0, 9);
	}
	
	/**
	 * Returns a random letter from a to z
	 *
	 * @return string
	 * @author Caius Durling
	 */
	public static function rand_letter() {
		return chr(mt_rand(97, 122));
	}

	public static function generate_random_num_str($str) {
		// loop through each character and convert all unescaped X's to 1-9 and 
		// unescaped x's to 0-9.
		$new_str = "";
		for ($i = 0; $i < strlen($str); $i++) {
			if ($str[$i] == '\\' && ($str[$i + 1] == "X" || $str[$i + 1] == "x"))
				continue;
			else if ($str[$i] == "X") {
				if ($i != 0 && ($str[$i - 1] == '\\'))
					$new_str .= "X";
				else
					$new_str .= rand(1, 9);
			} else if ($str[$i] == "x")
				if ($i != 0 && ($str[$i - 1] == '\\'))
					$new_str .= "x";
				else
					$new_str .= rand(0, 9);
			else
				$new_str .= $str[$i];
		}
		
		return trim($new_str);
	}
	
	public static function generate_random_alphanumeric_str($str) {
		$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$consonants = "BCDFGHJKLMNPQRSTVWXYZ";
		$vowels = "AEIOU";
		
		// loop through each character and convert all unescaped X's to 1-9 and 
		// unescaped x's to 0-9.
		$new_str = "";
		for ($i = 0; $i < strlen($str); $i++) {
			switch ($str[$i]){
				// Numbers
				case "X":
					$new_str .= rand(1, 9);
				break;
				case "x":
					$new_str .= rand(0, 9);
				break;
				
				// Letters
				case "L":
					$new_str .= $letters[rand(0, strlen($letters) - 1)];
				break;
				case "l":
					$new_str .= strtolower($letters[rand(0, strlen($letters) - 1)]);
				break;
				case "D":
					$bool = rand() & 1;
					if ($bool)
						$new_str .= $letters[rand(0, strlen($letters) - 1)];
					else
						$new_str .= strtolower($letters[rand(0, strlen($letters) - 1)]);
				break;
				
				// Consonants
				case "C":
					$new_str .= $consonants[rand(0, strlen($consonants) - 1)];
				break;
				case "c":
					$new_str .= strtolower($consonants[rand(0, strlen($consonants) - 1)]);
				break;
				case "E":
					$bool = rand() & 1;
					if ($bool)
						$new_str .= $consonants[rand(0, strlen($consonants) - 1)];
					else
						$new_str .= strtolower($consonants[rand(0, strlen($consonants) - 1)]);
				break;
				
				// Vowels
				case "V":
					$new_str .= $vowels[rand(0, strlen($vowels) - 1)];
				break;
				case "v":
					$new_str .= strtolower($vowels[rand(0, strlen($vowels) - 1)]);
				break;
				case "F":
					$bool = rand() & 1;
					if ($bool)
						$new_str .= $vowels[rand(0, strlen($vowels) - 1)];
					else
						$new_str .= strtolower($vowels[rand(0, strlen($vowels) - 1)]);
				break;
				
				default:
					$new_str .= $str[$i];
				break;
			}
		}
		
		return trim($new_str);
	}	
}
