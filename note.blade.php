@extends('admin.layouts.app')
@section('title')

@endsection
@section('css')

@endsection
@section('atas')

@endsection
@section('content')

@endsection
@section('js')

@endsection
@section('script')

@endsection
nim = tahunangkatab-kdjurusan-totalsiswa tshun angkata sama

json_encode = simpan ke bentuk json_decode
json_decode($json,true)= convert to array
--Session
set session $token=session(['token' => $id]);
delete Session
  {{dd(session()->forget('token'))}}
  menampilakn Session
  session('nama session')
DB::beginTransaction();

    try {
        DB::commit();
        // all good
        toastr()->success('Silahkan Masukan Token Anda Terlebih Dahulu', 'Sukses!');
        return redirect()->back();
    } catch (\Exception $e) {
        DB::rollback();
        echo $e->getMessage();
            return false;
        return redirect()->back();
    }

--Session
set session $token=session(['token' => $id]);
delete Session
  {{dd(session()->forget('token'))}}
  menampilakn Session
  session('nama session')
-------------
-------tiap bikin guard baru
Clear the config cache php artisan config:clear or rebuild it php artisan config:cache.
-------
  $user = \App\User::find(1);
    $user->notify(new \Modules\Dtd\Notifications\Invite);
data-toggle="tooltip" data-placement="top" title="Tooltip on top"
