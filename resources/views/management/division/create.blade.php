@extends('app')

@section('content')
    <h2>Tambah Divisi</h2>
    <hr>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Division Form -->
    <form method="POST" action="{{ url(Request::url()) }}" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <legend>
                    Divisi Baru Dibawah {{ $super->nama }}
                </legend>

                {{--Divisi Ring 1--}}
                @include('management.item.create.multiple', ['label' => 'Divisi', 'id' => 'divisi', 'required' => true])

                <hr>

                <!-- Buttons -->
                <div class="row">
                    <div class="col-xs-6">
                        <button class="btn btn-primary col-xs-12">
                            Tambahkan
                        </button>
                    </div>
                    <div class="col-xs-6">
                        <a class="btn btn-danger col-xs-12" id="_batal_button"
                           href="{{ url('management') }}">
                            Batal
                        </a>
                    </div>
                </div>
                <!-- /Buttons -->

                <hr>

            </div>
            <!--/col-span-9-->

        </div>
        <!-- /row -->

    </form>
    <!-- /Edit Profile Form -->
@endsection('content')

@section('script')
    <!-- Google Maps -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF2S-uLxntyh6PxPPSp20gup2tl3DnoWg&libraries=places"></script>

    <!-- Own script -->
    <script src="{{ asset('assets/js/edit-profile.aksata.js') }}"></script>
@endsection
