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
                <form action="{{route('foodmenu.store')}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Price:</label>
                        <input type="text" id="price" name="price" value="{{old('price')}}" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Price">
                        @if($errors->has('price'))
                        <div class="error">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-email">Discount:</label>
                        <input type="text" id="discount" name="discount" value="{{old('discount')}}" class="form-control {{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="Discount">
                        @if($errors->has('discount'))
                        <div class="error">{{ $errors->first('discount') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-textarea">Description</label>
                        <textarea class="form-control" id="example-textarea" rows="5" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">Offer available For</label>
                        <input class="form-control" id="example-date" type="date" name="date">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="food_category">Food Category:</label>
                        <div class="dropdown dropdown-tree" id="example">
                        </div>
                        <div data-category="{{$menulist}}" id="manu-dropdown"></div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    @endsection
                    @push('scripts')
                    <script>
                        const createData = lst => {
                            return lst.map(e => {
                                var title = e.menu_title;
                                var id = e.id;
                                if (e.hasOwnProperty("children") && e.children.length > 0) {
                                    return {title, data: createData(e.children)};
                                }
                                return {data: id, title,dataAttrs:[{title:"id",data:id}]}
                            });
                        }

                        const catData = $("#manu-dropdown").data("category");
                        const data = createData(catData);
                        console.log('createData ==>', data);
                        /* console.log("raw", catData);
                        console.log("processed", data); */

                        var options = {
                            title : "select Food",
                            data: data,
                            maxHeight: 3000,
                            // selectChildren : true,
                            multiSelect :true,
                            clickHandler: function(element,checked)
                            {

                                $("#example").SetTitle($(element).find("a").first().text());

                                var selected = checked.currentTarget;

                                var selectedid = $(checked.currentTarget).data('id')
                                console.log('selected',selectedid)

                            },
                            checkHandler: function(target,checked){
                                console.log('checked',checked);
                                $("#example").SetTitle($(target).find("a").first().text());
                                // console.log("Selected Elements",$("#example").GetSelected());

                                var selectedid = $(checked.currentTarget).data('id')
                               /*  console.log('selected',selectedid) */
                            },
                            closedArrow: '<i class="fa fa-caret-right" aria-hidden="true"></i>',
                            openedArrow: '<i class="fa fa-caret-down" aria-hidden="true"></i>',

                        }

                        $("#example").DropDownTree(options);
    </script>
 @endpush
