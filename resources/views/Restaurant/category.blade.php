@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="">Restaurant</a></li>
    <li class="breadcrumb-item"><a href="">Admin</a></li>
    <li class="breadcrumb-item">Create</li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Add Category
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form action="{{route('category.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Name Of food Category:</label>
                        <input type="text" id="name" name="title" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                       <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Parent</label>
                                 <select class="form-control" name="parent_id">
                                    <option selected disabled>Select Parent Menu</option>
                                    @foreach($allMenus as $key => $value)
                                       <option value="{{ $key }}">{{ $value}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <br>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <br>

                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
