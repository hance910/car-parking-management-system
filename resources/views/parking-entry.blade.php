@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header fw-bold fs-2 text-center text-md-center">{{ __('Car Parking Entry Dashboard') }}</div>

                <div class="card-body">
                    <div class="row g-1">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert"">
                                {{ session('status') }}
                            </div>                                
                        @endif 
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert"">
                                {{ session('error') }}
                            </div>  
                        @endif
                        <div class="col d-flex justify-content-start">
                            <h3 class="fw-bold">Vehicle details:</h3>
                        </div>
                    </div>
                    <form action="{{ route('car-detail-entry') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col">
                            <input type="text" name="plate_number" class="form-control @error('plate_number') is-invalid @enderror" placeholder="T149">
                            @error ('plate_number')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div> 
                            @enderror
                            </div>
                            <div class="col">
                              <input type="text" name="plate_name" class="form-control @error('plate_name') is-invalid @enderror" @error('plate_name') is-invalid @enderror" placeholder="EAA">
                              @error ('plate_name')
                              <div class="row">
                                  <span class="text-danger">{{$message}}</span>
                              </div> 
                              @enderror
                            </div>
                            <div class="col">
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}"  placeholder="0784******">
                                @error ('phone')
                                <div class="row">
                                    <span class="text-danger">{{$message}}</span>
                                </div> 
                                @enderror
                            </div>
                            <div class="row g-1">
                                <div class="col d-flex justify-content-end">
                                    <button ype="button" class="btn btn-success rounded-3">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row g-1">
                        <div class="col d-flex justify-content-start">
                            <h3 class="fw-bold">Parking Register:</h3>
                        </div>
                    </div>
                    <form action="{{route('car-parking-detail-entry')}}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select name="plate_number" class="form-select">
                                    <option selected disabled>Plate number</option>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->plate_number }}">{{$car->plate_number}}</option>
                                        @endforeach
                                </select>
                                @error ('plate_number')
                                <div class="row">
                                    <span class="text-danger">{{$message}}</span>
                                </div> 
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <select name="plate_name" class="form-select">
                                    <option selected disabled>Plate name</option>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->plate_name }}">{{ $car->plate_name }}</option>
                                        @endforeach
                                </select>
                                @error ('plate_name')
                                    <div class="row">
                                        <span class="text-danger">{{$message}}</span>
                                    </div> 
                               @enderror
                            </div>
                            <div class="col-md-3">
                                <select name="wing" class="form-select">
                                    <option selected disabled>Choose wing</option>
                                  @foreach ($wings as $wing)
                                    <option value="{{ $wing->wing_id }}">{{$wing->wing_location}}</option>
                                  @endforeach
                                </select>
                                @error ('wing')
                                    <div class="row">
                                        <span class="text-danger">{{$message}}</span>
                                    </div> 
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <select name="park_number" class="form-select">
                                  <option selected disabled>Assign Parking #...</option>
                                  @for($x=1; $x<=10; $x++)
                                  <option>{{ $x }}</option>
                                  @endfor
                                </select>
                                @error ('park_number')
                                    <div class="row">
                                        <span class="text-danger">Parking number is required</span>
                                    </div> 
                                @enderror
                            </div>
                            <div class="row g-1">
                                <div class="col d-flex justify-content-end">
                                    <button ype="button" class="btn btn-success rounded-3">Park</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row g-1">
                        <div class="col">
                            <h3 class="fw-bold">Parking Lists:</h3>
                        </div>
                        <div class="row">
                            <table class="table table-success table-striped">
                                <thead>
                                    <tr>
                                      <th scope="col">Parking#:</th>
                                      <th scope="col">Location:</th>
                                      <th scope="col">Car ID:</th>
                                      <th scope="col">Time:</th>
                                      <th scope="col">Price(Tsh):</th>
                                      <th scope="col">Action:</th>
                                    </tr>
                                  </thead>
                                @foreach($parkings as $parking)
                                  <tbody>
                                    <tr>
                                      <th scope="row">{{ $parking->parking_number }}</th>
                                      <td>{{ $parking->wing->wing_location }}</td>
                                      <td>{{ $parking->car->plate_number }} {{ $parking->car->plate_name }}</td>
                                      <td>{{ $parking->created_at->diffForHumans()}}</td>
                                      <td>{{($money = $parking->created_at->diffInMinutes()/10)*200}}</td>
                                      <td>
                                    <form action="{{route('car-parking-charges-submission')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$parking->parking_id}}" name="parking_id">
                                        <input type="hidden" value="{{ $parking->car->car_id }}" name="carid">
                                        <input type="hidden" value="{{ $money }}" name="money">
                                        <button class="btn btn-success rounded-4">Clear</button>
                                    </form>
                                    </td>
                                    </tr>
                                  </tbody>
                            @endforeach
                            </table>
                            {{ $parkings->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">

        </div>
    </div>
</div>
@endsection