<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_amazonbooks_domain_model_link'] = array(
	'ctrl' => $TCA['tx_amazonbooks_domain_model_link']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, dam_image, link, asin, edition, isbn, creator, author, manufacturer, small_image, medium_image, large_image, calls',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent;;;;1-1-1, l10n_diffsource;;;;1-1-1, dam_image;;;;1-1-1, description;;;;1-1-1, calls;;;;1-1-1, hidden;;;;1-1-1, link;;;;1-1-1,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_amazonbooks_domain_model_link',
				'foreign_table_where' => 'AND tx_amazonbooks_domain_model_link.pid=###CURRENT_PID### AND tx_amazonbooks_domain_model_link.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' =>array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'asin' => array(
			'exclude' => 0,
		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.asin',
		
		
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		'creator' => array(
			'exclude' => 0,
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.creator',
		 
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		 
		 'calls' => array(
		 	'exclude' => 0,
		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.calls',
		 'config' => array(
		 	'type'=> 'input',
		 	'size' => '4'
		 )
		 ),
		 
		 'description' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
//				'wizards' => Array(
//
//					'RTE' => Array(
//						'notNewRecords' => 1,
//						'RTEonly' => 1,
//						'type' => 'script',
//						'title' => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
//						'icon' => 'wizard_rte2.gif',
//						'script' => 'wizard_rte.php',
//				),
//				),
				)
				),
				
				
'dam_image' => array(
        	'label' => 'LLL:EXT:lang/locallang_general.php:LGL.images',
        	'config' => array(
               'type' => 'group',
               'internal_type' => 'file',
               'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
               'max_size' => '10000',
//               'uploadfolder' => 'fileadmin/user_upload/Produktkategoriebilder',
               'show_thumbs' => '1',
   				'size' => '1',
           'maxitems' => '1',
           'minitems' => '0',
           'autoSizeMax' => 1,
       )
   ),					
				
				
			
				
		'author' => array(
						 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.author',
				
			'exclude' => 0,
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		'title' => array(
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.title',
		 
			'exclude' => 0,
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		'manufacturer' => array(
			'exclude' => 0,
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.manufacturer',
		 
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		'edition' => array(
			'exclude' => 0,
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.edition',
		 
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		 
		'isbn' => array(
			'exclude' => 0,
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.isbn',
		 
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		 
		 
		'small_image' => array(
			'exclude' => 0,
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.small_image',
		 
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),	
		'medium_image' => array(
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.medium_image',
		 
			'exclude' => 0,
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),	
		'large_image' => array(
		 		 	'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.large_image',
		 
			'exclude' => 0,
			'config' => array(
				'type'=> 'input',
		 	'size' => '40'
			)
		 ),
		 			 
		'link' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:amazon_books/Resources/Private/Language/locallang_db.xml:tx_amazonbooks_domain_model_link.link',
			'config' => array (
				'type' => 'user',
				'userFunc' => 'EXT:amazon_books/Configuration/TCA/class.tx_amazonbookslinks_tca.php:tx_amazonbookslinks_tca->getTCAWizard'

)

),
		)
);

// When using DAM, use DAM Media Field

$c = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['amazon_books']);
if( (int) $c['use_dam'] > 0) {
	unset($TCA['tx_amazonbooks_domain_model_link']['columns']['dam_image']);
	$TCA['tx_amazonbooks_domain_model_link']['columns']['dam_image'] = txdam_getMediaTCA('image_field', 'tx_amazonbooks_localimage');
}

?>