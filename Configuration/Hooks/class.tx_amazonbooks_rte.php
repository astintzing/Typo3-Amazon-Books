<?php

class tx_amazonbookslinks_rte {

	/**
	 * 
	 * Enter description here ...
	 * @var t3lib_DB
	 */
	var $db;
	
	public function searchRecords() {
		$this->db = $GLOBALS['TYPO3_DB'];
	
		$sword = $this->db->quoteStr(mb_strtolower(trim($_POST['sword']),mb_detect_encoding($_POST['sword'])), 'tx_amazonbooks_domain_model_link');
		$sql = 'SELECT * FROM tx_amazonbooks_domain_model_link WHERE deleted=0 AND hidden=0 AND ( ( title LIKE \'%'.$sword.'%\' ) OR ( author LIKE \'%'.$sword.'%\' ) )';
		
		$ret = array();
		if($res = $this->db->sql_query($sql)) {
			while($row = $this->db->sql_fetch_assoc($res)) {
				$ret[] = $row;
			}
		}
		
		echo json_encode($ret);
		
	}
	
}


?>