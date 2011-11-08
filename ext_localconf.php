<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'pi1',
	array(
		'Link' => 'list,show,callAmazon',
	),
	// non-cacheable actions
	array(
		'Link' => 'callAmazon',		
	)
);

$TYPO3_CONF_VARS['SC_OPTIONS']['ext/rtehtmlarea/mod3/class.tx_rtehtmlarea_browse_links.php']['browseLinksHook'][] =  'EXT:amazon_books/Configuration/Hooks/class.tx_amazonbooks_browse_links.php:&tx_amazonbooks_browse_links';
$TYPO3_CONF_VARS['BE']['AJAX']['tx_amazonbookslinks_tca::searchAmazon'] = 'EXT:amazon_books/Configuration/TCA/class.tx_amazonbookslinks_tca.php:tx_amazonbookslinks_tca->searchAmazon';
$TYPO3_CONF_VARS['BE']['AJAX']['tx_amazonbookslinks_tca::indexImage'] = 'EXT:amazon_books/Configuration/TCA/class.tx_amazonbookslinks_tca.php:tx_amazonbookslinks_tca->indexImage';
$TYPO3_CONF_VARS['BE']['AJAX']['tx_amazonbookslinks_rte::searchRecords'] = 'EXT:amazon_books/Configuration/Hooks/class.tx_amazonbookslinks_rte.php:tx_amazonbookslinks_rte->searchRecords';
?>