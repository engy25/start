@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    الاطباء

                </div>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">service</th>
                        
                        
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($services) && $services -> count() > 0 )
                        @foreach($services as $services)
                            <tr>
                                <th scope="row">{{$services -> id}}</th>
                                <td>{{$services -> name}}</td>
                              
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
                  <br>
                  <br>
                  <br>
                  <form method="POST" action ="{{route('save.doctors.services')}}" >
       @csrf
       @csrf
       
  <div class="form-group">
  <label for="exampleInputEmail1">choose doctor</label>
    
    <select class="form-control"  name="doctor_id">
    @if(isset($doctors) && $doctors -> count() > 0 )
    @foreach($doctors as $doctor)
        <option value="{{$doctor->id}}">{{$doctor->name}} </option>
        @endforeach
        @endif
     </select>
    
  
  </div>
  
  <div class="form-group">
  <label for="exampleInputEmail1"> /////////choose services ////////// </label>
  
  @if(isset($allServices) && $allServices -> count() > 0 )
    <<select class="form-control" name="servicesIds[]" multiple>
                            @foreach($allServices as $allService)
                                <option value="{{$allService -> id}}">{{$allService -> name}}</option>
                            @endforeach
                        </select>

 
        
    </select>
    @endif
  
  </div>

  <button type="submit" class="btn btn-primary">save offer</button>
</form>

            </div>
        </div>
    </div>
@stop