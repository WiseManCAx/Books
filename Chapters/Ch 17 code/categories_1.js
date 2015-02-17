Ext.reg("categoriesList", Ext.extend(Ext.List, {

    store: 'categories',
    itemTpl: '<tpl for=".">{title}</tpl>',

    listeners: {
        selectionchange: function(selectionModel, records) {
            if (records.length>0) {
                Ext.dispatch({
                    controller:'categories',
                    action:'show',
                    id: records[0].getId(),
                    historyUrl: 'categories/show/' + records[0].getId()
                });
            }
        }
    }

}));
