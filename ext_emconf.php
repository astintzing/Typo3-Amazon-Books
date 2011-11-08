<?php

########################################################################
# Extension Manager/Repository config file for ext "amazon_books".
#
# Auto generated 06-08-2011 02:22
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Amazon Books',
	'description' => 'Amazon Search interface in the backend, download cover and create Links with the Plugin or RTE, DAM enabled, Extbase, ExtJS',
	'category' => 'plugin',
	'author' => 'Alexander Stintzing',
	'author_email' => 'alex@stintzing.net',
	'author_company' => '',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid,zend_framework',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.6.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
			'zend_framework' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:38:{s:21:"ExtensionBuilder.json";s:4:"3b97";s:21:"ext_conf_template.txt";s:4:"3b07";s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"7001";s:14:"ext_tables.php";s:4:"4894";s:14:"ext_tables.sql";s:4:"b1ab";s:37:"Classes/Controller/LinkController.php";s:4:"211f";s:29:"Classes/Domain/Model/Link.php";s:4:"bc8b";s:44:"Classes/Domain/Repository/LinkRepository.php";s:4:"6f81";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"f736";s:33:"Configuration/FlexForms/Links.xml";s:4:"0b8d";s:37:"Configuration/Hooks/browse_records.js";s:4:"a439";s:55:"Configuration/Hooks/class.tx_amazonbooks_browse_links.php";s:4:"fd23";s:51:"Configuration/Hooks/class.tx_amazonbookslinks_rte.php";s:4:"6e28";s:26:"Configuration/TCA/Link.php";s:4:"3354";s:49:"Configuration/TCA/class.tx_amazonbookslinks_tca.php";s:4:"e97b";s:24:"Configuration/TCA/tca.js";s:4:"f86e";s:38:"Configuration/TypoScript/constants.txt";s:4:"5cd8";s:34:"Configuration/TypoScript/setup.txt";s:4:"42c2";s:46:"Resources/Private/Backend/Layouts/Default.html";s:4:"330b";s:50:"Resources/Private/Backend/Partials/FormErrors.html";s:4:"f5bc";s:55:"Resources/Private/Backend/Partials/Link/FormFields.html";s:4:"337b";s:55:"Resources/Private/Backend/Partials/Link/Properties.html";s:4:"6448";s:50:"Resources/Private/Backend/Templates/Link/Edit.html";s:4:"5bf2";s:50:"Resources/Private/Backend/Templates/Link/List.html";s:4:"8612";s:49:"Resources/Private/Backend/Templates/Link/New.html";s:4:"c84a";s:50:"Resources/Private/Backend/Templates/Link/Show.html";s:4:"d3de";s:40:"Resources/Private/Language/locallang.xml";s:4:"304f";s:50:"Resources/Private/Language/locallang_amazonbooks.xml";s:4:"106b";s:75:"Resources/Private/Language/locallang_csh_tx_amazonbooks_domain_model_link.xml";s:4:"6632";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"63f4";s:38:"Resources/Private/Layouts/Default.html";s:4:"4caa";s:42:"Resources/Private/Templates/Link/List.html";s:4:"8272";s:42:"Resources/Private/Templates/Link/Show.html";s:4:"543d";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:57:"Resources/Public/Icons/tx_amazonbooks_domain_model_link.gif";s:4:"905a";s:36:"Tests/Unit/Domain/Model/LinkTest.php";s:4:"9c09";s:14:"doc/manual.sxw";s:4:"8d2d";}',
);

?>