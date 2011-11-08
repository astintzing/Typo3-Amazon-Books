<?php

class Tx_AmazonBooks_ViewHelpers_DamViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	
	/**
	 * @var $cObj tslib_cObj
	 */
	protected $cObj;

	public function __construct() {	$this->cObj = new tslib_cObj(); }

	/**
	 * @param Tx_AmazonBooks_Domain_Model_Link $link
	 * @param int $height
	 * @param int $width
	 * @param int $maxHeight
	 * @param int $maxWidth
	 * @return Tag with path to rendered Image
	 */

	public function render($link,$height=null,$width=null,$maxHeight=null,$maxWidth=null) {

		$dm = array_pop(array_pop(tx_dam_db::getReferencedFiles('tx_amazonbooks_domain_model_link',$link->getUid(),'tx_amazonbooks_localimage')));

		$cnf['file'] = $dm['file_path'].$dm['file_name'];
		$cnf['titleText'] = $link->getTitle();
		if($height) $cnf['file.']['height'] = $height;
		if($width) $cnf['file.']['width'] = $width;
		if($maxHeight) $cnf['file.']['maxH'] = $maxHeight;
		if($maxWidth) $cnf['file.']['maxW'] = $maxWidth;
		$image = $this->cObj->IMAGE($cnf);
		return $image;
	}
	
}

?>