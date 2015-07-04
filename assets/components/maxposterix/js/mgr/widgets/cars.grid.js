maxPosterix.grid.Cars = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'maxposterix-grid-cars';
	}
	Ext.applyIf(config, {
		url: maxPosterix.config.connector_url,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		tbar: this.getTopBar(config),
		sm: new Ext.grid.CheckboxSelectionModel(),
		baseParams: {
			action: 'mgr/car/getlist'
		},
		listeners: {
			rowDblClick: function (grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateCar(grid, e, row);
			}
		},
		viewConfig: {
			forceFit: true,
			enableRowBody: true,
			autoFill: true,
			showPreview: true,
			scrollOffset: 0,
			getRowClass: function (rec, ri, p) {
				return !rec.data.active
					? 'maxposterix-grid-row-disabled'
					: '';
			}
		},
		paging: true,
		remoteSort: true,
		autoHeight: true,
	});
	maxPosterix.grid.Cars.superclass.constructor.call(this, config);

	// Clear selection on grid refresh
	this.store.on('load', function () {
		if (this._getSelectedIds().length) {
			this.getSelectionModel().clearSelections();
		}
	}, this);
};
Ext.extend(maxPosterix.grid.Cars, MODx.grid.Grid, {
	windows: {},

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();

		var row = grid.getStore().getAt(rowIndex);
		var menu = maxPosterix.utils.getMenu(row.data['actions'], this, ids);

		this.addContextMenuCar(menu);
	},

	createCar: function (btn, e) {
		var w = MODx.load({
			xtype: 'maxposterix-car-window-create',
			id: Ext.id(),
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		});
		w.reset();
		w.setValues({active: true});
		w.show(e.target);
	},

	updateCar: function (btn, e, row) {
		if (typeof(row) != 'undefined') {
			this.menu.record = row.data;
		}
		else if (!this.menu.record) {
			return false;
		}
		var id = this.menu.record.id;

		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/car/get',
				id: id
			},
			listeners: {
				success: {
					fn: function (r) {
						var w = MODx.load({
							xtype: 'maxposterix-car-window-update',
							id: Ext.id(),
							record: r,
							listeners: {
								success: {
									fn: function () {
										this.refresh();
									}, scope: this
								}
							}
						});
						w.reset();
						w.setValues(r.object);
						w.show(e.target);
					}, scope: this
				}
			}
		});
	},

	removeCar: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.msg.confirm({
			title: ids.length > 1
				? _('maxposterix_cars_remove')
				: _('maxposterix_car_remove'),
			text: ids.length > 1
				? _('maxposterix_cars_remove_confirm')
				: _('maxposterix_car_remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/car/remove',
				ids: Ext.util.JSON.encode(ids),
			},
			listeners: {
				success: {
					fn: function (r) {
						this.refresh();
					}, scope: this
				}
			}
		});
		return true;
	},

	disableCar: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/car/disable',
				ids: Ext.util.JSON.encode(ids),
			},
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		})
	},

	enableCar: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/car/enable',
				ids: Ext.util.JSON.encode(ids),
			},
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		})
	},

	getFields: function (config) {
		return ['id', 'resource_id', 'maxposter_id', 'active', 'actions'];
	},

	getColumns: function (config) {
		return [{
			header: _('maxposterix_car_id'),
			dataIndex: 'id',
			sortable: true,
			width: 70
		}, {
			header: _('maxposterix_car_resource_id'),
			dataIndex: 'resource_id',
			sortable: true,
			width: 200,
		}, {
			header: _('maxposterix_car_maxposter_id'),
			dataIndex: 'maxposter_id',
			sortable: false,
			width: 250,
		}, {
			header: _('maxposterix_car_active'),
			dataIndex: 'active',
			renderer: maxPosterix.utils.renderBoolean,
			sortable: true,
			width: 100,
		}, {
			header: _('maxposterix_car_actions'),
			dataIndex: 'actions',
			renderer: maxPosterix.utils.renderActions,
			sortable: false,
			width: 100,
			id: 'actions'
		}];
	},

	getTopBar: function (config) {
		return [{
			text: '<i class="icon icon-refresh"></i>&nbsp;' + _('maxposterix_btn_export'),
			handler: this.createCar,
			scope: this
		}, '->', {
			xtype: 'textfield',
			name: 'query',
			width: 200,
			id: config.id + '-search-field',
			emptyText: _('maxposterix_grid_search'),
			listeners: {
				render: {
					fn: function (tf) {
						tf.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
							this._doSearch(tf);
						}, this);
					}, scope: this
				}
			}
		}, {
			xtype: 'button',
			id: config.id + '-search-clear',
			text: '<i class="icon icon-times"></i>',
			listeners: {
				click: {fn: this._clearSearch, scope: this}
			}
		}];
	},

	onClick: function (e) {
		var elem = e.getTarget();
		if (elem.nodeName == 'BUTTON') {
			var row = this.getSelectionModel().getSelected();
			if (typeof(row) != 'undefined') {
				var action = elem.getAttribute('action');
				if (action == 'showMenu') {
					var ri = this.getStore().find('id', row.id);
					return this._showMenu(this, ri, e);
				}
				else if (typeof this[action] === 'function') {
					this.menu.record = row.data;
					return this[action](this, e);
				}
			}
		}
		return this.processEvent('click', e);
	},

	_getSelectedIds: function () {
		var ids = [];
		var selected = this.getSelectionModel().getSelections();

		for (var i in selected) {
			if (!selected.hasOwnProperty(i)) {
				continue;
			}
			ids.push(selected[i]['id']);
		}

		return ids;
	},

	_doSearch: function (tf, nv, ov) {
		this.getStore().baseParams.query = tf.getValue();
		this.getBottomToolbar().changePage(1);
		this.refresh();
	},

	_clearSearch: function (btn, e) {
		this.getStore().baseParams.query = '';
		Ext.getCmp(this.config.id + '-search-field').setValue('');
		this.getBottomToolbar().changePage(1);
		this.refresh();
	}
});
Ext.reg('maxposterix-grid-cars', maxPosterix.grid.Cars);
