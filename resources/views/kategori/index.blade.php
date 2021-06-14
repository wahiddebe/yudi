@extends('layouts.admin')


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Kategori</div>
    <div class="panel-body">

        <a href="{{ url('/kategory/create') }}" class="btn btn-primary btn-xs" title="Add New Kategory"><span
                class="glyphicon glyphicon-plus" aria-hidden="true" /></a>
        <br />
        <br />
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th> Name </th>
                        <th> Icon </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategory as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <!-- <i class="{{ $item->icon }}"></i> -->
                            <img src="img/{{ $item->icon }}">
                            </td>
                        <td>
                            <a href="{{ url('/kategory/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"
                                title="Edit Kategory"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a>
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $kategory->render() !!} </div>
        </div>

    </div>
</div>
@endsection