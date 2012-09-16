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

class DMACatalogRadiussearchList extends Frontend
{
	
	public function parseCatalogData($arrCatalog, $objTemplate, $objModule)
	{

		if ($this->Input->get('latitude') && $this->Input->get('longitude')) 
		{
			$arrNewCatalog = array();
			
			$getLat = $this->Input->get('latitude');
			$getLng = $this->Input->get('longitude');
			
			foreach ($arrCatalog as $value) 
			{
				$dataLat = $value['data'][$objModule->dcrFieldCatalogLat]['value'];
				$dataLng = $value['data'][$objModule->dcrFieldCatalogLng]['value'];
				
				$value['distance'] = number_format(6378.388 * acos(sin(deg2rad($getLat)) * sin(deg2rad($dataLat)) + cos(deg2rad($getLat)) * cos(deg2rad($dataLat)) * cos(deg2rad($dataLng) - deg2rad($getLng))), 0, ',', ' ');

				$arrNewCatalog[] = $value;
			}
			$arrCatalog = $arrNewCatalog;
		}
		return $arrCatalog;
	}


}

?>