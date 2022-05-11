@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('restaurant.index')}}">Employee</a></li>
        <li class="breadcrumb-item">Index</a></li>
</ol>
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('restaurant.create') }}" class="btn btn-secondary float-right" role="button">Add
                Restaurant</a>
        </div>
    </div>
    <br>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>city</th>
                <th> Image </th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($restaurants as $restaurant)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $restaurant->name }}</td>
                <td>{{ $restaurant->user->email }}</td>
                <td>{{$restaurant->user->city->name}}
                <td><img src="{{$restaurant->thumbnail_image}}"height="100" width="100"> </td>
                <td>
                    <form action="{{ route('restaurant.destroy',$restaurant->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('restaurant.show',$restaurant->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('restaurant.edit',$restaurant->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
@endsection
