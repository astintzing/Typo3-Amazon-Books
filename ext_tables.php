<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'pi1',
	'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.link_list'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . 'pi1';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/Links.xml');


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Amazon Books');


t3lib_extMgm::addLLrefForTCAdescr('tx_amazonbooks_domain_model_link', 'EXT:amazon_books/Resources/Private/Language/locallang_csh_tx_amazonbooks_domain_model_link.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_amazonbooks_domain_model_link');
$TCA['tx_amazonbooks_domain_model_link'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Link.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_amazonbooks_domain_model_link.gif'
	),
);

?>