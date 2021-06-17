@extends('layouts.admin')


@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">Edit Kategori {{ $kategori->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                          <form method="get" class="form-horizontal" action="{{route('kategori.update', $kategori->id)}}" >
         @csrf

                        <label>Name</label>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  
    <div class="col-md-6">
       
        <input class="form-control" type="text" name="name" value="{{$kategori->name}}" required >
        {!! $errors->first('icon', '<p class="help-block">:message</p>') !!}

    </div>
</div>
  <label>Icon</label>
<div class="form-group {{ $errors->has('icon') ? 'has-error' : ''}}">
  
    <div class="col-md-6">

        <select class="form-control" name="icon">

            <option value="{{$kategori->icon}}">{{$kategori->name}}</option>
            <option value="icon_masjid.png">Masjid</option>
            <option value="icon-gov.png">Gedung Pemerintah</option>
            <option value="icon-penginapan.png">Penginapan</option>
            <option value="icon-polsek.png">Polsek</option>
            <option value="icon-rumah-makan.png">Rumah Makan</option>
            <option value="icon-sekolah.png">Sekolah</option>
            <option value="icon-transportasi.png">Transportasi</option>
            <option value="kedai-icon.png">Kedai</option>


        </select>
        {!! $errors->first('icon', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class=" col-md-6">
        <button class="btn btn-warning">Update</button>
    </div>
</div>

                    </form>

                    </div>
                </div>

@endsection