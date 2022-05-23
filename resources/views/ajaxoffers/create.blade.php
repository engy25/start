@extends('layouts.app')
@section('content')
<div class="container">
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
           Add your offer

        </div>
        '
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <br>
        <form method="POST"  id="offerForm" 
        action="" enctype="multipart/form-data">
            @csrf
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}


            <div class="form-group">
                <label for="exampleInputEmail1">أختر صوره العرض</label>
                <input type="file" class="form-control" name="photo">
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>


            

            <div class="form-group">
                <label for="exampleInputEmail1">Offer Name </label>
                <input type="text" class="form-control" name="name">
                @error('name')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Offer Price</label>
                <input type="text" class="form-control" name="price" >
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            

            <div class="form-group">
                <label for="exampleInputPassword1">Offer details</label>
                <input type="text" class="form-control" name="details">
                @error('details_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button id="save_offer" class="btn btn-primary">Save Offer</button>
        </form>


    </div>
</div>


@stop
@section('scripts')
    <script>

$(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data:formData,
                 processData: false,
                contentType: false,
                cache: false,
   success:function (data){

   },
   error:function (reject){

   }
    }),
});


  </script>
@stop