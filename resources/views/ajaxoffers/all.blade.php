<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="input-group rounded">
  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
  <span class="input-group-text border-0" id="search-addon">
    <i class="fas fa-search"></i>
  </span>
</div>




<div class="container">
  <h2>Basic Table</h2>

  @if(Session::has('success'))
  <div class="alert alert-success">
  {{Session::get('success')}}
  </div>

  @endif
  @if(Session::has('error'))
  <div class="alert alert-danger">
    {{Session::get('error')}}
  </div>
  @endif
 
  <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>name offer</th>
        <th>price offer</th>
        <th>details offer</th>
        <th> photo offer </th>
        <th> operations </th>
      </tr>
    </thead>
    @foreach($offers as $offer)
    <tbody>
      <tr>
        <td>{{$offer->id}}</td>
        <td>{{$offer->name}}</td>
        <td>{{$offer->price}}</td>
        <td>{{$offer->details}}</td>
        <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
        <td>
                <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success"> update</a>
                <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-success"> delete</a>
</td>
              </tr>
     
    </tbody>
    @endforeach
  </table>
</div>

</body>
</html>
