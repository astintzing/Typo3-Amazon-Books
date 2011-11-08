<?php

require_once(t3lib_extMgm::extPath('dam') . 'lib/class.tx_dam_indexing.php');

class tx_amazonbookslinks_tca {

	/**
	 * @var language
	 */
	var $lang;

	/**
	 * @var t3lib_DB
	 */

	var $db;

	/**
	 * @var string
	 */
	var $elname;

	/**
	 * @var string
	 */

	var $elid;

	/**
	 * @var string
	 */

	var $eldata;

	function __construct() {
		global $GLOBALS;
		$this->conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['amazon_books']);
		$this->db = &$GLOBALS['TYPO3_DB'];
		$this->user = &$GLOBALS['BE_USER'];

		$this->lang = new language(); // t3lib_div::makeInstance('language');
		$this->lang->init($this->user->uc['lang']);
		$this->lang->includeLLFile('EXT:amazon_books/Resources/Private/Language/locallang.xml');

		$la = array();
		foreach(array('search_for', 'search_for_button', 'no_sword', 'add_book', 'choose_book', 'show_books', 'no_searchresults', 'picture', 'title', 'author', 'manufacturer', 'asin', 'detailpage') as $l) {
			$la[$l] = $this->lang->getLL('tx_amazonbooks.'.$l);
		}

		$this->jslang = json_encode($la);

	}

	public function getTCAWizard($PA, $fObj) {

		$this->elname = $PA['itemFormElName'];
		$this->eldata = $PA['row']['link'];
		$this->elid   = $PA['itemFormElID'];
		$this->recId  = $PA['row']['uid'];
		$this->rec    = $PA['row'];

		$field = $this->getFields();

		$js = file_get_contents(dirname(__FILE__).'/tca.js');

		$out = $field . '<style type="text/css">' .
						'	#tx_amazonbookslinks_ajaxloader {height:15px;width:15px;display:block;float:left;margin-right:5px}' .
						'	.loading {background-image: url("/typo3conf/ext/amazon_books/Resources/Public/Icons/ajax-loader.gif");background-repeat:no-repeat;background-position:right 50%}' .
						'</style>' .
						'<script type="text/javascript">' . $js;
		$new = strstr($this->recId, 'NEW');

		if(!$new) {

			$book = array('data' => array(
				'SmallImage' => $this->rec['small_image'],
				'MediumImage' => $this->rec['medium_image'],
				'LargeImage' => $this->rec['large_image'],
				'Title'  => $this->rec['title'],
				'ASIN'  => $this->rec['asin'],
				'ISBN'  => $this->rec['isbn'],
				'Edition'  => $this->rec['edition'],
				'Author'  => $this->rec['author'],
				'Manufacturer'  => $this->rec['manufacturer'],
				'DetailPageURL'  => $this->rec['link'],
			));

			$out .= '
				Ext.onReady(function() {
					Axt.Amazon.initConfig('.$this->conf['use_dam'].');
					Axt.Amazon.initLang('.$this->jslang.'); 
					Axt.Amazon.renderBook('.json_encode($book).', \''.$this->recId.'\')
				});
			';
		} else {
			$out .= '
				Ext.onReady(function() { 
					Axt.Amazon.initConfig('.$this->conf['use_dam'].');
					Axt.Amazon.initLang('.$this->jslang.'); 
					Axt.Amazon.initSearchBox();
					panel = Axt.Amazon.getSearchBox();
					Axt.Amazon.initStore();
					panel.render(\'tx_amazonbookslinks_links\');
					});
				';
		}

		$out .= '</script>';

		return $out;
	}

	private function getFields() {

		$out = '<div id="tx_amazonbookslinks_links" style="overflow:hidden;display:block;padding-right:20px"></div>';
		$out .= '<div id="tx_amazonbookslinks_results" class="" style="display:block;padding-right:20px"></div>';

		$out .= '<input type="hidden" id="tx_amazonbookslinks_links_currentRecord" value="'.$this->recId.'" />';

		foreach(array('isbn', 'edition', 'title', 'link', 'asin', 'creator', 'author', 'manufacturer', 'small_image', 'medium_image', 'large_image') as $s) {
			$out .='<input id="data_tx_amazonbooks_domain_model_link_'.$this->recId.'_'.$s.'" type="hidden" value="'.$this->rec[$s].'" name="data[tx_amazonbooks_domain_model_link]['.$this->recId.']['.$s.']">';
		}

		return $out;
	}



	public function indexImage() {
		$s = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['amazon_books']);

		$ret = array('image_id' => null,'file_name' => null);
		$recID = trim($_POST['recId']);
		$img1 = trim($_POST['img1']);
		$img2 = trim($_POST['img2']);
		$img3 = trim($_POST['img3']);
		$title = $_POST['title'];

		if((int)$s['use_dam'] > 0) {
			$dam = new tx_dam();
			$fileName = $dam->file_makeCleanName($title);
		} else {
			$fileName = t3lib_basicFileFunctions::cleanFileName($title);
		}
		
		$fileName = iconv(iconv_get_encoding($fileName),'ASCII//IGNORE',$fileName);
		
		$path = explode('/',__FILE__);

		array_pop($path);
		array_pop($path);
		array_pop($path);
		array_pop($path);
		array_pop($path);
		array_pop($path);

		$path[] = $s['image_path'];
		$path = join('/',$path) . '/';

		//if(!t3lib_basicFileFunctions::checkPathAgainstMounts($path)) throw new Exception($this->lang->getLL('tx_amazonbooks.no_image_path_perms') . ': ' . $s['image_path']);

		if(!is_dir($path)) {
			mkdir($path,0770,true);
		}

		if(!is_dir($path)) {
			throw new Exception($this->lang->getLL('tx_amazonbooks.path_not_createable') . ': ' . $s['image_path']);
		}

		$ch = curl_init();

		$fn = $path . $fileName;
			
		if($img3) $img = $img3;
		elseif($img2) $img = $img2;
		elseif($img1) $img = $img1;
		else {
			$img = false;
			//			$ret['error'] = $LANG->
		}

		if($img) {

				
			$urls = explode('/',$img);
			$img = '';

			for ($i = 0; $i+1 < count($urls); $i++) {
				$img .= $urls[$i] . '/';
			}

			$img = $img . rawurldecode($urls[$i]);
			
//			$img = 'http://www.das-japanische-gedaechtnis.de/ALEX%BJOERN.jpg';
			
//			die($nu);
			
				
			$fh = fopen($fn, 'wb');

			curl_setopt($ch, CURLOPT_FILE, $fh);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_URL, $img);

			$code = curl_exec($ch);
			$info = curl_getinfo($ch);
			@curl_close($ch);
			@fclose($fh);
//die(var_dump($code));
			if($info['http_code'] == 200) {

				$mimetypes = array('image/jpeg' => '.jpg','image/gif' => '.gif','image/png' => '.png', 'image/jpg' => '.jpg','image/tiff' => '.tif','image/tif' => '.tif');
				$suffix = $mimetypes[$info['content_type']];
				if(!suffix) $suffix = '.'.array_pop(explode('.',$info['content_type']));

				rename($fn, $path.$fileName.$suffix);
				if((int)$s['use_dam'] > 0) {
					$di = new tx_dam_indexing();
					$newFile = $di->indexFile($path.$fileName.$suffix,time(),1);
				} else {
					$ret['image_id'] = 0;
					$ret['file_name'] = $path.$fileName.$suffix;
				}
				if($newFile) {
					$ret['image_id'] = $newFile['fields']['uid'];
					$ret['file_name'] = $newFile['fields']['file_name'];
				}

			} else {
				$ret['error'] = $this->lang->getLL('tx_amazonbooks.download_error');
			}

			@curl_close($ch);
			@fclose($fh);
				
		} else {
			$ret['error'] = $this->lang->getLL('tx_amazonbooks.download_error');
		}

		echo json_encode($ret);


	}



	public function searchAmazon() {

		$s = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['amazon_books']);


		if(isset($_POST['start'])) {
			$page = intval($_POST['start']);
		}
			
		if(isset($_POST['sword'])) {
			$sword = trim($_POST['sword']);
			$searchParams = array('SearchIndex' => 'Books', 'Keywords' => $sword, 'ResponseGroup' => 'Small,Medium,Large,Images,Reviews');
			if($page) $searchParams['ItemPage'] = $page;


			$amazon = new Zend_Service_Amazon($s['amazon_developer_key'],$s['amazon_locale'], $s['amazon_developer_secret_key']);
			if($amazon) {
				$res = $amazon->itemSearch($searchParams);
			} else {
				$res = null;
				$ret = array('error' => $this->lang->getLL('tx_amazonbooks.no_connection'));
			}

			if(!is_null($res)) {
				$ret['totalcount'] = $res->totalPages();
				foreach ($res as $result) {

					if($result->SmallImage)  $si = $result->SmallImage->Url->getScheme() . '://' . $result->SmallImage->Url->getHost() . $result->SmallImage->Url->getPath();
					else $si = null;
					if($result->MediumImage) $mi = $result->MediumImage->Url->getScheme() . '://' . $result->MediumImage->Url->getHost() . $result->MediumImage->Url->getPath();
					else $mi = null;
					if($result->LargeImage) $li = $result->LargeImage->Url->getScheme() . '://' . $result->LargeImage->Url->getHost() . $result->LargeImage->Url->getPath();
					else $li = null;

					if(is_null($si)) {
						if(!is_null($mi)) $si = $mi;
						elseif(!is_null($li)) $si = $li;
					}

					$ret['items'][] = array(
					'Creator' => $result->Creator,
					'SmallImage' => $si,
					'MediumImage' => $mi,
					'LargeImage' => $li,
					'ASIN' => $result->ASIN,
					'Edition' => $result->Edition,
					'ISBN' => $result->ISBN,
					'DetailPageURL' => $result->DetailPageURL,
					'Author' => $result->Author,
					'Manufacturer' => $result->Manufacturer,
					'Title' => $result->Title
					);

				}
					
			} else {
				$ret = array('error' => $this->lang->getLL('tx_amazonbooks.no_connection'));
			}

		} else {
			$ret = array('error' => $this->lang->getLL('tx_amazonbooks.no_sword'));

		}

		echo json_encode($ret);

	}

}

?>