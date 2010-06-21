<?php
/**
 * Library class for united kingdom related address data
 * 
 *
 * @author Caius Durling
 * @author Alexander 'alkemann' Morland
 * @modified 6. feb. 2009
 * 
 */
namespace dummy_data\models\lib;

use \dummy_data\models\Data;

class Uk extends \dummy_data\models\lib\Address {
	
	private static $_uk_counties = array('Avon','Bedfordshire','Berkshire','Borders','Buckinghamshire','Cambridgeshire','Central','Cheshire','Cleveland','Clwyd','Cornwall','CountyAntrim','CountyArmagh','CountyDown','CountyFermanagh','CountyLondonderry','CountyTyrone','Cumbria','Derbyshire','Devon','Dorset','DumfriesandGalloway','Durham','Dyfed','EastSussex','Essex','Fife','Gloucestershire','Grampian','GreaterManchester','Gwent','GwyneddCounty','Hampshire','Herefordshire','Hertfordshire','HighlandsandIslands','Humberside','IsleofWight','Kent','Lancashire','Leicestershire','Lincolnshire','Lothian','Merseyside','MidGlamorgan','Norfolk','NorthYorkshire','Northamptonshire','Northumberland','Nottinghamshire','Oxfordshire','Powys','Rutland','Shropshire','Somerset','SouthGlamorgan','SouthYorkshire','Staffordshire','Strathclyde','Suffolk','Surrey','Tayside','TyneandWear','Warwickshire','WestGlamorgan','WestMidlands','WestSussex','WestYorkshire','Wiltshire','Worcestershire');
	private static $_uk_countries = array('England', 'Scotland','Wales', 'Northern Ireland');
	private static $_uk_postcode_formats = array( 'LLxx xLL', 'LLx xLL' );
		
	
	public static function uk_county()
	{
		return Data::random( self::$_uk_counties );
	}
	
	public static function uk_country()
	{
		return Data::random( self::$_uk_countries );
	}
	
	public static function post_code($options = array()) {
		if (isset($options['variable'])) {
			$a = $options['variable'];
		} else {
			$a = Data::random( self::$_uk_postcode_formats );
		}
		$result = Data::generate_random_alphanumeric_str( $a );
		return strtoupper($result);
	}		
}
?>
