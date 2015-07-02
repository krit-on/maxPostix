var maxPosterix = function (config) {
	config = config || {};
	maxPosterix.superclass.constructor.call(this, config);
};
Ext.extend(maxPosterix, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('maxposterix', maxPosterix);

maxPosterix = new maxPosterix();