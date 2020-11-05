// jQuery Plugin Boilerplate
// A boilerplate for jumpstarting jQuery plugins development
// version 1.1, May 14th, 2011
 
// for this plugin to use, your controller function should 
//have parameter page number and function should return current page
//total page number.
(function($) {
 
    var pluginName = 'animateDivOnScroll';

    $[pluginName] = function(element, options) {
 
        // plugin's default options
        // this is private property and is  accessible only from inside the plugin
        var defaults = {
            effect: "bounceIn",
            scrollVal: 500,
            // beforePagination: function() {},
            // afterPagination: function() {},
            // populateFn: function(){}
        }
 
        // to avoid confusions, use "plugin" to reference the 
        // current instance of the object
        var plugin = this;
 
        // this will hold the merged default, and user-provided options
        // plugin's properties will be available through this object like:
        // plugin.settings.propertyName from inside the plugin or
        // element.data(pluginName).settings.propertyName from outside the plugin, 
        // where "element" is the element the plugin is attached to;
        plugin.settings = {}
 
        var $element = $(element), // reference to the jQuery version of DOM element
             element = element;    // reference to the actual DOM element
 
        // the "constructor" method that gets called when the object is created
        plugin.init = function() {

            // the plugin's final properties are the merged default and 
            // user-provided options (if any)
            plugin.settings = $.extend({},defaults, options);
            // $(window).unbind('scroll');
            $(window).scroll(function() {
                var elemPos = $element.offset().top;
                var topOfWindow = $(window).scrollTop();
                if (elemPos < topOfWindow + plugin.settings.scrollVal) {
                    $element.removeClass('transparentDiv').addClass(plugin.settings.effect);
                    return;
                }
            });
        }
 
        // public methods
        // these methods can be called like:
        // plugin.methodName(arg1, arg2, ... argn) from inside the plugin or
        // element.data(pluginName).publicMethod(arg1, arg2, ... argn) from outside 
        // the plugin, where "element" is the element the plugin is attached to;

        // plugin.updateTablePaging = function(table, pagingData) {

        //     table.attr({
        //         'data-c_p':pagingData.currentPage,
        //         'data-t_p':pagingData.pageCount
        //     });
        // }

        // private methods
        // these methods can be called only from inside the plugin like:
        // methodName(arg1, arg2, ... argn)
        // function for updating the table pagiation data.

        // var paginateDataTable = function(pageNumber, apiurl) {

        //     pageNumber = parseInt(pageNumber)+1;
        //     var splitUrl = apiurl.split('.json');
        //     var apiurl = splitUrl[0]+'/'+pageNumber+'.json';
        //     var data = "";

        //     $.ajax({

        //         url:apiurl,
        //         dataType:'jsonp',
        //         async:false,
        //         success:function(res)
        //         {
        //             data = res;
        //         }
        //     });

        //     return data;
        // }

        // var paginateFilterDataTable = function(pageNumber, apiurl, postData) {

        //     pageNumber = parseInt(pageNumber)+1;
        //     var splitUrl = apiurl.split('.');
        //     var apiurl = splitUrl[0]+'/'+pageNumber+'.'+splitUrl[1];
        //     var data = "";

        //     $.ajax({

        //         url:apiurl,
        //         type:'post',
        //         dataType:'jsonp',
        //         data:postData,
        //         async:false,
        //         success:function(res)
        //         {
        //             data = res;
        //         }
        //     });

        //     return data;
        // }
 
        // fire up the plugin!
        // call the "constructor" method
        plugin.init();
 
    }
 
    // add the plugin to the jQuery.fn object
    $.fn[pluginName] = function(options) {
 
        // iterate through the DOM elements we are attaching the plugin to
        return this.each(function() {

            // if plugin has not already been attached to the element
            if (undefined == $(this).data(pluginName)) {
 
                // create a new instance of the plugin
                // pass the DOM element and the user-provided options as arguments
                var plugin = new $[pluginName](this, options);
 
                // in the jQuery version of the element
                // store a reference to the plugin object
                // you can later access the plugin and its methods and properties like
                // element.data(pluginName).publicMethod(arg1, arg2, ... argn) or
                // element.data(pluginName).settings.propertyName
                $(this).data(pluginName, plugin);
            } else {
                // var tempSettigns = $(this).data(pluginName).settings;

                // if (tempSettigns['filter']) {
                //     var newOptions = $.extend(tempSettigns, options);
                //     var plugin = new $[pluginName](this, newOptions);
                //     $(this).data(pluginName, plugin);
                // }

            }
 
        }); 
    }
 
})(jQuery);