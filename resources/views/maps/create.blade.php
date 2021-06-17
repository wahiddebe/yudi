@extends('layouts.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Create New Map</div>
    <div class="panel-body">

        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form action="" class="form-horizontal">
        	
        	<div class="row">
    <div class="col-md-6">
    	<label class="control-label">Kategori</label>
        <div class="form-group {{ $errors->has('kategory_id') ? 'has-error' : ''}}">
        	
            <div class="col-md-10">
              
        <select class="form-control" name="icon">

            <option>Select Kategori</option>
              @foreach ($data as $item)
            <option value="icon_masjid.png">{{$item->name}}</option>
              @endforeach
         


        </select>
                {!! $errors->first('kategory_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <label class="control-label">Tittle</label>
        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            <div class="col-md-10">
<input type="text" name="title" class="form-control" required>
                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <label class="control-label">Description</label>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            <div class="col-md-10">
<textarea class="form-control" name="description">Description</textarea>
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

<label class="control-label">Lat</label>
        <div class="form-group {{ $errors->has('lat') ? 'has-error' : ''}}">
            <div class="col-md-10">
<input type="text" name="lat" class="form-control" id="lat">
                {!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
         <label class="control-label">Long</label>
        <div class="form-group {{ $errors->has('long') ? 'has-error' : ''}}">
           
            <div class="col-md-10">
 <input type="text" name="long" class="form-control" id="long">
             
                {!! $errors->first('long', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div id="map"></div>
    </div>
</div>




<div class="form-group">
    <div class=" col-md-4">
        <a class=" btn btn-default" href="{{route('maps')}}" role="button">Back</a>
<button class="  btn btn-success" type="submit" >Create</button>
    </div>
</div>


@push('js')
<script>
    var map = new GMaps({
        el: '#map',
        zoom:{{$set_zoom}},
        lat:{{$latitude_centre}},
        lng:{{$longitude_centre}},
        click: function(e) {
            // alert('click');
            var latLng = e.latLng;
            console.log(latLng);
            var lat = $('#lat');
            var long = $('#long');

            lat.val(latLng.lat());
            long.val(latLng.lng());
            map.removeMarkers();
            map.addMarker({
                lat: latLng.lat(),
                lng: latLng.lng(),
                title: 'Create Here',
                click: function(e) {
                    alert('You clicked in this marker');
                }
            });

        },
    });

    @isset($map)
    map.addMarker({
        lat:{{$map->lat}},
        lng:{{$map->long}},
        title: 'Create Here',
        click: function(e) {
            alert('You clicked in this marker');
        }
    });
    @endisset
</script>
@endpush

        </form>
      

    </div>
</div>
  @endsection