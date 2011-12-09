<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 *
 *
 * @package amazon_books
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_AmazonBooks_Controller_LinkController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * linkRepository
	 *
	 * @var Tx_AmazonBooks_Domain_Repository_LinkRepository
	 */
	protected $linkRepository;


	public function initializeAction() {


		$configuration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

		foreach(unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['amazon_books']) as $key => $val) {
			$configuration['settings'][$key] = $val;
		}
			
		$this->configurationManager->setConfiguration($configuration);
		$this->conf = &$configuration;

	}


	/**
	 * injectLinkRepository
	 *
	 * @param Tx_AmazonBooks_Domain_Repository_LinkRepository $linkRepository
	 * @return void
	 */
	public function injectLinkRepository(Tx_AmazonBooks_Domain_Repository_LinkRepository $linkRepository) {
		$this->linkRepository = $linkRepository;
	}

	/**
	 * action list
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {
		foreach(t3lib_div::trimExplode(',',$this->settings['books']) as $uid) {
			$links[] = $this->linkRepository->findByUid($uid);
		}
		$this->view->assign('links', $links);
	}


	/**
	 * action call
	 *
	 * @param $link
	 * @return void
	 * @dontvalidate $link
	 */
	public function callAmazonAction(Tx_AmazonBooks_Domain_Model_Link $link) {
	    
		$loc = 'http://www.amazon.de/exec/obidos/ASIN/'.$link->getAsin().'/'.$this->conf['amazon_associate_tag'];
		if(!t3lib_div::cmpIp(t3lib_div::getIndpEnv('REMOTE_ADDR'),$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'])) {
			// TRACKING
			$link->setCalls($link->getCalls()+1);
			$this->linkRepository->update($link);
			$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
			/** @var $persistenceManager Tx_Extbase_Persistence_Manager */
			$persistenceManager->persistAll();

			header('refresh:1;url='.$loc);
		} else {
			echo 'YOU ARE NOT TRACKED BY TYPO3 CAUSED BY DEVIPMASK!<br /> - please wait...';
			header('refresh:2;url='.$loc);
			die();
		}
	}

}
?>