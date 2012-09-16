<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 *
 * The TYPOlight webCMS is an accessible web content management system that 
 * specializes in accessibility and generates W3C-compliant HTML code. It 
 * provides a wide range of functionality to develop professional websites 
 * including a built-in search engine, form generator, file and user manager, 
 * CSS engine, multi-language support and many more. For more information and 
 * additional TYPOlight applications like the TYPOlight MVC Framework please 
 * visit the project website http://www.typolight.org.
 * 
 * The Catalog extension allows the creation of multiple catalogs of custom items,
 * each with its own unique set of selectable field types, with field extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the 
 * data in each catalog.
 * 
 * PHP version 5
 * @copyright  DMA - Dialog und Medien Agentur 2012
 * @author     Janosch Skuplik <skuplik@dma.do>
 * @package    dmaCatalogRadiussearch
 * @license    LGPL
 * @filesource
 */

class ModuleDMACatalogRadiussearchList extends ModuleCatalogList
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_cataloglist';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### DMA CATALOGRADIUS LIST ###';

			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		// Fallback template
		if (!strlen($this->catalog_layout))
			$this->catalog_layout = $this->strTemplate;

		$this->strTemplate = $this->catalog_layout;

		$this->catalog_visible = deserialize($this->catalog_visible);

		return parent::generate();
	}
	
	
	
	protected function compile()
	{
		
		// try to get location, if lat/lng isn't set
		if (!$this->Input->get('latitude') || !$this->Input->get('longitude') && $this->Input->get('location'))
		{
			$getLocation = $this->formatAddress($this->Input->get('location'));
			$gmapUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $getLocation . '&sensor=true';
			$gmapResponse = @file_get_contents($gmapUrl);
      		if ($gmapResponse)
			{
				$geocodeObject = json_decode($gmapResponse);
				if ($geocodeObject->status == 'OK')
				{

         			if ($geocodeObject->results[0]->geometry->location->lat && $geocodeObject->results[0]->geometry->location->lng)
					{
						$this->Input->setGet('latitude',$geocodeObject->results[0]->geometry->location->lat);
						$this->Input->setGet('longitude',$geocodeObject->results[0]->geometry->location->lng);
					}
				}
			}
		}
		
		
		if ($this->Input->get('latitude') && $this->Input->get('longitude'))
		{
			$getLat = $this->Input->get('latitude');
			$getLng = $this->Input->get('longitude');
		
			$this->catalog_order = '(6378.388 * acos(sin(RADIANS(' . $getLat . ')) * sin(RADIANS(lat)) + cos(RADIANS(' . $getLat . ')) * cos(RADIANS(lat)) * cos(RADIANS(lng) - RADIANS(' . $getLng . '))))';
		
			$arrVisible = $this->catalog_visible;
			$arrVisible[] = 'distance';

			$this->catalog_visible = $arrVisible;

			$GLOBALS['TL_DCA'][$this->strTable]['fields']['distance'] = array(
				'inputType' => 'text',
				'label' => array('Entfernung','Entfernung zum Partner')
			);
		}
		parent::compile();
		
	}

	protected function formatAddress($address)
	{
		$address = str_replace(" ","+",$address);
		$address = str_replace("'","",$address);
		return $address;
	}
}

?>