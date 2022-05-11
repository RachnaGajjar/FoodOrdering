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
                Products</a>
                <a href="{{ route('restore') }}" class="btn btn-success float-right">Restore All</a>

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
                       @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg" value="{{$menu->id}}" data-toggle="modal" data-target="#myModal">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </table>
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <center>
          <h4 class="modal-title" style="text-align: center;">Delete Product with Reason</h4>
          </center>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="example-textarea">Example textarea:</label>
                <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="firsttextarea" rows="5" name="firsttextarea"></textarea>
                @if($errors->has('firsttextarea'))
                <div class="error">{{ $errors->first('firsttextarea') }}</div>
                @endif
            </div>
        <center>
            <button type="button" class="btn btn-default" data-dismiss="modal" id="yes">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </center>
        </div>
    </div>
  </div>

@endsection
@push('scripts')
<script>
    //jquery for validation
    $(function() {
        $("#yes").validate({
            rules: {

                firsttextarea: {
                    required: true,
                    maxlength:100,
                },
            },
            // Specify the validation error messages
            messages: {
                firsttextarea: {
                    required: 'address is required'
                },

            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
{{-- <script>
$(function(){

    $('#yes').on('click', function(e)
    {
        alert('hi');
        var id = $(this).attr('id');
        var intrare = $('textarea#firsttextarea').val();
        $.ajax({
        type:'POST',
        url: '/post',
        data: {intrare: intrare},
        success: function(data)
        {
          $('textarea#secondtextarea').val(data);
        }

    });
    });
</script> --}}
@endpush
