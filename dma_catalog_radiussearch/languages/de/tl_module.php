<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
/**
 * TYPOlight webCMS
 * Extension DMA Elementgenerator
 * Copyright Dialog- und Medienagentur der ACS mbH  (2010)
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  DMA - Dialog und Medien Agentur 2012
 * @author     Janosch Skuplik <skuplik@dma.do>
 * @package    dmaCatalogRadiussearch
 * @license    LGPL
 * @filesource
 */

  
//Fields
$GLOBALS['TL_LANG']['tl_module']['dcrType'] = array('API für die Geocodierung','Derzeit kann zwischen der Google-Maps-API und der OpenStreetMap-API gewählt werden.');
$GLOBALS['TL_LANG']['tl_module']['dcrOpenStreetMapEmail'] = array('E-Mail-Adresse für die OSM-Anfragen','Für die Anfragen an die OpenStreetMap kann eine E-Mail-Adresse mit angegeben werden, die bei Bedarf kontaktiert werden kann');
$GLOBALS['TL_LANG']['tl_module']['dcrUseLatLng'] = array('LatLng-Felder aus dem Formular verwenden','Sollen aus dem Formular Latitude- und Longitide-Feld berücksichtigt werden? Ein Fallback auf das Adressefeld exisitert für leere Koordinaten-Felder.');
$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldLat'] = array('Latitude-Feld','Feld, mit dem der Latitude-Wert übermittelt wird');
$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldLng'] = array('Longitude-Feld','Feld mit dem der Longitude-Wert übermittelt wird');
$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldAddress'] = array('Adress-Feld im Formular','Hier kann das Adresse-Feld aus dem entsprechenden Formular gewählt werden.');
$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldAdditional'] = array('zusätzlich Parameter für die Adress-Codierung','Hier können der Adress-Codierung zusätzliche Parameter angehägt werden. (z.B. +DE für die Google-API wenn nur Treffer aus Deutschland berücksichtig werden sollen; bzw. &amp;countrycodes=de für die OpenStreetMap-API)');
$GLOBALS['TL_LANG']['tl_module']['dcrSortByDistance'] = array('Die Ergebnisse nach Entfernung sortieren','Sollen die Ergebnisse der Suche der Entfernung nach sortiert werden?');
$GLOBALS['TL_LANG']['tl_module']['dcrSortByDistanceDESC'] = array('Absteigend sortieren','Standardmäßig werden die Ergebnisse aufsteigen (ASC) sortiert. Dies kann hier auf DESC überschrieben werden.');
$GLOBALS['TL_LANG']['tl_module']['dcrFieldCatalogLat'] = array('Latitude-Koordinatenfeld im Catalog','Feld, in dem die Latitude-Koordinate im Catalog steht');
$GLOBALS['TL_LANG']['tl_module']['dcrFieldCatalogLng'] = array('Longitude-Koordninatenfeld im Catalog','Feld, in dem die Longitude-Koordinate im Catalog steht');

//References
$GLOBALS['TL_LANG']['tl_module']['dcrTypeSelect'] = array(
	'dcrUseGoogleMaps' => 'die GoogleMaps-API verwenden',
	'dcrUseOpenStreetMaps' => 'die OpenStreetMap-API verwenden'
);



?>
