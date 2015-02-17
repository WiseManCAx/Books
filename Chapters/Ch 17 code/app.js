new Ext.Application({
    defaultTarget: "viewport",

    launch: function() {
        new Ext.Panel({
            id        : 'viewport',
            layout    : 'card',
            fullscreen: true,

            dockedItems: [{
                xtype: 'toolbar',
                title: 'WordPress'
            }, {
                xtype: 'categoriesList',
                dock: 'left'
            }]

        });
    }
});
