Ext.regController("posts", {
    show: function(options) {

        var store = Ext.getStore('posts'),
            id = parseInt(options.id),
            obj = store.getById(id);

        if (obj) {
            this.render({
                xtype: 'postsDetail',
                data:  obj.data
            }, 'viewport');
        }

    }
});
