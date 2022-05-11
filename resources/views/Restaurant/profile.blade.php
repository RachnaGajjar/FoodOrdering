@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
<li class="breadcrumb-item"><a href="#">Employees</a></li>
    <li class="breadcrumb-item"><a href="#">Profile page</a></li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Profile Page
    </h4>
    <form id="ajaxform">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">User name:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{ isset($profile->name) ? $profile->name : ' '}}" name="name" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Email:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{isset($profile->user->email) ? $profile->user->email : ' ' }}"name="email" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Bank Name:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{isset($bankdetails->bankname) ? $bankdetails->bankname : ' ' }}" name="bankname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">AccountNumber:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{isset($bankdetails->accountnumber) ? $bankdetails->accountnumber : ' ' }}" name="accountnumber">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Expire_Date:</label>
                        <div class="col-12 col-lg-6 ">
                        <input class="form-control" id="example-date" type="date" name="date" value="{{ \Carbon\Carbon::createFromDate($bankdetails->year,$bankdetails->month,$bankdetails->day)->format('Y-m-d')}}"/>
                        <br>
                        <button type="button" class="btn btn-primary save-data">Submit</button>                </div>
                    </div>
                    </div>
            </div>
            <div class="form-group row">
                <div class="col-12 col-lg-6 ">
            </div>

            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>

    $(".save-data").click(function(event)
    {
        event.preventDefault();

        let name = $("input[name=name]").val();
        let email = $("input[name=email]").val();
        let bankname=$("input[name=bankname]").val();
        let accountnumber=$("input[name=accountnumber]").val();
        let date=$("input[name=date]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: "/ajax-request",
          type:"POST",
          data:{
            name:name,
            email:email,
            bankname:bankname,
            accountnumber:accountnumber,
            date:date,
            _token: _token
          },
          success:function(response){
            console.log(response);
            if(response) {
              $('.success').text(response.success);
              $("#ajaxform")[0].reset();
            }
          },
          error: function(error) {
           console.log(error);
          }
         });
    });
  </script>

@endpush
