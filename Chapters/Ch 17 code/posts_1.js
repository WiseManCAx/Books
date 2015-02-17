Ext.reg("postsList", Ext.extend(Ext.List, {

    store: 'posts',
    itemTpl: [
        '<tpl for=".">',
            '{title}',
            '<br/><small>{date} by {user}</small>',
        '</tpl>'
    ],
    listeners: {
        selectionchange: function(selectionModel, records) {
            if (records.length>0) {
                Ext.dispatch({
                    controller:'posts',
                    action:'show',
                    id: records[0].getId(),
                    historyUrl: 'posts/show/' + records[0].getId()
                });
            }
        }
    }

}));


Ext.reg("postsDetail", Ext.extend(Ext.Panel, {
    data: null,
    tpl: [
        '<tpl for=".">',
            '<h2>{title}</h2>',
            '<p><small>{date} by {user}</small></p>',
            '{body}',
        '</tpl>'
    ],
    scroll: 'vertical'
}));
