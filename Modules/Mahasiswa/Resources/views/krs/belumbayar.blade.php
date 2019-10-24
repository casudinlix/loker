@extends('layouts.app')
@section('title')
Keuangan Anda Bermasalah
@endsection
@section('css')

@endsection
@section('atas')
<ul class="breadcrumb">
    <li><a href="#">Akademik</a></li>
    <li class="active">KRS</li>
</ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="error-container" style="background-image:">
            <div class="error-code"><img src="{{asset('tenor.gif')}}" alt="" height="100%" width="100%"></div>
            <div class="error-text">Status Keuangan Anda Bermasalah</div>
            <div class="error-subtext">Silahkan Penuhi Kewajiban Anda segera ya. . . ..</div>
            <div class="error-actions">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>

        </div>

    </div>
</div
@endsection
@section('modal')

@endsection
@section('js')

@endsection
@section('script')

@endsection
