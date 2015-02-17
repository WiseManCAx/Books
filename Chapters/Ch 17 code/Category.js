Ext.regModel("Category", {
    fields: [
        {name: "id", type: "int"},
        {name: "title", type: "string"}
    ],
    hasMany: {
        model: 'Post',
        name: 'posts'
    }
});

Ext.regStore('categories', {
    model: 'Category',
    autoLoad: true,

    proxy: {
        type: 'ajax',
        url: '/?ajax=categories',
        reader: {
            type: 'json',
            root: 'categories'
        }
    }

});
