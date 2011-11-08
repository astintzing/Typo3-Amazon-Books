Ext.ns('Axt.Amazon');

Axt.Amazon = {

	searchBox : null,
	store : null,
	gridPanel : null,
	actions : {
		addBook : null
	},

	onStoreLoad : function() {
		this.store.load({
					params : {
						ajaxID : 'tx_amazonbookslinks_rte::searchRecords',
						sword : Ext.getCmp('amazon_books_searchbox_sword')
								.getValue()
					}
				});

		Ext.get('tx_amazonbookslinks_results').update('');

		this.initGrid();
	},

	initSearchBox : function() {

		this.searchBox = new Ext.Panel({
					id : 'amazon_books_searchbox',
					labelWidth : 70,

					border : false,
					frame : true,
					scope : this,

					items : [{
								xtype : 'textfield',
								fieldLabel : 'Suche nach',
								name : 'sword',
								id : 'amazon_books_searchbox_sword',
								value : 'Japan'
							}],

					buttons : [{
								text : 'Suchen',
								scope : this,
								handler : this.onStoreLoad
							}]
				});
	},

	getSearchBox : function() {
		return this.searchBox;
	},

	getGrid : function() {
		return this.gridPanel;
	},

	initStore : function() {
		this.store = new Ext.data.JsonStore({
					url : '/typo3/ajax.php',

					baseParams : {
						method : 'get'
					},

					id : 'uid',
					fields : [{
								name : 'uid'
							}, {
								name : 'title'
							}, {
								name : 'author'
							}, {
								name : 'manufacturer'
							}, {
								name : 'small_image'
							
						}

					],

					remoteSort : false
				});
		// register store
		Ext.StoreMgr.add('SearchStore', this.store);
	},

	initGrid : function() {

		// the columnmodel
		var columnModel = new Ext.grid.ColumnModel({
					defaults : {
						sortable : true,
						resizable : true
					},
					columns : [{
								id : 'small_image',
								header : 'Bild',
								dataIndex : 'small_image',
								hidden : false,
								renderer : function(el) {
									return '<img src="' + el + '" />';
								}
							}, {
								id : 'uid',
								header : 'ID',
								dataIndex : 'uid',
								width : 20,
								hidden : true
							}, {
								id : 'author',
								header : 'Autor',
								dataIndex : 'author',
								hidden : false
							}, {
								id : 'title',
								header : 'Titel',
								dataIndex : 'title',
								hidden : false
						
						}]
				});

		columnModel.defaultSortable = true;

		var rowSelectionModel = new Ext.grid.RowSelectionModel({
					multiSelect : false
				});

		// the gridpanel
		var gridPanel = new Ext.grid.GridPanel({
					store : this.store,
					cm : columnModel,
					renderTo : 'tx_amazonbookslinks_results',
					id : 'AmazonSearchResultPanel',
					layout : 'fit',
					height : 500,
					scope : this,
					frame : true,
					autoSizeColumns : true,
					selModel : rowSelectionModel,
					enableColLock : false,
					loadMask : true,
					border : false,
					view : new Ext.grid.GridView({
								autoFill : true,
								forceFit : true,
								ignoreAdd : true,
								emptyText : 'Keine Suchergebnisse'
							})

				});

		gridPanel.on('rowclick', function(obj) {
					if (obj) {
						record = obj.getSelectionModel().getSelected();
						if (record) {
							Axt.Amazon.selectRteBook(record.data);
						}
					}
				});
	}

};

Axt.Amazon.selectRteBook = function(book) {

	console.log(book);

	var parameters = '?type=2435978245&tx_amazonbooks_amazonbooks[link]='
			+ book.uid
			+ '&tx_amazonbooks_amazonbooks[action]=callAmazon&tx_amazonbooks_amazonbooks[controller]=Link';
	var theLink = "/" + parameters;
	
	browse_links_setTitle(book.title);
	browse_links_setClass('amzn-lnk');
	browse_links_setTarget('_blank');

	plugin.createLink(theLink, cur_target, cur_class, book.title,
			additionalValues);

	return false;

};
