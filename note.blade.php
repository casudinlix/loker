@extends('admin.layouts.app')
@section('title')

@endsection
@section('css')

@endsection
@section('atas')

@endsection
@section('content')

@endsection
@section('modal')

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
        toastr()->success('Sukses', 'Sukses!');
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

$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});
---modal conten
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">

           </div>
        </div>
        </div>

---modal conten ajax
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id=""></h4>
</div>
<div class="modal-body">

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary"></button>
</div>
