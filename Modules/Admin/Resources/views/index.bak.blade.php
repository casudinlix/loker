@extends('layouts.master')
@section('title')
  Home
@endsection
@section('css')

@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">Dashboard</li>
  </ul>
@endsection

@section('content')
  <div class="col-md-12">

      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Panel Title</h3>
          </div>
          <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
          </div>
      </div>

  </div>
@endsection
@section('js')


          <!-- END TEMPLATE -->
@endsection
@section('script')

@endsection
