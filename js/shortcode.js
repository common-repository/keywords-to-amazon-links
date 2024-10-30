(function() {
    tinymce.create('tinymce.plugins.wpse72394_plugin', {
        init : function(ed, url) {
            ed.addButton('wpse72394_button', {
                title : 'Bib Form Creator',
                image : url+'/cnrclient.png',
                onclick : function() {
                    if(image_url = prompt("Background Image URL", "http://"))
                    {
                        if (image_url != null && image_url != '')
                            ed.execCommand('mceInsertContent', false, '[ns_bib_form]'+image_url+'[/ns_bib_form]');
                        else
                            ed.execCommand('mceInsertContent', false, '[ns_bib_form]BACKGROUND-IMAGE-URL-HERE[/ns_bib_form]');
                    }
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Bib Form Creator",
                author : 'Nate Sanden',
                authorurl : 'http://www.natesanden.com',
                infourl : '',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('wpse72394_button', tinymce.plugins.wpse72394_plugin);
})();