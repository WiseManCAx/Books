Ext.regModel("Post", {
    fields: [
        {name: "id", type: "int"},
        {name: "title", type: "string"},
        {name: "body", type: "string"},
        {name: "date", type: "string"},
        {name: "user", type: "string"}
    ]
});

Ext.regStore('posts', {
    model: 'Post',
    autoLoad: true,

    proxy: {
        type: 'ajax',
        url: '/?ajax=posts',
        reader: {
            type: 'json',
            root: 'posts'
        }
    }

});
