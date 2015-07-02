maxPosterix.window.CreateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'maxposterix-item-window-create';
	}
	Ext.applyIf(config, {
		title: _('maxposterix_item_create'),
		width: 550,
		autoHeight: true,
		url: maxPosterix.config.connector_url,
		action: 'mgr/item/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	maxPosterix.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(maxPosterix.window.CreateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'textfield',
			fieldLabel: _('maxposterix_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('maxposterix_item_description'),
			name: 'description',
			id: config.id + '-description',
			height: 150,
			anchor: '99%'
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('maxposterix_item_active'),
			name: 'active',
			id: config.id + '-active',
			checked: true,
		}];
	}

});
Ext.reg('maxposterix-item-window-create', maxPosterix.window.CreateItem);


maxPosterix.window.UpdateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'maxposterix-item-window-update';
	}
	Ext.applyIf(config, {
		title: _('maxposterix_item_update'),
		width: 550,
		autoHeight: true,
		url: maxPosterix.config.connector_url,
		action: 'mgr/item/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	maxPosterix.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(maxPosterix.window.UpdateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id',
		}, {
			xtype: 'textfield',
			fieldLabel: _('maxposterix_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('maxposterix_item_description'),
			name: 'description',
			id: config.id + '-description',
			anchor: '99%',
			height: 150,
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('maxposterix_item_active'),
			name: 'active',
			id: config.id + '-active',
		}];
	}

});
Ext.reg('maxposterix-item-window-update', maxPosterix.window.UpdateItem);