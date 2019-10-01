<style>

    .id-card-holder {
        width: 225px;
        padding: 4px;
        margin: 0 auto;
        background-color: #1f1f1f;
        border-radius: 5px;
        position: relative;
    }
    .id-card-holder:after {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        border-radius: 0 5px 5px 0;
    }
    .id-card-holder:before {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        left: 222px;
        border-radius: 5px 0 0 5px;
    }
    .id-card {

        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 1.5px 0px #b9b9b9;
    }
    .id-card img {
        margin: 0 auto;
    }
    .header img {
        width: 100px;
        margin-top: 15px;
    }
    .photo img {
        width: 80px;
        margin-top: 15px;
    }
    .id-card  h2 {
        font-size: 15px;
        margin: 5px 0;
    }
    .id-card h3 {
        font-size: 12px;
        margin: 2.5px 0;
        font-weight: 300;
    }
    .qr-code img {
        width: 50px;
    }
    .id-card  p {
        font-size: 5px;
        margin: 2px;
    }
    .id-card-hook {
        background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }
    .id-card-hook:after {
        content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }
    .id-card-tag-strip {
        width: 45px;
        height: 40px;
        background-color: #0950ef;
        margin: 0 auto;
        border-radius: 5px;
        position: relative;
        top: 9px;
        z-index: 1;
        border: 1px solid #0041ad;
    }
    .id-card-tag-strip:after {
        content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #c1c1c1;
        position: relative;
        top: 10px;
    }
    .id-card-tag {
        width: 0;
        height: 0;
        border-left: 100px solid transparent;
        border-right: 100px solid transparent;
        border-top: 100px solid #0958db;
        margin: -10px auto -30px auto;
    }
    .id-card-tag:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 100px solid #d7d6d3;
        margin: -10px auto -30px auto;
        position: relative;
        top: -130px;
        left: -50px;
    }
</style>


<div class="id-card-tag-strip"></div>
<div class="id-card-hook"></div>
<div class="id-card-holder">
    <div class="id-card">
        <div class="header" style="text-align: left;margin-left: 0px">
            <img src="{{ asset('logo.png') }}"  style="max-height:60px;max-width: 60px"/>
            <h2 style="display: inline;margin-left: 15px">{{ config('app.name') }}</h2>
        </div>
        <div class="photo">
          @if ($data->avatar==null)
            <img class="img-circle" src="{{ Storage::url('avatar/male.svg') }}" class="img-circle" width="30" />


          @else
            <img class="img-circle" src="{{ Storage::url('avatar/'.$data->avatar) }}" class="img-circle" width="30" />

          @endif

        </div>
        <h2>{{ $data->nim }}</h2>
        <div style="text-align: justify;margin-left: 7px">
           <table class="">
               <tr>
                   <td>Nama Lengkap</td>
                   <td>:</td>
                   <td >{{ $data->name }}</td>
               </tr>
                <tr>
                   <td>Bidang Studi</td>
                   <td>:</td>
                   <td>{{ $data->nama_jurusan }}</td>
               </tr>

                
               <tr>
                   <td>Blood group &nbsp;&nbsp;</td>
                   <td>:</td>
                   <td>{{ $data->blood_type }}</td>
               </tr>
               <tr>
                   <td>Telephone </td>
                   <td>:</td>
                   <td> {{ $data->tlp }}</td>
               </tr>

           </table>
           </table>
        </div>

        <hr>
            <img style="-webkit-user-select: none;max-width:200px;background-position: 0px 0px, 10px 10px;background-size: 20px 20px;background-image:linear-gradient(45deg, #eee 25%, transparent 25%, transparent 75%, #eee 75%, #eee 100%),linear-gradient(45deg, #eee 25%, white 25%, white 75%, #eee 75%, #eee 100%);" src="https://smart-collage.globalmulia.ac.id/admin/create_barcode/61206160003">



    </div>
</div>

<a  target="_blank" href="https://smart-collage.globalmulia.ac.id/admin/print_id/4" class="btn btn-primary"><i class="entypo-print"></i> Print</a>
