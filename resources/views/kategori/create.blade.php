@extends('layouts.admin')


@section('content')


<div class="panel panel-default">
    <div class="panel-heading">Create New Kategory</div>
    <div class="panel-body">


        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="post" class="form-horizontal" action="{{route('kategori.add')}}" >
         @csrf

         @include ('kategori.form')	

        </form>


    </div>
</div>

@endsection