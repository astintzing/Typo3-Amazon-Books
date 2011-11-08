<?php
class tx_amazonbooks_browse_links implements t3lib_browseLinksHook {

	/**
	 * the browse_links object
	 */
	protected $pObj;

	protected $allAvailableTabHandlers=array();

	/**
	 * initializes the hook object
	 *
	 * @param	browse_links	parent browse_links object
	 * @param	array			additional parameters
	 * @return	void
	 */
	public function init($parentObject, $additionalParameters) {
		$this->pObj=&$parentObject;
	}

	/**
	 * adds new items to the currently allowed ones and returns them
	 *
	 * @param	array	currently allowed items
	 * @return	array	currently allowed items plus added items
	 */
	public function addAllowedItems($currentlyAllowedItems) {
		$currentlyAllowedItems[] = 'tx_amazonbooks';
		return $currentlyAllowedItems;
	}

	/**
	 * modifies the menu definition and returns it
	 *
	 * @param	array	menu definition
	 * @return	array	modified menu definition
	 */
	public function modifyMenuDefinition($menuDefinition) {
		$menuDefinition['tx_amazonbooks'] = array(
			'label' => 'Amazon Link',
			'url' => '#',
			'addParams' => 'onclick="jumpToUrl(\'?act=tx_amazonbooks&editorNo='.$this->pObj->editorNo.'&contentTypo3Language='.$this->pObj->contentTypo3Language.'&contentTypo3Charset='.$this->pObj->contentTypo3Charset.'\');return false;"',
			'isActive' => $this->pObj->act == 'tx_amazonbooks'
			);
			return $menuDefinition;
	}

	public function getTab($linkSelectorAction) {
		global $LANG;

		$out = '<div id="tx_amazonbookslinks_links" style="width: 99%"></div>';
		$out .= '<div id="tx_amazonbookslinks_results" style="width: 99%"></div>';
		$js = file_get_contents(dirname(__FILE__).'/browse_records.js');
		$out .= '<script type="text/javascript">' . $js;
		$out .= '
				Ext.onReady(function() { 
					Axt.Amazon.initSearchBox();
					panel = Axt.Amazon.getSearchBox();
					Axt.Amazon.initStore();
					panel.render(\'tx_amazonbookslinks_links\');
					});
				';


		$out .= '</script>';

		return $out;
	}


	/**
	 * checks the current URL and determines what to do
	 *
	 * @param	unknown_type		$href
	 * @param	unknown_type		$siteUrl
	 * @param	unknown_type		$info
	 * @return	unknown_type
	 */
	public function parseCurrentUrl($href, $siteUrl, $info) {
		if($linkSelectorAction=='amzn-lnk'){
			$info['act'] = 'tx_amazonbooks';
			$info['siteUrl'] = "WUFFIWUFF";
		}
		return $info;

	}
}