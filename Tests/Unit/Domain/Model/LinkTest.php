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
*  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_AmazonBooks_Domain_Model_Link.
 *
 * @version $Id: LinkTest.php 83 2011-10-24 14:33:09Z alex $
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Amazon
 *
 */
class Tx_AmazonBooks_Domain_Model_LinkTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_AmazonBooks_Domain_Model_Link
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_AmazonBooks_Domain_Model_Link();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getLinkReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLinkForStringSetsLink() { 
		$this->fixture->setLink('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLink()
		);
	}
	
	/**
	 * @test
	 */
	public function getAsinReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAsinForStringSetsAsin() { 
		$this->fixture->setAsin('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAsin()
		);
	}
	
	/**
	 * @test
	 */
	public function getCreatorReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCreatorForStringSetsCreator() { 
		$this->fixture->setCreator('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCreator()
		);
	}
	
	/**
	 * @test
	 */
	public function getAuthorReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAuthorForStringSetsAuthor() { 
		$this->fixture->setAuthor('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAuthor()
		);
	}
	
	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getManufacturerReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setManufacturerForStringSetsManufacturer() { 
		$this->fixture->setManufacturer('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getManufacturer()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsbnReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIsbnForStringSetsIsbn() { 
		$this->fixture->setIsbn('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIsbn()
		);
	}
	
	/**
	 * @test
	 */
	public function getEditionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setEditionForStringSetsEdition() { 
		$this->fixture->setEdition('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getEdition()
		);
	}
	
	/**
	 * @test
	 */
	public function getSmallImageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSmallImageForStringSetsSmallImage() { 
		$this->fixture->setSmallImage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSmallImage()
		);
	}
	
	/**
	 * @test
	 */
	public function getMediumImageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setMediumImageForStringSetsMediumImage() { 
		$this->fixture->setMediumImage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getMediumImage()
		);
	}
	
	/**
	 * @test
	 */
	public function getLargeImageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLargeImageForStringSetsLargeImage() { 
		$this->fixture->setLargeImage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLargeImage()
		);
	}
	
}
?>