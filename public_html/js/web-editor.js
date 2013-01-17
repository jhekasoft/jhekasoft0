/*
 * WYSIWYG-редакторы
 */
var WebEditor = {
    tinymceUrl : '/js/tiny_mce/tiny_mce.js',
    elfinderTinymceUrl : '/application/web-editor/elfinder-tinymce',
    elfinderCkeditorUrl : '/application/web-editor/elfinder-ckeditor',
    
    elFinderBrowser : function(field_name, url, type, win) {
        var elfinder_url = WebEditor.elfinderTinymceUrl;    // use an absolute path!
        tinyMCE.activeEditor.windowManager.open({
            file: elfinder_url,
            title: 'elFinder 2.0',
            width: 900,  
            height: 450,
            resizable: 'yes',
            inline: 'yes',    // This parameter only has an effect if you use the inlinepopups plugin!
            popup_css: false, // Disable TinyMCE's default popup CSS
            close_previous: 'no'
        }, {
            window: win,
            input: field_name
        });
        return false;
    },
    
    tinyMceInit : function(selector) {
        $(selector).tinymce({
            // Location of TinyMCE script
            script_url : WebEditor.tinymceUrl,

            // General options
            schema: "html5",
            language : "ru",
            theme : "advanced",
            skin : "o2k7",
            skin_variant : "silver",
            convert_urls : false,
            visualblocks_default_state: true,

            // End container block element when pressing enter inside an empty block
            end_container_on_empty_block: true,


            plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // HTML5 formats
            style_formats : [
                    {title : 'h1', block : 'h1'},
                    {title : 'h2', block : 'h2'},
                    {title : 'h3', block : 'h3'},
                    {title : 'h4', block : 'h4'},
                    {title : 'h5', block : 'h5'},
                    {title : 'h6', block : 'h6'},
                    {title : 'p', block : 'p'},
                    {title : 'div', block : 'div'},
                    {title : 'pre', block : 'pre'},
                    {title : 'section', block : 'section', wrapper: true, merge_siblings: false},
                    {title : 'article', block : 'article', wrapper: true, merge_siblings: false},
                    {title : 'blockquote', block : 'blockquote', wrapper: true},
                    {title : 'hgroup', block : 'hgroup', wrapper: true},
                    {title : 'aside', block : 'aside', wrapper: true},
                    {title : 'figure', block : 'figure', wrapper: true}
            ],

            file_browser_callback : 'WebEditor.elFinderBrowser'
        });

        $('.textarea_select_editor').hide();
    },
    
    ckEditorInit : function(inputSelector, buttonSelector) {
        $(inputSelector).ckeditor({
            filebrowserBrowseUrl : WebEditor.elfinderCkeditorUrl
        });

        $(buttonSelector).hide();
    }
};
