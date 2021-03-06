<?php
/**
 * Library class for company related texts
 * 
 *
 * @author Caius Durling
 * 
 */
namespace dummy_data\models\lib;

use \dummy_data\models\Data;

class Company {
	/**
	 * Do nothing on being created
	 *
	 * @return void
	 * @author Caius Durling
	 */
	
	private static $_catch_phrase_words = array(array("Adaptive","Advanced","Ameliorated","Assimilated","Automated","Balanced","Business-focused","Centralized","Cloned","Compatible","Configurable","Cross-group","Cross-platform","Customer-focused","Customizable","Decentralized","De-engineered","Devolved","Digitized","Distributed","Diverse","Down-sized","Enhanced","Enterprise-wide","Ergonomic","Exclusive","Expanded","Extended","Facetoface","Focused","Front-line","Fully-configurable","Function-based","Fundamental","Future-proofed","Grass-roots","Horizontal","Implemented","Innovative","Integrated","Intuitive","Inverse","Managed","Mandatory","Monitored","Multi-channelled","Multi-lateral","Multi-layered","Multi-tiered","Networked","Object-based","Open-architected","Open-source","Operative","Optimized","Optional","Organic","Organized","Persevering","Persistent","Phased","Polarised","Pre-emptive","Proactive","Profit-focused","Profound","Programmable","Progressive","Public-key","Quality-focused","Reactive","Realigned","Re-contextualized","Re-engineered","Reduced","Reverse-engineered","Right-sized","Robust","Seamless","Secured","Self-enabling","Sharable","Stand-alone","Streamlined","Switchable","Synchronised","Synergistic","Synergized","Team-oriented","Total","Triple-buffered","Universal","Up-sized","Upgradable","User-centric","User-friendly","Versatile","Virtual","Visionary","Vision-oriented"),array("24hour","24/7","3rdgeneration","4thgeneration","5thgeneration","6thgeneration","actuating","analyzing","assymetric","asynchronous","attitude-oriented","background","bandwidth-monitored","bi-directional","bifurcated","bottom-line","clear-thinking","client-driven","client-server","coherent","cohesive","composite","context-sensitive","contextually-based","content-based","dedicated","demand-driven","didactic","directional","discrete","disintermediate","dynamic","eco-centric","empowering","encompassing","even-keeled","executive","explicit","exuding","fault-tolerant","foreground","fresh-thinking","full-range","global","grid-enabled","heuristic","high-level","holistic","homogeneous","human-resource","hybrid","impactful","incremental","intangible","interactive","intermediate","leadingedge","local","logistical","maximized","methodical","mission-critical","mobile","modular","motivating","multimedia","multi-state","multi-tasking","national","needs-based","neutral","nextgeneration","non-volatile","object-oriented","optimal","optimizing","radical","real-time","reciprocal","regional","responsive","scalable","secondary","solution-oriented","stable","static","systematic","systemic","system-worthy","tangible","tertiary","transitional","uniform","upward-trending","user-facing","value-added","web-enabled","well-modulated","zeroadministration","zerodefect","zerotolerance"),array("ability","access","adapter","algorithm","alliance","analyzer","application","approach","architecture","archive","artificialintelligence","array","attitude","benchmark","budgetarymanagement","capability","capacity","challenge","circuit","collaboration","complexity","concept","conglomeration","contingency","core","customerloyalty","database","data-warehouse","definition","emulation","encoding","encryption","extranet","firmware","flexibility","focusgroup","forecast","frame","framework","function","functionalities","GraphicInterface","groupware","GraphicalUserInterface","hardware","help-desk","hierarchy","hub","implementation","info-mediaries","infrastructure","initiative","installation","instructionset","interface","internetsolution","intranet","knowledgeuser","knowledgebase","localareanetwork","leverage","matrices","matrix","methodology","middleware","migration","model","moderator","monitoring","moratorium","neural-net","openarchitecture","opensystem","orchestration","paradigm","parallelism","policy","portal","pricingstructure","processimprovement","product","productivity","project","projection","protocol","securedline","service-desk","software","solution","standardization","strategy","structure","success","superstructure","support","synergy","systemengine","task-force","throughput","time-frame","toolset","utilisation","website","workforce"));
	
	private static $_bs_words = array(array("implement","utilize","integrate","streamline","optimize","evolve","transform","embrace","enable","orchestrate","leverage","reinvent","aggregate","architect","enhance","incentivize","morph","empower","envisioneer","monetize","harness","facilitate","seize","disintermediate","synergize","strategize","deploy","brand","grow","target","syndicate","synthesize","deliver","mesh","incubate","engage","maximize","benchmark","expedite","reintermediate","whiteboard","visualize","repurpose","innovate","scale","unleash","drive","extend","engineer","revolutionize","generate","exploit","transition","e-enable","iterate","cultivate","matrix","productize","redefine","recontextualize"),array("clicks-and-mortar","value-added","vertical","proactive","robust","revolutionary","scalable","leading-edge","innovative","intuitive","strategic","e-business","mission-critical","sticky","one-to-one","24/7","end-to-end","global","B2B","B2C","granular","frictionless","virtual","viral","dynamic","24/365","best-of-breed","killer","magnetic","bleeding-edge","web-enabled","interactive","dot-com","sexy","back-end","real-time","efficient","front-end","distributed","seamless","extensible","turn-key","world-class","open-source","cross-platform","cross-media","synergistic","bricks-and-clicks","out-of-the-box","enterprise","integrated","impactful","wireless","transparent","next-generation","cutting-edge","user-centric","visionary","customized","ubiquitous","plug-and-play","collaborative","compelling","holistic","rich"),array("synergies","web-readiness","paradigms","markets","partnerships","infrastructures","platforms","initiatives","channels","eyeballs","communities","ROI","solutions","e-tailers","e-services","action-items","portals","niches","technologies","content","vortals","supply-chains","convergence","relationships","architectures","interfaces","e-markets","e-commerce","systems","bandwidth","infomediaries","models","mindshare","deliverables","users","schemas","networks","applications","metrics","e-business","functionalities","experiences","webservices","methodologies"));
	private static $_suffix = array('Inc','andSons','LLC','Group','PLC','Ltd');
	private static $_name_formats = array(array('surname','','surname'),array('surname','-','surname'),array('surname','','surname','and','surname'));
	
	public static function name()	{
		
		
		foreach ( Data::random( self::$_name_formats ) as $elem ) {
			$result[] = $elem;
			// And now replace it if it needs it
			if ( $elem == 'surname' ) {
				$result[ count($result) - 1 ] = \dummy_data\models\lib\Name::surname();
			}
		}
		return join( $result );
	}
	
	public static function suffix()	{
		return Data::random( self::$_suffix );
	}
	
	public static function catch_phrase() {
		foreach (self::$_catch_phrase_words as &$word) {
			$result[] = Data::random( $word );
		}
		return join( $result, " " );
	}
	
	public static function bs()	{
		foreach (self::$_bs_words as &$word) {
			$result[] = Data::random( $word );
		}
		return join( $result, " " );
	}
	
}

?>
