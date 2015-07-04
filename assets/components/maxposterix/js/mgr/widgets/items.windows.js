maxPosterix.window.CreateCar = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'maxposterix-car-window-create';
	}
	Ext.applyIf(config, {
		title: _('maxposterix_car_create'),
		width: 550,
		autoHeight: true,
		url: maxPosterix.config.connector_url,
		action: 'mgr/car/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	maxPosterix.window.CreateCar.superclass.constructor.call(this, config);
};
Ext.extend(maxPosterix.window.CreateCar, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'textfield',
			fieldLabel: _('maxposterix_car_resource_id'),
			name: 'resource_id',
			id: config.id + '-resource_id',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('maxposterix_car_maxposter_id'),
			name: 'maxposter_id',
			id: config.id + '-maxposter_id',
			height: 150,
			anchor: '99%'
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('maxposterix_car_active'),
			name: 'active',
			id: config.id + '-active',
			checked: true,
		}];
	}

});
Ext.reg('maxposterix-car-window-create', maxPosterix.window.CreateCar);


maxPosterix.window.UpdateCar = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'maxposterix-car-window-update';
	}
	Ext.applyIf(config, {
		title: _('maxposterix_car_update'),
		width: 550,
		autoHeight: true,
		url: maxPosterix.config.connector_url,
		action: 'mgr/car/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	maxPosterix.window.UpdateCar.superclass.constructor.call(this, config);
};
Ext.extend(maxPosterix.window.UpdateCar, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id',
		}, {
			xtype: 'textfield',
			fieldLabel: _('maxposterix_car_resource_id'),
			name: 'resource_id',
			id: config.id + '-resource_id',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('maxposterix_car_maxposter_id'),
			name: 'maxposter_id',
			id: config.id + '-maxposter_id',
			anchor: '99%',
			height: 150,
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('maxposterix_car_active'),
			name: 'active',
			id: config.id + '-active',
		}];
	}

});
Ext.reg('maxposterix-car-window-update', maxPosterix.window.UpdateCar);