maxPosterix.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'maxposterix-panel-home', renderTo: 'maxposterix-panel-home-div'
		}]
	});
	maxPosterix.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(maxPosterix.page.Home, MODx.Component);
Ext.reg('maxposterix-page-home', maxPosterix.page.Home);