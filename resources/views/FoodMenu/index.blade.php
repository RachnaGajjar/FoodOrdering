@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('restaurant.index')}}">Employee</a></li>
        <li class="breadcrumb-item">Index</a></li>
</ol>
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('foodmenu.create') }}" class="btn btn-secondary float-right" role="button">Add
                Restaurant</a>
        </div>
    </div>
    <br>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>price</th>
                <th>discount</th>
                <th> discription </th>
                <th> offer_avilable_for </th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($foodmenu as $menu)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->price }}</td>
                <td>{{ $menu->discount }}</td>
                <td>{{ $menu->discription }}</td>
                <td>{{ $menu->offer_avilable_for}}</td>
                <td>
                    <form action="{{ route('foodmenu.destroy',$menu->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('foodmenu.show',$menu->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('foodmenu.edit',$menu->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
@endsection
