<?php
/**
 * Library class for dummy texts in english
 *
 * @author Alexander 'alkemann' Morland
 * @modified 6. feb. 2009
 *
 */

namespace dummy_data\models\lib;

use \dummy_data\models\lib\Dummy;

class English {

	public function __construct() {
	}

	public static function city($options = array()) {
		$cities = Dummy::get_cities();
		return $cities[rand(0, count($cities) - 1)];
	}

	public static function color($options = array()) {
		$colors = Dummy::get_colors();
		return $colors[rand(0, count($colors) - 1)];
	}
	public static function title($options = array()) {
		$max = (isset($options['max'])) ? $options['max'] : 255;
		$nouns = Dummy::getNouns();
		$noun = $nouns[rand(0, count($nouns) - 1)];
		if ($max < 10) {
			return ucfirst($noun);
		}
		$adjectives = Dummy::getAdjectives();
		$adj_count = count($adjectives);
		$adj = $adjectives[rand(0, $adj_count - 1)];
		$adj = ucfirst($adj);
		if ($max < 25) {
			return $adj . ' ' . $noun;
		}
		if ($max > 150 && rand(0, 2) == 1) {
			$adj2 = $adjectives[rand(0, $adj_count - 1)];
			$adj .= ' ' . $adj2;
		}

		if ($max > 200 && rand(0, 4) == 1) {
			$adj2 = $adjectives[rand(0, $adj_count - 1)];
			$adj .= ' ' . $adj2;
		}
		return $adj . ' ' . $noun;
	}

	public static function noun($options = array()) {
		$nouns = Dummy::getNouns();
		$noun = $nouns[rand(0, count($nouns) - 1)];
		return ucfirst($noun);
	}

	public static function verb($options = array()) {
		$verbs = Dummy::getVerbs();
		$verb = $verbs[rand(0, count($verbs) - 1)];
		return $verb;
	}

	public static function quote($options = array()) {
		$quotes = Dummy::getQuotes();
		return $quotes[rand(0, count($quotes) - 1)];
	}

	public static function extension($options = array()) {
		$extensions = Dummy::get_file_extension();
		$extension = $extensions[rand(0, count($extensions) - 1)];
		return $extension;
	}

	public static function filename($options = array()) {
		$extensions = Dummy::get_file_extension();
		$extension = $extensions[rand(0, count($extensions) - 1)];
		return strtolower(self::noun($options) . '.' . self::extension($options));
	}

	public static function gender($options = array()) {
		$genders = array('male','female','undisclosed');
		return $genders[round(rand(0,2))];
	}

}
