@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="">Restaurant</a></li>
    <li class="breadcrumb-item"><a href="">Add FoodItems</a></li>
    <li class="breadcrumb-item">Create</li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Add Food Items
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('foodmenu.update',$foodmenu->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label" for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{$foodmenu->name}}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Price:</label>
                        <input type="text" id="price" name="price" value="{{$foodmenu->price}}" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Price">
                        @if($errors->has('price'))
                        <div class="error">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-email">Discount:</label>
                        <input type="text" id="discount" name="discount" value="{{$foodmenu->discount}}" class="form-control {{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="Discount">
                        @if($errors->has('discount'))
                        <div class="error">{{ $errors->first('discount') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-textarea">Description</label>
                        <textarea class="form-control" id="example-textarea" rows="5" name="discription">{{ $foodmenu->discription }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">Offer available For</label>
                        <input class="form-control" id="example-date" type="date" name="date" value="{{ \Carbon\Carbon::createFromDate($foodmenu->year,$foodmenu->month,$foodmenu->day)->format('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="org_id">Company:</label>
                        <select id="org_id" name="category_id" class="form-control {{ $errors->has('org_id') ? ' is-invalid' : '' }}">
                            <option value="">Select Item</option>
                            @foreach ($items as $key => $value)
                            @if ($categoryid == $value)
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
                        <br>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection

