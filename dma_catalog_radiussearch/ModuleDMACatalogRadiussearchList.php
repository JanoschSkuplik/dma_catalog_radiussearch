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


		$objAddressField = $this->Database->prepare("SELECT * FROM tl_form_field WHERE id=?")
																			->limit(1)
																			->execute($this->dcrFormFieldAddress);
		$strAddressFieldName = $objAddressField->name;
		
		if (!$this->Input->get($strAddressFieldName) && $this->Input->post($strAddressFieldName))
		{
			$this->Input->setGet($strAddressFieldName,$this->Input->post($strAddressFieldName));
		}
		
		if ($this->dcrUseLatLng)
		{
			$objFormFieldLat = $this->Database->prepare("SELECT * FROM tl_form_field WHERE id=?")
																			->limit(1)
																			->execute($this->dcrFormFieldLat);
			$strFormFieldLat = $objFormFieldLat->name;
			
			$objFormFieldLng = $this->Database->prepare("SELECT * FROM tl_form_field WHERE id=?")
																			->limit(1)
																			->execute($this->dcrFormFieldLng);
			$strFormFieldLng = $objFormFieldLng->name;
			
			if (!$this->Input->get($strFormFieldLat) && $this->Input->post($strFormFieldLat))
			{
				$this->Input->setGet($strFormFieldLat,$this->Input->post($strFormFieldLat));
			}
			$this->Input->setGet('latitude',$this->Input->get($strFormFieldLat));
			if (!$this->Input->get($strFormFieldLng) && $this->Input->post($strFormFieldLng))
			{
				$this->Input->setGet($strFormFieldLng,$this->Input->post($strFormFieldLng));
			}
			$this->Input->setGet('longitude',$this->Input->get($strFormFieldLng));
		}
		
		// try to get location, if lat/lng isn't set
		if ((!$this->dcrUseLatLng || (!$this->Input->get($strFormFieldLat) || !$this->Input->get($strFormFieldLng))) && $this->Input->get($strAddressFieldName))
		{

			if ($this->dcrType == 'dcrUseGoogleMaps')
			{
				$getLocation = $this->formatAddress($this->Input->get($strAddressFieldName) . $this->dcrFormFieldAdditional);
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
			elseif ($this->dcrType == 'dcrUseOpenStreetMaps')
			{
				$getLocation = rawurlencode($this->Input->get($strAddressFieldName) . $this->dcrFormFieldAdditional);
				$osmUrl = 'http://nominatim.openstreetmap.org/search/?q=' . $getLocation . '&format=json&polygon=0&addressdetails=0&limit=1&email=' . rawurlencode($this->dcrOpenStreetMapEmail);

				$osmResponse = @file_get_contents($osmUrl);
				if ($osmResponse)
				{
					$geocodeObject = json_decode($osmResponse);

					if ($geocodeObject[0]->lat && $geocodeObject[0]->lon)
					{
						$this->Input->setGet('latitude',$geocodeObject[0]->lat);
						$this->Input->setGet('longitude',$geocodeObject[0]->lon);
					}
				}
			}
		}
		
		
		if ($this->Input->get('latitude') && $this->Input->get('longitude'))
		{
			$getLat = $this->Input->get('latitude');
			$getLng = $this->Input->get('longitude');
		
			if ($this->dcrSortByDistance)
			{
				$this->catalog_order = '(6378.388 * acos(sin(RADIANS(' . $getLat . ')) * sin(RADIANS(' . $this->dcrFieldCatalogLat .')) + cos(RADIANS(' . $getLat . ')) * cos(RADIANS(' . $this->dcrFieldCatalogLat . ')) * cos(RADIANS(' . $this->dcrFieldCatalogLng . ') - RADIANS(' . $getLng . ')))) ' . ($this->dcrSortByDistanceDESC ? 'DESC' : '') . '';
			}
		
			$arrVisible = $this->catalog_visible;
			$arrVisible[] = 'distance';

			$this->catalog_visible = $arrVisible;

			$GLOBALS['TL_DCA'][$this->strTable]['fields']['distance'] = array(
				'inputType' => 'text',
				'label' => array('Entfernung','Entfernung')
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