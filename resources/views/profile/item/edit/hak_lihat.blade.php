<!-- Hak Akses -->
<div class="col-xs-2 hak_akses_group">
    <input type="hidden" name="{{ $id }}" id="{{ $id }}"
           value="{{ $value }}">

    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                aria-expanded="false">
            <i class="fa fa-globe hak_akses_icon"></i>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <li><a href="#" class="hak_akses" data-akses="public"><i
                            class="fa fa-globe"></i> Publik</a></li>
            <li><a href="#" class="hak_akses" data-akses="group"><i
                            class="fa fa-users"></i> HMIF</a></li>
            <li><a href="#" class="hak_akses" data-akses="private"><i
                            class="fa fa-lock"></i>
                    Hanya saya</a></li>
        </ul>
    </div>
</div>
<!-- /Hak Akses -->