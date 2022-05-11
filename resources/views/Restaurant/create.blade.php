@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="">Restaurant</a></li>
    <li class="breadcrumb-item"><a href="">Admin</a></li>
    <li class="breadcrumb-item">Create</li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Basic Information of Restaurant
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form id="employees_form" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Name Of Restaurant:</label>
                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email:</label>
                        <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email">
                        @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-email">Password:</label>
                        <input type="password" id="password" name="password" value="{{old('password')}}" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="password">
                        @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <select  id="country-dd" class="form-control" name="country">
                            <option value="">Select Country</option>
                            @foreach ($countries as $data)
                            <option value="{{$data->id}}">
                                {{$data->country}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select id="state-dd" class="form-control" name="state">
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="city-dd" class="form-control" name="city">
                        </select>
                    </div>
                    <div class="row">
                            <div class="col-md-11">
                                <input type="file" name="image" class="form-control" onchange="loadFile(event)">
                                <img id="output"/>
                            </div>
                                </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <br>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    //jquery for validation
    $(function() {
        $("#employees_form").validate({
            rules: {
                name: {
                    required: true,
                    //lettersonly: true
                },
                email: {
                    required: true,
                    maxlength: 50,
                    email: true
                },
                password: {
                    required: true
                },
                phonenumber: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                address: {
                    required: true,
                    maxlength:100,
                },
                emergencycontact: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                org_id: {
                    required: true
                }
            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: "Name is required"
                },
                email: {
                    required: "Email is required"
                },
                password: {
                    required: 'password is required'
                },
                phonenumber: {
                    required: 'phonenumber is required',
                    maxlength: 'Phonenumber cannot be more then 10 characters',
                },
                address: {
                    required: 'address is required'
                },
                emergencycontact: {
                    required: 'emergencycontact is required'
                },
                org_id: {
                    required: 'please select this'
                }

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
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $('#employees_form').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
       $('#image').text('');

       $.ajax({
          type:'POST',
          url: "{{route('restaurant.store')}}",
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {

               window.location="{{route('restaurant.index')}}";

           },

       });
  });

</script>
<script>
    $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.state + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
</script>
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
@endpush
