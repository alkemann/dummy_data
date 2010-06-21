<?php
/**
 * Library class for United States of America related address data
 * 
 *
 * @author Caius Durling
 * @author Alexander 'alkemann' Morland
 * @modified 6. feb. 2009
 * 
 */
namespace dummy_data\models\lib;

use \dummy_data\models\Data;

class Usa  {
	
	private static $_us_states = array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','Florida','Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','NewHampshire','NewJersey','NewMexico','NewYork','NorthCarolina','NorthDakota','Ohio','Oklahoma','Oregon','Pennsylvania','RhodeIsland','SouthCarolina','SouthDakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','WestVirginia','Wisconsin','Wyoming');
	private static $_us_states_abbr = array('AL','AK','AS','AZ','AR','CA','CO','CT','DE','DC','FM','FL','GA','GU','HI','ID','IL','IN','IA','KS','KY','LA','ME','MH','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','MP','OH','OK','OR','PW','PA','PR','RI','SC','SD','TN','TX','UT','VT','VI','VA','WA','WV','WI','WY','AE','AA','AP');
	private static $_us_zipcode_formats = array( 'xxxxx', 'xxxxx-xxxx' );
	
	
	public static function us_state() {
		return Data::random( self::$_us_states );
	}
	
	public static function us_state_abbr() {
		return Data::random( self::$_us_states_abbr );
	}
	
	public static function post_code($options = array()) {
		return self::zip_code($options);
	}
	
	public static function zip_code($options = array()) {
		if (isset($options['variable'])) {
			$a = $options['variable'];
		} else {
			$a = Data::random( self::$_us_zipcode_formats );
		}
		$result = Data::generate_random_alphanumeric_str( $a );
		return $result;
	}	
}
?>
