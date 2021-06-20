@extends('layouts.admin')

@section('content')
            <div class="panel panel-default">
                <div class="panel-heading">Maps</div>
                <div class="panel-body">

                    <a href="{{ route('maps.create') }}" class="btn btn-primary btn-xs" title="Add New Map"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th> Kategory Id </th><th> Title </th><th> Description </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($maps as $item)
                                <tr>
                                    <!-- <td>{{ $item->id }}</td> -->
                                    <td>{{ $item->Kategori->name }}</td><td>{{ $item->title }}</td><td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ route('maps.edit' , $item->id ) }}" class="btn btn-primary btn-xs" title="Edit Map"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                       
                                            <form  action="{{route('maps.delete',$item->id)}}" style="display: inline;" method="DELETE">
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Confirm delete ?')"  ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $maps->render() !!} </div>
                        </div>

                    </div>
                </div>
    @endsection