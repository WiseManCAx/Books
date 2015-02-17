Ext.regController("categories", {
    show: function(options) {

        var store = Ext.getStore('categories'),
            id = parseInt(options.id),
            obj = store.getById(id);

        if (obj) {
            this.render({
                xtype: 'postsList',
                store:  obj.posts()
            }, 'viewport');
        }

    }
});
