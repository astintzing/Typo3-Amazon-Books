<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Alexander Stintzing <alex@stintzing.net>
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
class Tx_AmazonBooks_Domain_Model_Link extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Show Link
	 *
	 * @var string $link
	 * @validate NotEmpty
	 */
	protected $link;

	/**
	 * ASIN
	 *
	 * @var string
	 * @dontvalidate
	 */
	protected $asin;

	/**
	 * The creator of the book
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $creator;

	/**
	 * The author of the book
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $author;

	/**
	 * The title of the book
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * The description of the book
	 *
	 * @var string
	 * @dontvalidate
	 */
	protected $description;	
	
	/**
	 * The manufacturer of the book
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $manufacturer;

	/**
	 * ISBN code
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $isbn;

	/**
	 * Edition of the book
	 *
	 * @var string
	 */
	protected $edition;

	/**
	 * Calls of the book
	 *
	 * @var integer
	 */
	protected $calls;	
	
	/**
	 * Small Image for Listings
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $smallImage;

	/**
	 * DAM Image ID
	 *
	 * @var integer
	 */
	protected $damImage;	
	
	/**
	 * Medium Image for Single View
	 *
	 * @var string
	 */
	protected $mediumImage;

	/**
	 * Large image for Zoom
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $largeImage;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Returns the link
	 *
	 * @return string $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
		return $this;
	}

	/**
	 * Returns the asin
	 *
	 * @return string $asin
	 */
	public function getAsin() {
		return $this->asin;
	}

	/**
	 * Sets the asin
	 *
	 * @param string $asin
	 * @return void
	 */
	public function setAsin($asin) {
		$this->asin = $asin;
		return $this;
	}
	
	/**
	 * Returns the calls
	 *
	 * @return string $calls
	 */
	public function getCalls() {
		return $this->calls;
	}

	/**
	 * Sets the calls
	 *
	 * @param string $calls
	 * @return void
	 */
	public function setCalls($calls) {
		$this->calls = $calls;
		return $this;
	}	

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}	
	
	/**
	 * Returns the creator
	 *
	 * @return string $creator
	 */
	public function getCreator() {
		return $this->creator;
	}

	/**
	 * Sets the creator
	 *
	 * @param string $creator
	 * @return void
	 */
	public function setCreator($creator) {
		$this->creator = $creator;
		return $this;
	}

	/**
	 * Returns the author
	 *
	 * @return string $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param string $author
	 * @return void
	 */
	public function setAuthor($author) {
		$this->author = $author;
		return $this;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * Returns the manufacturer
	 *
	 * @return string $manufacturer
	 */
	public function getManufacturer() {
		return $this->manufacturer;
	}

	/**
	 * Sets the manufacturer
	 *
	 * @param string $manufacturer
	 * @return void
	 */
	public function setManufacturer($manufacturer) {
		$this->manufacturer = $manufacturer;
		return $this;
	}

	/**
	 * Returns the isbn
	 *
	 * @return string $isbn
	 */
	public function getIsbn() {
		return $this->isbn;
	}

	/**
	 * Sets the isbn
	 *
	 * @param string $isbn
	 * @return void
	 */
	public function setIsbn($isbn) {
		$this->isbn = $isbn;
		return $this;
	}

	/**
	 * Returns the edition
	 *
	 * @return string $edition
	 */
	public function getEdition() {
		return $this->edition;
	}

	/**
	 * Sets the edition
	 *
	 * @param string $edition
	 * @return void
	 */
	public function setEdition($edition) {
		$this->edition = $edition;
		return $this;
	}

	/**
	 * Returns the smallImage
	 *
	 * @return string $smallImage
	 */
	public function getSmallImage() {
		return $this->smallImage;
	}

	/**
	 * Sets the smallImage
	 *
	 * @param string $smallImage
	 * @return void
	 */
	public function setSmallImage($smallImage) {
		$this->smallImage = $smallImage;
		return $this;
	}
	
	
	/**
	 * Returns the damImage ID
	 *
	 * @return integer $damImage
	 */
	public function getDamImage() {
		return $this->damImage;
	}

	/**
	 * Sets the damImage ID
	 *
	 * @param integer $damImage
	 * @return void
	 */
	public function setDamImage($damImage) {
		$this->damImage = $damImage;
		return $this;
	}	
	

	/**
	 * Returns the mediumImage
	 *
	 * @return string $mediumImage
	 */
	public function getMediumImage() {
		return $this->mediumImage;
	}

	/**
	 * Sets the mediumImage
	 *
	 * @param string $mediumImage
	 * @return void
	 */
	public function setMediumImage($mediumImage) {
		$this->mediumImage = $mediumImage;
		return $this;
	}

	/**
	 * Returns the largeImage
	 *
	 * @return string $largeImage
	 */
	public function getLargeImage() {
		return $this->largeImage;
	}

	/**
	 * Sets the largeImage
	 *
	 * @param string $largeImage
	 * @return void
	 */
	public function setLargeImage($largeImage) {
		$this->largeImage = $largeImage;
		return $this;
	}

}
?>