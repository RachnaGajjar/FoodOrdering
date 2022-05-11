@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('restaurant.index')}}">Employee</a></li>
        <li class="breadcrumb-item">Index</a></li>
</ol>
<!-- END Page Header -->
<main id="js-page-content" role="main" class="page-content">
    <div class="card mb-g">
        <h4 class="card-header">
            Edit Imformation of Restaurant
        </h4>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('restaurant.update',$restaurant->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Name:</label>
                            <input type="text" id="simpleinput" name="name" class="form-control" placeholder="Name" value="{{ $restaurant->name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-palaceholder">email:</label>
                            <input type="text" id="example-palaceholder" name="email" class="form-control" placeholder="email" value="{{ isset($restaurant->user->email) ? $restaurant->user->email : ' '}}">
                        </div>
                         <div class="row">
                            <div class="col-md-11">
                                <input type="file" name="image" class="form-control" onchange="loadFile(event)">
                                <img id="output" src="{{$restaurant->thumbnail_image}}" width="100" height="100"/>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="form-label" for="org_id">Company:</label>
                            <select id="org_id" name="city_id" class="form-control {{ $errors->has('org_id') ? ' is-invalid' : '' }}">
                                <option value="">Select Item</option>
                                @foreach ($city as $key => $value)
                                @if ($cityid == $value)
                                <option value="{{ $value }}" selected>{{ $key }}</option>
                                @else
                                <option value="{{ $value }}">{{ $key }}</option>
                                @endif
                                @if($errors->has('org_id'))
                                <div class="error">{{ $errors->first('org_id') }}</div>
                                @endif
                                @endforeach
                                @if($errors->has('org_id'))
                                <div class="error">{{ $errors->first('org_id') }}</div>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<script>
    var loadFile = function(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    };
  </script>
