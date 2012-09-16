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


/**
 * Add palettes to tl_module
 */

$strDefaultPalette = '{dcr_legend},dcrFieldCatalogLat,dcrFieldCatalogLng,dcrSortByDistance,dcrFormFieldAddress,dcrFormFieldAdditional,dcrUseLatLng,dcrType,dcrOpenStreetMapEmail;';

$GLOBALS['TL_DCA']['tl_module']['palettes']['dma_catalog_radiussearchlist']  = str_replace('{catalog_edit_legend',$strDefaultPalette.'{catalog_edit_legend',$GLOBALS['TL_DCA']['tl_module']['palettes']['cataloglist']);

//'{title_legend},name,headline,type;{config_legend},catalog,jumpTo,catalog_visible,catalog_link_override,catalog_link_window;{catalog_filter_legend:hide},deny_catalog_filter_cond_from_lister,catalog_condition_enable,catalog_search,catalog_query_mode,catalog_tags_mode,catalog_where,perPage,catalog_list_use_limit,catalog_order;{catalog_thumb_legend:hide},catalog_thumbnails_override;{catalog_edit_legend:hide},catalog_edit_enable;{template_legend:hide},catalog_template,catalog_layout;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'dcrUseLatLng';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'dcrSortByDistance';

$GLOBALS['TL_DCA']['tl_module']['subpalettes']['dcrUseLatLng'] = 'dcrFormFieldLat,dcrFormFieldLng';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['dcrSortByDistance'] = 'dcrSortByDistanceDESC';

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrType'] = array(
	'label'     						=> &$GLOBALS['TL_LANG']['tl_module']['dcrType'],
  'reference' 						=> &$GLOBALS['TL_LANG']['tl_module']['dcrTypeSelect'],
  'inputType' 						=> 'select',
  'options' 							=> array('dcrUseGoogleMaps','dcrUseOpenStreetMaps'),
  'default' 							=> 'dcrUseOpenStreetMaps',
  'exclude' 							=> true,
  'eval' 									=> array('tl_class'=>'w50 clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrOpenStreetMapEmail'] = array(
	'label'                 => &$GLOBALS['TL_LANG']['tl_module']['dcrOpenStreetMapEmail'],
	'exclude'               => true,
	'inputType'             => 'text',
	'eval'                  => array('maxlength'=>64, 'rgxp'=>'email', 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrUseLatLng'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrUseLatLng'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'										=> array('tl_class'=>'w50 m12 clr','submitOnChange'=> true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrFormFieldLat'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldLat'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_dcr', 'getFormFields'),
	'eval'                    => array('tl_class'=>'w50 clr', 'mandatory'=>true, 'includeBlankOption'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrFormFieldLng'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldLng'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_dcr', 'getFormFields'),
	'eval'                    => array('tl_class'=>'w50', 'mandatory'=>true, 'includeBlankOption'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrFormFieldAddress'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldAddress'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_dcr', 'getFormFields'),
	'eval'                    => array('tl_class'=>'w50 clr', 'includeBlankOption'=>true)
);

//z.B. +DE für google oder &countrycodes=de für OSM
$GLOBALS['TL_DCA']['tl_module']['fields']['dcrFormFieldAdditional'] = array(
	'label'                 => &$GLOBALS['TL_LANG']['tl_module']['dcrFormFieldAdditional'],
	'exclude'               => true,
	'inputType'             => 'text',
	'eval'                  => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrSortByDistance'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrSortByDistance'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'										=> array('tl_class'=>'w50 m12', 'submitOnChange'=> true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrSortByDistanceDESC'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrSortByDistanceDESC'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'										=> array('tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrFieldCatalogLat'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrFieldCatalogLat'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_catalog', 'getCatalogFields'),
	'eval'                    => array('tl_class'=>'w50', 'mandatory'=>true, 'includeBlankOption'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dcrFieldCatalogLng'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dcrFieldCatalogLng'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_catalog', 'getCatalogFields'),
	'eval'                    => array('tl_class'=>'w50', 'mandatory'=>true, 'includeBlankOption'=>true)
);


class tl_module_dcr extends Backend
{
	/**
	 * Get all filter fields and return them as array
	 * @return array
	 */
	public function getFormFields(DataContainer $dc)
	{
		$formFields = array();

		$objForms = $this->Database->prepare("SELECT id,title FROM tl_form")
															->execute();
		
		if (!$objForms->numRows) return '';
		
		while ($objForms->next())
		{
			$objFormFields = $this->Database->prepare("SELECT * FROM tl_form_field WHERE pid=? AND (type=? OR type=? OR type=?)")
																			->execute($objForms->id,'text','hidden','select');
			while ($objFormFields->next())
			{
				$formFields[$objForms->title][$objFormFields->id] = $objFormFields->label ? ($objFormFields->label . ' [' . $objFormFields->name . ']') : $objFormFields->name;
			}
		}


		return $formFields;
		return '';//$this->getCatalogFields($dc, $GLOBALS['BE_MOD']['content']['catalog']['typesFilterFields']);
	}
}

?>