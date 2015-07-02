maxPosterix.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'maxposterix-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('maxposterix') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('maxposterix_items'),
				layout: 'anchor',
				items: [{
					html: _('maxposterix_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'maxposterix-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	maxPosterix.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(maxPosterix.panel.Home, MODx.Panel);
Ext.reg('maxposterix-panel-home', maxPosterix.panel.Home);
