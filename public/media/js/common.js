var TableElements = function () {
    // Switchery
    var _componentSwitchery = function () {
        if (typeof Switchery == 'undefined') {
            // console.warn('Warning - switchery.min.js is not loaded.');
            return;
        }

        // Initialize multiple switches
        var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
        elems.forEach(function (html) {
            if (!$(html).attr("data-switchery")) {
                var switchery = new Switchery(html);
            }
        });
    };

    return {
        init: function () {
            _componentSwitchery();
        }
    }
}();
var Select2Selects = function () {
    var _componentSelect2 = function () {
        if (!$().select2) {
            // console.warn('Warning - select2.min.js is not loaded.');
            return;
        }
        $('.select-search').select2();
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });
        $('.select-fixed-single').select2({
            minimumResultsForSearch: Infinity,
            width: 150
        });

        function iconFormat(icon) {
            var originalOption = icon.element;
            if (!icon.id) {
                return icon.text;
            }
            var $icon = '<i class="icon-' + $(icon.element).data('icon') + '"></i>' + icon.text;

            return $icon;
        }
        $('.select-icons').select2({
            templateResult: iconFormat,
            minimumResultsForSearch: Infinity,
            templateSelection: iconFormat,
            width: 200,
            escapeMarkup: function (m) {
                return m;
            }
        });
    };
    return {
        init: function () {
            _componentSelect2();
        }
    }
}();
var BootstrapMultiselect = function () {
    var _componentMultiselect = function () {
        if (!$().multiselect) {
            // console.warn('Warning - bootstrap-multiselect.js is not loaded.');
            return;
        }
        var multiselectParams = {
            "multiselect-clickable-groups": {
                enableClickableOptGroups: true
            },
            "multiselect-filtering": {
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                nonSelectedText: '---',
                allSelectedText: 'Todo',
                //includeSelectAllOption: true,
            },
            "multiselect-filtering-all": {
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                nonSelectedText: '---',
                allSelectedText: 'Todos',
                includeSelectAllOption: true,
            },
            "multiselect-simulate-selections": {
                onChange: function (option, checked) {
                    var values = [];
                    $('.multiselect-simulate-selections option').each(function () {
                        if ($(this).val() !== option.val()) {
                            values.push($(this).val());
                        }
                    });
                    $('.multiselect-simulate-selections').multiselect('deselect', values);
                }
            }
        };
        var multiselectDefaultParams = {
            nonSelectedText: 'false',
        };

        $('select.multiselect').filter(function () {
            return !$(this).parents().hasClass("multiselect-native-select");
        }).each(function () {
            var isSingle = !$(this).prop('multiple') || $(this).attr('multiple') != 'multiple';
            var placeholder = $(this).attr('data-placeholder');
            var params = multiselectDefaultParams;
            var classes = $(this).attr('class').split(/\s+/);
            for (var i in classes) {
                if (typeof multiselectParams[classes[i]] != "undefined") {
                    params = multiselectParams[classes[i]];
                    break;
                }
            }
            if (isSingle) {
                $(this).val(undefined);
            }
            $(this).multiselect(params);

            if (isSingle) {
                $(this).closest(".multiselect-native-select").find('.multiselect-selected-text').text(typeof placeholder != 'undefined' ? placeholder : '---');
            }
        });
    };
    var _componentUniform = function (element) {
        if (!$().uniform) {
            // console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }
        $('.form-control-uniform').uniform();

        $('.check-primary').uniform({
            wrapperClass: 'border-primary text-primary'
        });
    };
    return {
        init: function () {
            _componentMultiselect();
            _componentUniform();
        }
    }
}();
var TagInputs = function () {
    var _componentTokenfield = function () {
        if (!$().tokenfield) {
            // console.warn('Warning - tokenfield.min.js is not loaded.');
            return;
        }
        $('input.tokenfield').filter(function () {
            return !$(this).parents().hasClass("tokenfield");
        }).tokenfield();

        //Custom Color
        $('.tokenfield-primary').on('tokenfield:initialize', function (e) {
            $(this).parent().find('.token').addClass('bg-primary text-white');
        });
        $('.tokenfield-primary').tokenfield();
        $('.tokenfield-primary').on('tokenfield:createdtoken', function (e) {
            $(e.relatedTarget).addClass('bg-primary text-white');
        });
    };
    var _componentTagsinput = function () {
        if (!$().tagsinput) {
            // console.warn('Warning - tagsinput.min.js is not loaded.');
            return;
        }
        $('.tags-input').tagsinput();
    };

    return {
        init: function () {
            _componentTokenfield();
            _componentTagsinput();
        }
    }
}();

var InputsCheckboxesRadios = function () {
    var _componentBootstrapSwitch = function () {
        if (!$().bootstrapSwitch) {
            //console.warn('Warning - switch.min.js is not loaded.');
            return;
        }
        $('.form-check-input-switch').bootstrapSwitch();
    };
    var _componentUniform = function () {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }
        $('.form-check-input-styled').uniform();
    };
    return {
        initComponents: function () {
            _componentBootstrapSwitch();
            _componentUniform();
        }
    }
}();

var Summernote = function () {
    var _componentSummernote = function () {
        if (!$().summernote) {
            // console.warn('Warning - summernote.min.js is not loaded.');
            return;
        }

        $('.summernote').summernote({
            disableDragAndDrop: true,
            height: 120,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['strikethrough', 'superscript', 'subscript']],
                // ['fontsize', ['fontsize']],
                // ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                // ['height', ['height']]
            ],

        });
    };
    // Uniform
    var _componentUniform = function () {
        if (!$().uniform) {
            // console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Styled file input
        $('.note-image-input').uniform({
            fileButtonClass: 'action btn bg-warning-400'
        });
    };
    return {
        init: function () {
            _componentSummernote();
            _componentUniform();
        }
    }
}();

var componentFileUpload = function () {
    var _componentFileUpload = function () {
        if (!$().fileinput) {
            console.warn('Warning - fileinput.min.js is not loaded.');
            return;
        }
        // Modal template
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header align-items-center">\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '      <div class="kv-zoom-actions btn-group">{close}</div>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';
        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            close: 'btn btn-light btn-icon btn-sm'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            close: '<i class="icon-cross2 font-size-base"></i>'
        };

        // File actions
        var fileActionSettings = {
            zoomClass: '',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'p-2',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: '',
            removeErrorClass: 'text-danger',
            removeIcon: '<i class="icon-bin"></i>',
            //indicatorNew: '<i class="icon-file-plus text-success"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };

        $('.file-input').fileinput({
            browseLabel: 'Añadir',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "Subir un archivo",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });
        $('.upload-file').fileinput({
            browseLabel: 'Añadir',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "Selecciona un archivo",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });
        $('.file-input-ajax').fileinput({
            browseLabel: 'Añadir',
            uploadUrl: "http://localhost", // server upload action
            uploadAsync: true,
            maxFileCount: 1,
            initialPreview: [],
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            fileActionSettings: {
                removeIcon: '<i class="icon-bin"></i>',
                zoomIcon: '<i class="icon-zoomin3"></i>',
                zoomClass: '',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
            },
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: 'Selecciona imagen',
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons
        });
        $('.file-input-ajax-xs').fileinput({
            browseLabel: 'Añadir',
            uploadUrl: "http://localhost", // server upload action
            uploadAsync: true,
            maxFileCount: 1,
            initialPreview: [],
            browseIcon: '<i class="icon-file-plus"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base"></i>',
            fileActionSettings: {
                removeIcon: '<i class="icon-bin"></i>',
                zoomIcon: '<i class="icon-zoomin3"></i>',
                zoomClass: '',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
            },
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: 'Selecciona imagen',
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons
        });
        $('.file-input-multiple').fileinput({
            browseLabel: 'Añadir',
            uploadUrl: "http://localhost", // server upload action
            uploadAsync: true,
            //maxFileCount: 1,
            initialPreview: [],
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            fileActionSettings: {
                removeIcon: '<i class="icon-bin"></i>',
                zoomIcon: '<i class="icon-zoomin3"></i>',
                zoomClass: '',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
            },
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: 'Selecciona imagen',
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons
        });
        $('.file-input-no-preview').fileinput({
            browseLabel: 'Añadir',
            removeLabel: 'Quitar',
            browseIcon: '<i class="icon-file-plus mr-1"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-1"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-1"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "Selecciona una imagen",
            fileActionSettings: fileActionSettings,
            showPreview: false
        });
        $('.file-drop-zone-title').css("padding", "20")
    }

    return {
        init: function () {
            _componentFileUpload();
        }
    }
}();

var componentDaterange = function () {
    var _componentDaterange = function () {
        if (!$().daterangepicker) {
            console.warn('Warning - daterangepicker.js is not loaded.');
            return;
        }

        $('.daterange-single').daterangepicker({
            singleDatePicker: true,
            startDate: moment(),
            drops: 'down',
            locale: {
                format: 'DD/MM/YYYY',
                monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                today: 'hoy',
                firstDay: 1
            }
        });
        $('.daterange-time').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            startDate: moment(),
            drops: 'down',
            locale: {
                format: 'DD/MM/YYYY h:mm a',
                monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                today: 'hoy',
                firstDay: 1
            }
        });
    }

    return {
        init: function () {
            _componentDaterange();
        }
    }
}();
var DateTimePickers = function () {
    var _componentPickatime = function () {
        if (!$().pickatime) {
            console.warn('Warning - picker.js and/or picker.time.js is not loaded.');
            return;
        }
        $('.pickatime').pickatime();
    };
    var _componentAnytime = function () {
        if (!$().AnyTime_picker) {
            console.warn('Warning - anytime.min.js is not loaded.');
            return;
        }
        // Date and time
        $('#anytime-both').AnyTime_picker({
            format: '%M %D %H:%i',
        });

    };
        // On demand picker
        $('#ButtonCreationDemoButton').on('click', function (e) {
            $('#ButtonCreationDemoInput').AnyTime_noPicker().AnyTime_picker().focus();
            e.preventDefault();
        });

        return {
            init: function () {
                _componentPickatime();
                _componentAnytime();
            }
        }
}();

var ColorPicker = function () {


    //
    // Setup module components
    //

    // Location picker
    var _componentColorPicker = function () {
        if (!$().spectrum) {
            console.warn('Warning - spectrum.js is not loaded.');
            return;
        }

        // Color palette
        var demoPalette = [
            ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
            ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
            ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
            ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
            ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
            ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
            ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
            ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
        ]


        // Basic examples
        // ------------------------------

        // Basic setup
        $('.colorpicker-basic').spectrum();

        // Clear selection
        $('.colorpicker-clear').spectrum({
            allowEmpty: true
        });

        // Display color formats
        $('.colorpicker-show-input').spectrum({
            showInput: true
        });

        // Display alpha channel
        $('.colorpicker-show-alpha').spectrum({
            showAlpha: true
        });

        // Display initial color
        $('.colorpicker-show-initial').spectrum({
            showInitial: true
        });

        // Display input and initial color
        $('.colorpicker-input-initial').spectrum({
            showInitial: true,
            showInput: true
        });

        // Full featured color picker
        $('.colorpicker-full').spectrum({
            showInitial: true,
            showInput: true,
            showAlpha: true,
            allowEmpty: true
        });

        // Container color
        $('.colorpicker-container-class').spectrum({
            containerClassName: 'bg-slate'
        });

        // Replacer color
        $('.colorpicker-replacer-class').spectrum({
            replacerClassName: 'bg-slate',
        });


        //
        // Toggle picker state
        //

        // Initialize
        $('.colorpicker-disabled').spectrum({
            disabled: true
        });


        // Flat pickers
        // ------------------------------

        // Basic setup
        $('.colorpicker-flat').spectrum({
            flat: true
        });

        // Display input field
        $('.colorpicker-flat-input').spectrum({
            flat: true,
            showInput: true
        });

        // Set picker color
        $('.colorpicker-flat-custom').spectrum({
            flat: true,
            containerClassName: 'bg-slate'
        });

        // Display color palette
        $('.colorpicker-flat-palette').spectrum({
            flat: true,
            showPalette: true,
            showPaletteOnly: true,
            togglePaletteOnly: true,
            togglePaletteMoreText: 'More',
            togglePaletteLessText: 'Less',
            palette: demoPalette
        });

        // Display initial color
        $('.colorpicker-flat-initial').spectrum({
            flat: true,
            showInitial: true
        });

        // Full featued flat picker
        $('.colorpicker-flat-full').spectrum({
            flat: true,
            showInitial: true,
            showInput: true,
            showAlpha: true,
            allowEmpty: true
        });


        // Color palettes
        // ------------------------------

        // Display color palette
        $('.colorpicker-palette').spectrum({
            showPalette: true,
            palette: demoPalette
        });

        // Display palette only
        $('.colorpicker-palette-only').spectrum({
            showPalette: true,
            showPaletteOnly: true,
            palette: demoPalette
        });

        // Toggle palette
        $('.colorpicker-palette-toggle').spectrum({
            showPalette: true,
            showPaletteOnly: true,
            togglePaletteOnly: true,
            togglePaletteMoreText: 'More',
            togglePaletteLessText: 'Less',
            palette: demoPalette
        });

        // Selection palette
        $('.colorpicker-palette-selection').spectrum({
            showPalette: true,
            palette: [],
            localStorageKey: 'spectrum.homepage'
        });

        // Limit number of selections
        $('.colorpicker-palette-limit').spectrum({
            showPalette: true,
            palette: [],
            selectionPalette: ['red', 'green', 'blue'],
            maxSelectionSize: 3
        });

        // Hide after select
        $('.colorpicker-palette-hide').spectrum({
            showPalette: true,
            hideAfterPaletteSelect: true,
            palette: demoPalette
        });


        // Events
        // ------------------------------

        // Change event
        $('.colorpicker-event-change').spectrum({
            change: function (c) {
                var label = $('#change-result');
                label.removeClass('hidden').html('Change called: ' + '<span class="font-weight-semibold">' + c.toHexString() + '</span>');
            }
        });

        // Move event
        $('.colorpicker-event-move').spectrum({
            move: function (c) {
                var label = $('#move-result');
                label.removeClass('hidden').html('Move called: ' + '<span class="font-weight-semibold">' + c.toHexString() + '</span>');
            }
        });

        // Hide event
        $('.colorpicker-event-hide').spectrum({
            hide: function (c) {
                var label = $('#hide-result');
                label.removeClass('hidden').html('Hide called: ' + '<span class="font-weight-semibold">' + c.toHexString() + '</span>');
            }
        });

        // Show event
        $('.colorpicker-event-show').spectrum({
            show: function (c) {
                var label = $('#show-result');
                label.removeClass('hidden').html('Show called: ' + '<span class="font-weight-semibold">' + c.toHexString() + '</span>');
            }
        });


        //
        // Drag start event
        //

        // Initialize
        $('.colorpicker-event-dragstart').spectrum();

        // Attach event
        $('.colorpicker-event-dragstart').on('dragstart.spectrum', function (e, c) {
            var label = $('#dragstart-result');
            label.removeClass('hidden').html('Dragstart called: ' + '<span class="font-weight-semibold">' + c.toHexString() + '</span>');
        });


        //
        // Drag stop event
        //

        // Initialize
        $('.colorpicker-event-dragstop').spectrum();

        // Attach event
        $('.colorpicker-event-dragstop').on('dragstop.spectrum', function (e, c) {
            var label = $('#dragstop-result');
            label.removeClass('hidden').html('Dragstop called: ' + '<span class="font-weight-semibold">' + c.toHexString() + '</span>');
        });
    };

    // Switchery
    var _componentSwitchery = function () {
        if (typeof Switchery == 'undefined') {
            console.warn('Warning - switchery.min.js is not loaded.');
            return;
        }

        // Initialization
        var toggleState = document.querySelector('.form-input-switchery');
        var toggleStateInit = new Switchery(toggleState);

        // Toggle navbar type state toggle
        toggleState.onchange = function () {
            if (toggleState.checked) {
                $('.colorpicker-disabled').spectrum('enable');
            } else {
                $('.colorpicker-disabled').spectrum('disable');
            }
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentColorPicker();
            _componentSwitchery();
        }
    }
}();

var CKEditor = function () {


    //
    // Setup module components
    //

    // CKEditor
    var _componentCKEditor = function () {
        if (typeof CKEDITOR == 'undefined') {
            console.warn('Warning - ckeditor.js is not loaded.');
            return;
        }


        // Full featured editor
        // ------------------------------

        // Setup
        CKEDITOR.replace('editor-full', {
            height: 400,
            extraPlugins: 'forms'
        });

        // Readonly editor
        // ------------------------------

        // Setup
        var editorReadOnly = CKEDITOR.replace('editor-readonly', {
            height: 400,
            extraPlugins: 'forms'
        });

        // The instanceReady event is fired when an instance of CKEditor has finished
        // its initialization.
        editorReadOnly.on('instanceReady', function (ev) {
            editorReadOnly = ev.editor;

            // Show this "on" button.
            document.getElementById('readOnlyOn').style.display = '';

            // Event fired when the readOnly property changes.
            editorReadOnly.on('readOnly', function () {
                document.getElementById('readOnlyOn').style.display = this.readOnly ? 'none' : '';
                document.getElementById('readOnlyOff').style.display = this.readOnly ? '' : 'none';
            });
        });

        // Toggle readonly state
        function toggleReadOnly(isReadOnly) {
            // Change the read-only state of the editor.
            // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setReadOnly
            editorReadOnly.setReadOnly(isReadOnly);
        }
        document.getElementById('readOnlyOn').onclick = function () {
            toggleReadOnly();
        }
        document.getElementById('readOnlyOff').onclick = function () {
            toggleReadOnly(false);
        }


        // Enter key configuration
        // ------------------------------

        // Define editor
        var editorKey;

        // Setup editor
        function changeEnter() {

            // If an editor instance exists, destroy it first.
            if (editorKey)
                editorKey.destroy(true);

            // Create an editor instance again, with appropriate settings.
            editorKey = CKEDITOR.replace('editor-enter', {
                height: 400,
                enterMode: Number(document.getElementById('xEnter').value),
                shiftEnterMode: Number(document.getElementById('xShiftEnter').value)
            });
        }

        // Trigger initialization
        changeEnter();

        // // Change configuration
        document.getElementById('xEnter').onchange = function () {
            changeEnter();
        }
        document.getElementById('xShiftEnter').onchange = function () {
            changeEnter();
        }



        // Inline editor
        // ------------------------------

        // We need to turn off the automatic editor creation first
        CKEDITOR.disableAutoInline = true;

        // The inline editor should be enabled on an element with "contenteditable" attribute set to "true".
        // Otherwise CKEditor will start in read-only mode.
        var introduction = document.getElementById('editor-inline');
        introduction.setAttribute('contenteditable', true);

        // Initialize
        CKEDITOR.inline('editor-inline', {
            // Allow some non-standard markup that we used in the introduction.
            extraAllowedContent: 'a(documentation);abbr[title];code',
            removePlugins: 'stylescombo'
        });
    };

    // Select2
    var _componentSelect2 = function () {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        };

        // Default initialization
        $('.form-control-select2').select2({
            minimumResultsForSearch: Infinity
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentCKEditor();
            _componentSelect2();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    CKEditor.init();
});

/* ------------------------------------------------------------------------------
 *
 *  # Dual listboxes
 *
 *  Demo JS code for form_dual_listboxes.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DualListboxes = function () {
    // Dual listbox
    var _componentDualListbox = function () {
        if (!$().bootstrapDualListbox) {
            console.warn('Warning - duallistbox.min.js is not loaded.');
            return;
        }

        // Multiple selection
        $('.listbox-no-selection').bootstrapDualListbox({
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,
            infoText: false,
            filterPlaceHolder: 'Filtrar',
        });
    };

    // Return objects assigned to module
    return {
        init: function () {
            _componentDualListbox();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    DualListboxes.init();
});

var ImageCropper = function () {
    //
    // Setup module components
    //

    // Image cropper
    var _componentImageCropper = function () {
        if (!$().cropper) {
            console.warn('Warning - cropper.min.js is not loaded.');
            return;
        }

        // Default initialization
        $('.crop-basic').cropper();

        // Hidden overlay
        $('.crop-modal').cropper({
            modal: false
        });

        // Fixed position
        $('.crop-not-movable').cropper({
            cropBoxMovable: false,
            data: {
                x: 75,
                y: 50,
                width: 350,
                height: 250
            }
        });

        // Fixed size
        $('.crop-not-resizable').cropper({
            cropBoxResizable: false,
            data: {
                x: 10,
                y: 10,
                width: 300,
                height: 300
            }
        });

        // Disabled autocrop
        $('.crop-auto').cropper({
            autoCrop: false
        });

        // Disabled drag
        $('.crop-drag').cropper({
            movable: false
        });

        // 16:9 ratio
        $('.crop-16-9').cropper({
            aspectRatio: 16 / 9
        });

        // 4:3 ratio
        $('.crop-4-3').cropper({
            aspectRatio: 4 / 3
        });

        // Minimum zone size
        $('.crop-min').cropper({
            minCropBoxWidth: 150,
            minCropBoxHeight: 150
        });

        // Disabled zoom
        $('.crop-zoomable').cropper({
            zoomable: false
        });


        // Demo cropper
        // ------------------------------

        // Define variables
        var $cropper = $('.cropper'),
            $image = $('#demo-cropper-image'),
            $download = $('#download'),
            $dataX = $('#dataX'),
            $dataY = $('#dataY'),
            $dataHeight = $('#dataHeight'),
            $dataWidth = $('#dataWidth'),
            $dataScaleX = $('#dataScaleX'),
            $dataScaleY = $('#dataScaleY'),
            options = {
                aspectRatio: 1,
                preview: '.preview',
                crop: function (e) {
                    $dataX.val(Math.round(e.x));
                    $dataY.val(Math.round(e.y));
                    $dataHeight.val(Math.round(e.height));
                    $dataWidth.val(Math.round(e.width));
                    $dataScaleX.val(e.scaleX);
                    $dataScaleY.val(e.scaleY);
                }
            };

        // Initialize cropper with options
        $cropper.cropper(options);


        //
        // Toolbar
        //

        $('.demo-cropper-toolbar').on('click', '[data-method]', function () {
            var $this = $(this),
                data = $this.data(),
                $target,
                result;

            if ($image.data('cropper') && data.method) {
                data = $.extend({}, data);

                if (typeof data.target !== 'undefined') {
                    $target = $(data.target);

                    if (typeof data.option === 'undefined') {
                        data.option = JSON.parse($target.val());
                    }
                }

                result = $image.cropper(data.method, data.option, data.secondOption);

                switch (data.method) {
                    case 'scaleX':
                    case 'scaleY':
                        $(this).data('option', -data.option);
                        break;

                    case 'getCroppedCanvas':
                        if (result) {

                            // Init modal
                            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                            // Download image
                            $download.attr('href', result.toDataURL('image/jpeg'));
                        }
                        break;
                }
            }
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentImageCropper();
        }
    }
}();


function plugin_init() {
    TableElements.init();
    Select2Selects.init();
    BootstrapMultiselect.init();
    TagInputs.init();
    Summernote.init();
    InputsCheckboxesRadios.initComponents();
    componentFileUpload.init();
    componentDaterange.init();
    DateTimePickers.init();
    ColorPicker.init();
    DualListboxes.init();
}
$(document).ready(function () {
    ImageCropper.init();
    plugin_init();
});

function text_notification(title, text, type, width, delay) {
    var width = typeof width == 'undefined' ? 400 : width;
    var delay = typeof delay == 'undefined' ? 1400 : delay;
    new PNotify({
        title: title,
        text: text,
        type: type,
        stack: {
            "dir1": "down",
            "dir2": "left",
            "push": "top",
            "spacing1": 10,
            "spacing2": 10
        },
        width: width + "px",
        delay: delay
    });
}

function toggle_class(elem, clas) {
    event.stopPropagation();
    $(elem).toggleClass(clas);
}

function add_class(elem) {
    $('.options-row').addClass(elem, 'd-none');
}

function toggle_options(elem) {
    $('.options-row').addClass('d-none');
    $('#' + elem).removeClass('d-none');
}

function charcountupdate(str) {
    var lng = str.length;
    document.getElementById("charcount").innerHTML = lng + ' out of 400 characters';
}

// MODO OSCURO
function darkmode() {        
    var dark = document.querySelector("body");
    dark.classList.toggle("dark");
}



