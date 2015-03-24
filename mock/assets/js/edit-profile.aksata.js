$(document).ready(function() {
	// add "required" to all input
	$('body').find('input, select').each(function(i, e) {
		name = $(e).attr('name');
		// only add required if this is not a template subitem
		if (name.substr(name.length - 2) != '_0') {
			$(e).attr('required','');
		}
	});

	// add close button to all subitem
	$('body').find('.subitem').each(function(i, e) {
		$(e).append('<span class="remove_button_container"><button class="close remove_button" type="button">&times;</button></span>');
	});
	// show remove button on hover
	$('body').on('mouseenter', '.subitem', function() {
		item = $(this).closest('.item');
		if (item.attr('required') && item.find('.subitem').length == 2) {} else {
			$(this).find('.remove_button').show();
		}
	});
	$('body').on('mouseleave', '.subitem', function() {
		$(this).find('.remove_button').hide();
	});

	// message popup (using modal)
	function message(msg) {
		$('body').append('<div class="modal fade" id="_message_modal"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><p>' + msg + '</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></div></div></div></div>');
		$('#_message_modal').modal();
		$('#_message_modal').on('hide', function() {
			$('#_message_modal').remove();
			alert('ilang deh');
		});
	}

	/////////////
	// Hak Akses
	/////////////

	// icon-icon hak akses
	hakAksesIcon = {
		publik: 'fa-globe',
		kalangan: 'fa-users',
		privat: 'fa-lock'
	}
	// event mengubah hak akses
	$('body').on('click', '.hak_akses', function() {
		var group = $(this).closest('.hak_akses_group');
		var icon = group.find('.hak_akses_icon');
		var data = $(this).data('akses');

		// ubah input value
		group.find('input').val(data);

		// ubah icon
		icon.removeClass(hakAksesIcon.publik);
		icon.removeClass(hakAksesIcon.kalangan);
		icon.removeClass(hakAksesIcon.privat);
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
		item.find('.subitem').each(function(i, e) {
			$(e).find('input').each(function(j, input) {
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
	$('body').on('click', '.add_button', function() {
		// copy subitem terakhir pada subitem
		var item = $(this).closest('.item');
		var lastSubitem = item.find('.subitem:last');
		var newSubitem  = item.find('.subitem:first').clone(true, true);

		// append item baru di bagian terakhir
		lastSubitem.after(newSubitem);
		newSubitem.hide().fadeIn(400);

		// perbarui index
		reorderSubitem(item);

		// fokus ke input pertama di newItem
		newSubitem.find('input:first').focus();
	});

	// hapus subitem untuk multiple-valued fields
	$('body').on('click', '.remove_button', function() {
		var subitem = $(this).closest('.subitem');
		var item = subitem.closest('.item');

		// periksa apakah ini subitem terakhir untuk item yang required
		if (item.attr('required') && item.find('.subitem').length == 2) {
			message("Tidak boleh menghapus semua item!");
			return false;
		}

		subitem.fadeOut(400, function() {
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
		update: function() {
			reorderSubitem($(this));
		}
	});

	////////////////////
	// form validations
	////////////////////

	// event tombol batal
	$('body').on('click', '#_batal_button', function() {
		message("Apakah Anda yakin?");
		return false;
	});
	// event tombol simpan
	$('body').on('click', '#_simpan_button', function() {
		
	});

    ////////////////////
    // image select
    ////////////////////
    $('#foto').click(function(){
        alert("halo");
        $('input[name="foto"]').click();
    });

});
