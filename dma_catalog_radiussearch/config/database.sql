-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 


CREATE TABLE `tl_module` (
  `dcrOpenStreetMapEmail` varchar(255) NOT NULL default '',
  `dcrFormFieldLat` int(10) unsigned NOT NULL default '0',
  `dcrFormFieldLng` int(10) unsigned NOT NULL default '0',
  `dcrSortByDistanceDESC` char(1) NOT NULL default '',
  `dcrFieldCatalogLat` varchar(255) NOT NULL default '',
  `dcrFieldCatalogLng` varchar(255) NOT NULL default '',
  `dcrSortByDistance` char(1) NOT NULL default '',
  `dcrFormFieldAddress` int(10) unsigned NOT NULL default '0',
  `dcrFormFieldAdditional` varchar(255) NOT NULL default '',
  `dcrUseLatLng` char(1) NOT NULL default '',
  `dcrType` varchar(64) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  