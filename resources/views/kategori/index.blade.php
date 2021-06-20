@extends('layouts.admin')


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Kategori</div>
    <div class="panel-body">

        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-xs" title="Add New Kategory"><span
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
                            <a href="{{ route('kategori.edit' , $item->id ) }}" class="btn btn-primary btn-xs"
                                title="Edit Kategory"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a>
                                    <form  action="{{route('kategori.delete',$item->id)}}" style="display: inline;" method="DELETE">
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Confirm delete ?')"  ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>
                                            </form>
                           
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