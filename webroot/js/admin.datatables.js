(function($, AdminJs, Backbone) {

    if (typeof AdminJs === "undefined") {
        console.warn("AdminJs DataTables: AdminJs object not found");
        return false;
    }

    function buildBooleanLabel(state, labelTrue, labelFalse, clazzTrue, clazzFalse) {
        clazzTrue = clazzTrue || 'primary';
        clazzFalse = clazzFalse || 'default';
        var isTrue = (state === true || state === "true" || state === 1) ? true : false;
        var clazz = (isTrue) ? clazzTrue : clazzFalse;
        var label = (isTrue) ? labelTrue : labelFalse;
        return '<span class="label label-'+clazz+'">'+label+'</span>';
    }

    function renderBoolean(data, type) {

        if (type === 'display') {
            return buildBooleanLabel(data, "True", "False");
        }
        return data;
    }

    function renderBooleanOnOff(data, type) {

        if (type === 'display') {
            return buildBooleanLabel(data, "On", "Off");
        }
        return data;
    }

    function renderBooleanYesNo(data, type) {

        if (type === 'display') {
            return buildBooleanLabel(data, "Yes", "No", "success", "danger");
        }
        return data;
    }

    function renderBooleanEnabled(data, type) {

        if (type === 'display') {
            return buildBooleanLabel(data, "Enabled", "Disabled");
        }
        return data;
    }

    function renderBooleanCheckIcon(data, type) {

        if (type === 'display') {
            if (data == true) {
                return '<span class="text-success">' + AdminJs.Ui.Icon.create('check') + '</span>';
            } else {
                return '<span class="text-danger">' + AdminJs.Ui.Icon.create('close') + '</span>';
            }
        }
        return data;
    }

    function renderDate(data, type) {
        if (type === 'display') {
            var d = new Date(data);
            if (d instanceof Date && isFinite(d)) {
                var datestring = ("0" + d.getDate()).slice(-2) + "." + ("0"+(d.getMonth()+1)).slice(-2) + "." +
                    d.getFullYear();

                return '<span class="datetime" data-value="' + data + '">' + datestring + '</span>';
            }
        }
        return data;
    }

    function renderDateTime(data, type) {
        if (type === 'display') {
            var d = new Date(data);
            if (d instanceof Date && isFinite(d)) {
                var datestring = ("0" + d.getDate()).slice(-2) + "." + ("0" + (d.getMonth() + 1)).slice(-2) + "." +
                    d.getFullYear() + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2);

                return '<span class="datetime" data-value="' + data + '">' + datestring + '</span>';
            }
        }
        return data;
    }

    function renderTimeAgoInWordsUTC(data, type) {
        if (type === 'display') {
            if (data) {
                return moment.utc(data).fromNow();
            }
            return 'Never';
        }
        return data;
    }

    function renderTimeDiffInWordsUTC(data, type) {
        if (type === 'display') {
            if (data) {
                return moment.utc(data).fromNow();
            }
            return 'Never';
        }
        return data;
    }

    function renderTimeDiffShortUTC(data, type) {
        if (type === 'display') {
            if (data) {
                var now = moment.utc();
                var time = moment.utc(data);

                var diff = now.diff(time, 'minutes');
                if (diff < 1) {
                    return '< 1 min'
                } else if (diff < 120) {
                    return time.diff(now, 'minutes') + ' min'
                } else if (diff < (60 * 24)) {
                    return time.diff(now, 'hours') + ' hours'
                } else if (diff < (60 * 24 * 30)) {
                    return time.diff(now, 'days') + ' days'
                } else if (diff < (60 * 24 * 365)) {
                    return time.diff(now, 'months') + ' months'
                } else {
                    return time.diff(now, 'years', true) + ' years'
                }
            }
            return 'Never';
        }
        return data;
    }

    function renderStatus (data, type) {
        if (type == 'display') {
            var clazz;
            switch (data) {
                case "OK": clazz = "success"; break;
                case "WARN": clazz = "warn"; break;
                case "ERROR": clazz = "danger"; break;
                default: clazz = "default"; break;
            }
            return AdminJs.Ui.Label.create(data, clazz)
        }
        return data;
    }

    function renderRowActionsDropdown(data, type) {
        if (type == 'display') {
            var html = "";
            html += "<ul class='actions-menu'>";
            _.each(data, function(row, idx) {
                row = _.extend({}, {url: 'alert("Broken Link");', icon: 'link', title: 'No Title', 'class': ''}, row);
                html += '<li><a href="'+row.url+'" class="'+row.class+'" data-icon="'+row.icon+'">'+row.title+'</a></li>';
            });
            html += "</ul>";
            return html;
        }
        return data;
    }

    function renderRowActionsButton(data, type) {
        if (type == 'display') {

            var $container = $('<span>', {'class': 'actions-btn-group'});
            _.each(data, function(row, idx) {
                row = _.extend({}, {url: 'alert("Broken Link");', icon: 'link', title: 'Untitled', 'class': 'btn btn-default btn-xs'}, row);
                var icon = row.icon;
                var url = row.url;
                var attrs = _.extend({}, {href: url, 'data-icon': icon, 'class': 'btn btn-xs'}, _.omit(row, ['url', 'icon']));
                $('<a>', attrs).html(row.title).appendTo($container);
            });
            return $container.prop('outerHTML');
        }
        return data;
    }

    function renderRowActionsIcon(data, type) {
        if (type == 'display') {
            var $container = $('<span>', {'class': 'actions-btn-group'});
            _.each(data, function(row, idx) {
                row = _.extend({}, {url: 'alert("Broken Link");', icon: 'link', title: 'Untitled', 'class': 'btn btn-default btn-xs'}, row);
                var icon = row.icon;
                var url = row.url;
                var attrs = _.extend({}, {href: url}, _.omit(row, ['url', 'icon']));
                var $icon = $('<i>', {'class': 'fa fa-'+row.icon });
                $('<a>', attrs).html($icon).appendTo($container);
            });
            return $container.prop('outerHTML');
        }
        return data;
    }

    function renderCurrency(data, type)
    {
        if (type == 'display') {
            return parseFloat(data).toFixed(2);
        }
        return data;
    }

    function renderCryptoCurrency(data, type)
    {
        if (type == 'display') {
            return parseFloat(data).toFixed(8);
        }
        return data;
    }

    function handleCurrency(cell) {
        $(cell).addClass('actions').addClass('text-right');
    }

    function handleRowActions(cell) {
        $(cell).addClass('actions').addClass('text-right');
    }

    AdminJs.DataTablesHelper = {

        // Helper methods
        'buildBooleanLabel': buildBooleanLabel,

        // Render handlers
        'renderBoolean': renderBoolean,
        'renderBooleanYesNo': renderBooleanYesNo,
        'renderBooleanOnOff': renderBooleanOnOff,
        'renderBooleanEnabled': renderBooleanEnabled,
        'renderBooleanCheckIcon': renderBooleanCheckIcon,
        'renderDate': renderDate,
        'renderDateTime': renderDateTime,
        'renderTimeAgoInWords': renderTimeAgoInWordsUTC,
        'renderTimeDiffInWordsUTC': renderTimeDiffInWordsUTC,
        'renderTimeDiffShortUTC': renderTimeDiffShortUTC,
        'renderStatus': renderStatus,
        'renderRowActions': renderRowActionsDropdown, //@deprecated Use 'renderRowActionsDropdown' instead
        'renderRowActionsDropdown': renderRowActionsDropdown,
        'renderRowActionsButton': renderRowActionsButton,
        'renderRowActionsIcon': renderRowActionsIcon,

        'renderCurrency': renderCurrency,
        'renderCryptoCurrency': renderCryptoCurrency,

        // CreateCell handlers
        'handleRowActions': handleRowActions,
        'handleCurrency': handleCurrency
    };


    AdminJs.DataTablesView = Backbone.View.extend({

        events: {
           'resize': function() {
               console.log('resize!')
           }
        },

        initialize: function(settings) {
            this.settings = settings;
            this._dataTable = settings.dataTable || {};
            this._dataUrl = settings.dataUrl || null;
            this._dataReload = settings.dataReload || -1;
        },

        _addTooltips: function(dataTable, $table) {
            dataTable.columns().iterator('column', function (settings, column) {
                if (settings.aoColumns[column].tooltip !== undefined) {
                    $(dataTable.column(column).header()).attr('title', settings.aoColumns[column].tooltip);
                    $(dataTable.column(column).header()).attr('data-toogle', "tooltip");
                }
            });
            $table.find('th').tooltip({
                placement: 'bottom',
                container: 'body'
            });
        },

        render: function() {

            $.fn.dataTable.ext.errMode = 'none';

            var self = this;
            var $table = $('<table>', {
                'class': 'table table-striped table-condensed table-hover datatable'
            });
            $table.on( 'draw.dt', function() {
                //console.log("Draw complete");
                AdminJs.Renderer.trigger('docready', self.$el);

            });
            $table.on( 'error.dt', function ( e, settings, techNote, message ) {
                console.warn( 'An error has been reported by DataTables: ', message, techNote );
                //alert("DataTables Error: " + message);
            } );
            this.$el.html($table);

            var settings = _.extend({}, this._dataTable, {
                ajax: this._dataUrl,
                drawCallback: function() {
                    var api = this.api();
                    console.log( "Rendered rows: " + api.rows().count());

                    self.trigger('backend.dt.draw', this);
                }
            });
            this._dt = $table.DataTable(settings);
            //console.log(this._dt.columns());
            this._addTooltips(this._dt, $table);

            if (this._dataReload > 0) {
                this.clearTimer();
                this._dtTimer = setInterval( function () {
                    self._dt.ajax.reload(function() { /*console.log("DataTable reloaded");*/ }, false); // user paging is not reset on reload
                }, this._dataReload );
            }

            return this;
        },

        clearTimer: function() {
            if (this._dtTimer) {
                clearInterval(this._dtTimer)
            }
        },

        close: function() {
            this.clearTimer();
        }
    });

})(jQuery, AdminJs, Backbone);