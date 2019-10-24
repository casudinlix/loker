@extends('admin.layouts.app')
@section('title')
KRS Manual
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">

@endsection
@section('atas')
<ul class="breadcrumb">
    <li><a href="#">Akademik</a></li>
    <li class="active">Krs Manual</li>
</ul>
@endsection
@section('content')
<div class="row">
    @foreach ($jdwl as $key)
    <div class="col-md-3">
            <!-- CONTACT ITEM -->
            <div class="panel panel-default">
                <div class="panel-body profile">
                        <div class="profile-image">
                        <img src="{{asset('logo.png')}}" alt="Nadia Ali"/>
                            </div>
                    <div class="profile-data">
                    <div class="profile-data-name">{{$key->nama_mk}}</div>
                    <div class="profile-data-title">{{$key->nama_dosen}}</div>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="contact-info">
                    <p><small>Ruangan</small><br/>{{$key->nama_kelas}}</p>
                        <p><small>Email</small><br/>nadiaali@domain.com</p>

                    </div>
                </div>
            </div>
            <!-- END CONTACT ITEM -->
        </div>
    @endforeach


</div>

@endsection
@section('modal')

@endsection
@section('js')
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}" charset="utf-8"></script>

@endsection
@section('script')

@endsection



