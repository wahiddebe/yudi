@extends('layouts.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Konfirgurasi Aplikasi</div>
    <div class="panel-body">
        <form method="get" action="{{route('update.aplikasi')}}" class="form-horizontal">
        	 @csrf
            @foreach($setting as $item)
            <div class="form-group  {{ $errors->has('setting_value') ? 'has-error' : ''}}">

                <label class="col-md-4 control-label">{{$item->setting_name,}}</label>
                <div class="col-md-6 ">
                 
                    <input type="text" class="form-control" name="{{$item->setting_name}}" value="{{$item->setting_value}}">
                    {!! $errors->first('setting_value', '<p class="help-block">:message</p>') !!}
                </div>

            </div>

            @endforeach

            <button type="submit" style="margin-left: 20px" class=" btn btn-primary">Submit</button>
      </form>


        </div>
    </div>

@endsection