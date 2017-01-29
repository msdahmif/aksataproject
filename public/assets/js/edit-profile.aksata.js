$(document).ready(function() {
    // add "required" to all input
    $('body').find('input, select').each(function (i, e) {
        name = $(e).attr('name');
        // exclude template subitem, file, hidden input, and pac-input (search)
        if (name.substr(name.length - 2) != '_0' && e.id != 'pac-input' && $(e).attr('type') != 'file' && $(e).attr('type') != 'hidden') {
            $(e).attr('required', '');
        }
    });

    // add close button to all subitem
    $('body').find('.subitem').each(function (i, e) {
        $(e).append('<span class="remove_button_container"><button class="close remove_button" type="button">&times;</button></span>');
    });
    // show remove button on hover
    $('body').on('mouseenter', '.subitem', function () {
        item = $(this).closest('.item');
        if (item.attr('required') && item.find('.subitem').length == 2) {
        } else {
            $(this).find('.remove_button').show();
        }
    });
    $('body').on('mouseleave', '.subitem', function () {
        $(this).find('.remove_button').hide();
    });

    // message popup (using modal)
    function message(msg) {
        $('body').append('<div class="modal fade" id="_message_modal"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><p>' + msg + '</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></div></div></div></div>');
        $('#_message_modal').modal();
        $('#_message_modal').on('hide', function () {
            $('#_message_modal').remove();
            alert('ilang deh');
        });
    }

    /////////////
    // Hak Akses
    /////////////

    // icon-icon hak akses
    hakAksesIcon = {
        'public': 'fa-globe',
        'group': 'fa-users',
        'private': 'fa-lock'
    };
    // mengubah hak akses
    $('.hak_akses_group').each(function (i, e) {
        var group = $(e);
        var icon = group.find('.hak_akses_icon');
        var data = $(e).find('input').val();
        if (data != 'public' && data != 'group' && data != 'private') {
            data = 'private';
        }

        // ubah icon
        icon.removeClass(hakAksesIcon['public']);
        icon.removeClass(hakAksesIcon['group']);
        icon.removeClass(hakAksesIcon['private']);
        icon.addClass(hakAksesIcon[data]);
    });
    // event mengubah hak akses
    $('body').on('click', '.hak_akses', function () {
        var group = $(this).closest('.hak_akses_group');
        var icon = group.find('.hak_akses_icon');
        var data = $(this).data('akses');

        // ubah input value
        group.find('input').val(data);

        // ubah icon
        icon.removeClass(hakAksesIcon['public']);
        icon.removeClass(hakAksesIcon['group']);
        icon.removeClass(hakAksesIcon['private']);
        icon.addClass(hakAksesIcon[data]);

        // hide dropdown
        group.find('.dropdown-toggle').dropdown('toggle');

        return false;
    });

    /////////////////////////
    // Item-Subitem things
    /////////////////////////

    // memperbarui index untuk setiap subitem
    function reorderSubitem(item) {
        item.find('.subitem').each(function (i, e) {
            $(e).find('input').each(function (j, input) {
                name = $(input).attr('name');
                while (name.length > 0 && name[name.length - 1] != '_') {
                    name = name.slice(0, -1);
                }
                name = name + i;
                $(input).attr('name', name);
                $(input).attr('id', '_' + name);
            });
        });
    }

    // tambah subitem untuk multiple-valued fields
    $('body').on('click', '.add_button', function () {
        // copy subitem terakhir pada subitem
        var item = $(this).closest('.item');
        var lastSubitem = item.find('.subitem:last');
        var newSubitem = item.find('.subitem:first').clone(true, true);

        // append item baru di bagian terakhir
        lastSubitem.after(newSubitem);
        newSubitem.hide().fadeIn(400);

        // perbarui index
        reorderSubitem(item);

        // tambah required
        newSubitem.find('input, select').each(function (i, e) {
            name = $(e).attr('name');
            // only add required if this is not a template subitem
            if (name.substr(name.length - 2) != '_0') {
                $(e).attr('required', '');
            }
        });

        // fokus ke input pertama di newItem
        newSubitem.find('input:first').focus();
    });

    // hapus subitem untuk multiple-valued fields
    $('body').on('click', '.remove_button', function () {
        var subitem = $(this).closest('.subitem');
        var item = subitem.closest('.item');

        // periksa apakah ini subitem terakhir untuk item yang required
        if (item.attr('required') && item.find('.subitem').length == 2) {
            message("Tidak boleh menghapus semua item!");
            return false;
        }

        subitem.fadeOut(400, function () {
            var item = subitem.closest('.item');
            subitem.remove();

            // perbarui index
            reorderSubitem(item);
        });

    });

    // coba-coba jquery-ui
    // sortable untuk subitem
    $('.item').sortable({
        cursor: 'move',
        items: '.subitem',
        opacity: 0.9,
        update: function () {
            reorderSubitem($(this));
        }
    });

    ////////////////////
    // form validations
    ////////////////////

    // event tombol batal
    $('body').on('click', '#_batal_button', function () {
        return confirm('Apakah Anda yakin?');
    });
    // event tombol simpan
    $('body').on('click', '#_simpan_button', function () {

    });

    ///////////////
    // image select
    ///////////////

    var foto_old = $('#img_foto').attr('src');
    $('body').on('click', '.foto_wrap', function (e) {
        $('input[name="foto"]').click();
    });
    $('input[name="foto"]').click(function (e) {
        e.stopPropagation();
    });
    $('#foto').change(function () {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img_foto').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $('.foto_description').html('<p>Change Picture <a type="button" class="foto_revert">(cancel)</a></p>');
    });
    $('body').on('click', '.foto_revert', function (e) {
        e.stopPropagation();
        $('#img_foto').attr('src', foto_old);
        $('input[name="foto"]').val('');
        $('.foto_description').html('<p>Change Picture</p>');
    });

    /////////////////////////////
    // google maps locaton picker
    /////////////////////////////

    // initializing the map
    var map, marker;
    google.maps.event.addDomListener(window, 'load', function() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: { lat: 0, lng: 0},
            zoom: 8
        });
        marker = new google.maps.Marker({
            position: { lat: 0, lng: 0},
            map: map,
            draggable: true
        });
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
        });

        // add search box
        //var defaultBounds = new google.maps.LatLngBounds(
        //    new google.maps.LatLng(-33.8902, 151.1759),
        //    new google.maps.LatLng(-33.8474, 151.2631));
        //map.fitBounds(defaultBounds);

        var input = document.getElementById('pac-input');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var searchBox = new google.maps.places.SearchBox((input));
        // [START region_getplaces]
        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        var markers = [];
        google.maps.event.addListener(searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // For each place, get the icon, place name, and location.
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                bounds.extend(place.geometry.location);
            }

            map.fitBounds(bounds);
        });
        // [END region_getplaces]

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map, 'bounds_changed', function() {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);
        });
    });

    // prevent form submit on enter inside gmaps_input
    $('#pac-input').bind('keypress keydown keyup', function(e) {
        if (e.keyCode == 13) e.preventDefault();
    });

    var gmapsActiveInput;
    $('body').on('click', '.gmaps_button', function () {
        gmapsActiveInput = $(this).closest('.input-group').find('input');

        // read the latLng from the active input
        var data = gmapsActiveInput.val().replace(/[()\s ]+/g, '').split(',');
        var lat = 0, lng = 0;
        if (data.length == 2) {
            lat = parseFloat(data[0]);
            lng = parseFloat(data[1]);
        }
        marker.setPosition({lat: lat, lng: lng});
    });
    $('#gmaps_modal').on('shown.bs.modal', function () {
        google.maps.event.trigger(map, 'resize');
        map.panTo(marker.position);
    });
    $('body').on('click', '#gmaps_modal_confirm_button', function () {
        position = marker.position;
        gmapsActiveInput.val('(' + position.lat() + ", " + position.lng() + ")");
        $('#gmaps_modal').modal('hide');
    });

});