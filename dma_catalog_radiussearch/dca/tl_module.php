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


$GLOBALS['TL_DCA']['tl_module']['palettes']['dma_catalog_radiussearchlist']  = $GLOBALS['TL_DCA']['tl_module']['palettes']['cataloglist'];//'{title_legend},name,headline,type;{config_legend},catalog,jumpTo,catalog_visible,catalog_link_override,catalog_link_window;{catalog_filter_legend:hide},deny_catalog_filter_cond_from_lister,catalog_condition_enable,catalog_search,catalog_query_mode,catalog_tags_mode,catalog_where,perPage,catalog_list_use_limit,catalog_order;{catalog_thumb_legend:hide},catalog_thumbnails_override;{catalog_edit_legend:hide},catalog_edit_enable;{template_legend:hide},catalog_template,catalog_layout;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';



?>