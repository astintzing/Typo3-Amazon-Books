
Ext.ns('Axt.Amazon');

Axt.Amazon = {

	searchBox: null,
	store: null,
	gridPanel: null,
	
	use_dam: null,
	
	l10n: {
		add_book: null,
		choose_book: null,
		show_books: null,
		no_searchresults: null,
		no_sword: null,
		picture: null,
		title: null,
		author: null,
		manufacturer: null,
		asin: null,
		detailpage: null,
		search_for: null,
		search_for_button: null
	},
	
	initLang: function(translations) {
		this.l10n = translations;
	},
	
	initConfig: function(using_dam) {
		this.use_dam = using_dam;
	},
	
	actions: {
		addBook: null
	},
	
	paging: {
		start : 0,
		limit : 10,
		sort : 'Title',
		dir : 'ASC'
	},
	
	onStoreLoad : function() {

		if(Ext.getCmp('amazon_books_searchbox_sword').getValue() == '') {
			alert(this.l10n.no_sword);
			return false;
		}
		
		this.store.load({
			
					params : {
						ajaxID : 'tx_amazonbookslinks_tca::searchAmazon',
						sword : Ext.getCmp('amazon_books_searchbox_sword').getValue(),
						start: this.paging.start
					}
				});

		Ext.get('tx_amazonbookslinks_results').update('');
		this.initGrid();
	},
	
	handlers : {
		scope: this,
		addBook : function(_button, _event) {
			book = Ext.getCmp('AmazonSearchResultPanel').getSelectionModel().getSelected();
			Axt.Amazon.selectBook(book,this.use_dam);
		}
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
						fieldLabel : this.l10n.search_for,
						name : 'sword',
						id: 'amazon_books_searchbox_sword',
						value : 'Japan'
						}],
					buttons : [{
						text : this.l10n.search_for_button,
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
					url : 'ajax.php',
					autoLoad: false,
					baseParams : {
						'ajaxID': 'tx_amazonbookslinks_tca::searchAmazon'
					},
					totalProperty : 'totalcount',
					root: 'items',
					
					sortInfo : {
						field : this.paging.sort,
						direction : this.paging.dir
					},
					remoteSort : true,					
					id : 'ASIN',
					fields : [{
								name : 'ASIN'
							}, {
								name : 'DetailPageURL'
							}, {
								name : 'Author'
							}, {
								name : 'Manufacturer'
							}, {
								name : 'Title'
							}, {
								name : 'SmallImage'
							}, {
								name : 'MediumImage'
							},{
								name : 'Edition'
							},{
								name : 'ISBN'
							}, {
								name : 'LargeImage'
							}]

				});
		// register store
		Ext.StoreMgr.add('SearchStore', this.store);
		
		this.store.on('beforeload', function(store, options) {


					Ext.get('amazon_books_searchbox_sword').addClass('loading');
			
					if (!options.params) {
						options.params = {};
					}

					start = options.params.start ? options.params.start : 0;
            		limit = options.params.limit ? options.params.limit : 10;

					store.setBaseParam('start', start);
            		store.setBaseParam('limit', limit);
            		store.setBaseParam('sword', Ext.getCmp('amazon_books_searchbox_sword').getValue());
            		store.setBaseParam('ajaxID', 'tx_amazonbookslinks_tca::searchAmazon');
		
		});
		
		this.store.on('load', function() {
			Ext.get('amazon_books_searchbox_sword').removeClass('loading');
			});
	},
	
	
	initGrid : function() {

		this.actions.addBook = new Ext.Action({
					text : this.l10n.add_book,
					tooltip : this.l10n.choose_book,
					handler : this.handlers.addBook,
					iconCls : 'addItem',
					scope : this
				});
				
		var pagingToolbar = new Ext.PagingToolbar({
					pageSize: 10,
					
					store : this.store,
					displayInfo : true,
					displayMsg : this.l10n.show_books,
					emptyMsg : this.l10n.no_searchresults
				});
				
		// the columnmodel
		var columnModel = new Ext.grid.ColumnModel({
					defaults : {
						sortable : true,
						resizable : true
					},
					columns : [{
								id : 'SmallImage',
								header : this.l10n.picture,
								dataIndex : 'SmallImage',
								hidden : false,
								renderer : function(el) {
									return '<img src="' + el + '" />';
								}
							}, {
								id : 'Title',
								header : this.l10n.title,
								dataIndex : 'Title',
								hidden : false
							}, {
								id : 'Author',
								header : this.l10n.author,
								dataIndex : 'Author',
								hidden : false
							}, {
								id : 'Manufacturer',
								header : this.l10n.manufacturer,
								dataIndex : 'Manufacturer',
								hidden : false
							}, {
								id: 'ASIN',
								header: this.l10n.asin,
								dataIndex: 'ASIN',
								width: 20,
								hidden: true
							}, {
								id : 'DetailPageURL',
								header : this.l10n.detailpage,
								dataIndex : 'DetailPageURL',
								hidden : true
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
					id: 'AmazonSearchResultPanel',
					layout : 'fit',
					height : 500,
					scope : this,
					frame : true,
					tbar: pagingToolbar,
					autoSizeColumns : true,
					selModel : rowSelectionModel,
					enableColLock : false,
					loadMask : true,
					border : false,
					view : new Ext.grid.GridView({
								autoFill : true,
								forceFit : true,
								ignoreAdd : true,
								emptyText : this.l10n.no_searchresults
							})

				});
				
		gridPanel.on('rowcontextmenu',
				function(_grid, _rowIndex, _eventObject) {
					_eventObject.stopEvent();

					if (!_grid.getSelectionModel().isSelected(_rowIndex)) {
						_grid.getSelectionModel().selectRow(_rowIndex);
					}

					var contextMenu = new Ext.menu.Menu({
								items :  [ this.actions.addBook ]
							});
							
					contextMenu.showAt(_eventObject.getXY());
					
				}, this);				
				
		gridPanel.on('rowclick', function(obj) {
			if(obj) {
				record = obj.getSelectionModel().getSelected();
				if (record) {
					Axt.Amazon.previewBook(record);
				}
			}
		});
	}
};



Axt.Amazon.previewBook = function (book) {
	var win = new Ext.Window({
		width: 960,
		height: 560
	});
	win.show();
	win.update('<iframe src="' + book.data.DetailPageURL + '" height="500" width="900" />');
};



Axt.Amazon.selectBook = function (book,use_dam) {

		id = Ext.get('tx_amazonbookslinks_links_currentRecord').getValue();
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_asin').set({value: book.data.ASIN});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_title').set({value: book.data.Title});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_link').set({value: book.data.DetailPageURL});
		
		if(book.data.Creator === null) var creator = '';
		else var creator = book.data.Creator;
		
		if(book.data.Edition === null) var edition = '';
		else var edition = book.data.Edition;
		
		if(book.data.Author === null) var author = '';
		else var author = book.data.Author;
		
		if(book.data.ISBN === null) var isbn = '';
		else var isbn = book.data.ISBN;		
		
		if(book.data.Manufacturer === null) var manu = '';
		else var manu = book.data.Manufacturer;
		
		if(book.data.SmallImage === null) var si = '';
		else var si = book.data.SmallImage;

		if(book.data.MediumImage === null) var mi = '';
		else var mi = book.data.MediumImage;
		
		if(book.data.LargeImage === null) var li = '';
		else var li = book.data.LargeImage;
		
		
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_creator').set({value: creator});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_edition').set({value: edition});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_isbn').set({value: isbn});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_author').set({value: author});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_manufacturer').set({value: manu});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_small_image').set({value: si});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_medium_image').set({value: mi});
		Ext.get('data_tx_amazonbooks_domain_model_link_' + id + '_large_image').set({value: li});
		
		Ext.get('tx_amazonbookslinks_links').update('');
		Ext.get('tx_amazonbookslinks_results').update('');
		
		Axt.Amazon.indexImage(book,id,use_dam);
		
	};

	
	
Axt.Amazon.changeBook = function () {
	
	Ext.get('tx_amazonbookslinks_links').update('');
	Ext.get('tx_amazonbookslinks_results').update('');
	Axt.Amazon.initSearchBox();
	panel = Axt.Amazon.getSearchBox();
	Axt.Amazon.initStore();
	panel.render('tx_amazonbookslinks_links');
};



Axt.Amazon.indexImage = function(book,id,use_dam) {
	
  	Ext.Ajax.on('beforerequest', function() {
    		try {
    			Ext.get('tx_amazonbookslinks_ajaxloader').addClass('loading');
    		} catch (e) {
//    			alert(e);
    		}

    	});
	Ext.Ajax.on('requestcomplete', function() {
    		
    		try {
    			Ext.get('tx_amazonbookslinks_ajaxloader').removeClass('loading');
    		} catch(e) {

//    			alert(e);
    		}
    	});
	Ext.Ajax.on('requestexception', function() {
    		
    		try {
    			Ext.get('tx_amazonbookslinks_ajaxloader').removeClass('loading');
    		} catch(e) {
    			alert(e);
    		}
    		alert('Es ist ein Fehler beim Herunterladen des Bildes aufgetreten.');
    	});

	Ext.Ajax.request({
    	url: 'ajax.php',
    	params: { ajaxID: 'tx_amazonbookslinks_tca::indexImage', title: book.data.Title, img1: book.data.SmallImage, img2: book.data.MediumImage, img3: book.data.LargeImage, recId: id },
    	success: function(resp) {
    		result = Ext.decode(resp.responseText);
//    		alert(result);
    		try {
    			Ext.get('tx_amazonbookslinks_ajaxloader').removeClass('loading');
    		} catch(e) {
    			
    		}
    		if(result.image_id != null) {
//    		alert(result);
    			form = document.forms[0]; 		
    			inpname = 'data[tx_amazonbooks_domain_model_link][' + id + '][dam_image]_list';
//    			data[tx_amazonbooks_domain_model_link][NEW4ea6b30b5cc63][dam_image]
    			var el = document.getElementsByName(inpname);
    			
    			// Für DAM
    			if(use_dam) {
    				if(el) el[0].innerHTML = '<option value="tx_dam_' + result.image_id + '">' + result.file_name + '</option>';
    				inpname = 'data[tx_amazonbooks_domain_model_link][' + id + '][dam_image]';
    				var el = document.getElementsByName(inpname);
    				if(el) el[0].value = 'tx_dam_' + result.image_id;
    			} else {
    				// Für Normal
    				var fns = result.file_name.split('/');
    				var file_name = fns[fns.length-1];
    				if(el) el[0].innerHTML = '<option value="' + result.file_name + '">' + file_name + '</option>';
    				inpname = 'data[tx_amazonbooks_domain_model_link][' + id + '][dam_image]';
    				var el = document.getElementsByName(inpname);
    				if(el) el[0].value = result.file_name;
    			}
    			
//    			Axt.Amazon.renderBook(book,id,use_dam);
    		} else {
    			alert('Es konnte kein Bild heruntergeladen werden.');
    		}
    		Axt.Amazon.renderBook(book,id,use_dam);
    	}
	});
	
	
	
};



Axt.Amazon.renderBook = function (book,id,use_dam) {
	
	console.log(book.data.SmallImage);
	if(book.data.SmallImage == 'null') image = '<strong title="Klicken, um Buch bei Amazon aufzurufen" style="cursor:pointer;" id="tx_amazonbookslinks_links_image">Kein Bild des Buches bei Amazon vorhanden.</strong><br />';
	else image = '<img id="tx_amazonbookslinks_links_image" title="Klicken, um Buch bei Amazon aufzurufen" style="margin-right: 10px;cursor:pointer;border:1px;float:left" src="' + book.data.SmallImage + '" />'; 
	
	Ext.get('tx_amazonbookslinks_links').update('<div style="float:left;margin-right:10px;overflow:hidden">' +
		image +
		'<strong>Titel: </strong>' + book.data.Title + '<br />' +
		'<strong>Autor: </strong>' + book.data.Author + '<br />' +
		'<strong>Verlag: </strong>' + book.data.Manufacturer + '<br />' +
		'<strong>ISBN: </strong>' + book.data.ISBN + '<br />' +
		'<strong>Ausgabe: </strong>' + book.data.Edition + '<br />' +
		'<strong>ASIN: </strong>'  + book.data.ASIN + '<br />' +
		'</div><div><input style="float:right;clear:both" type="button" onclick="Axt.Amazon.changeBook()" value="Buch auswechseln"/>' + 
		'<input style="margin-right:10px;float:right;clear:left" id="tx_amazonbookslinks_links_image_download" type="button" value="Bild (erneut) herunterladen"/></div>' +
		'<div id="tx_amazonbookslinks_ajaxloader" style="margin-right:10px;float:right;clear:left">&nbsp;</div>'
		);
		
	Ext.get('tx_amazonbookslinks_links_image_download').on('click',function() {
		Axt.Amazon.indexImage(book,id,use_dam);
	});
		
	Ext.get('tx_amazonbookslinks_links_image').on('click', function() {
		Axt.Amazon.previewBook(book);
		}
	);
};


