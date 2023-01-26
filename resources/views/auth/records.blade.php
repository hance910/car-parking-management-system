@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-light">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h3 class="fw-bold">Records:</h3>
                </div>
              </div>
                <table class="table table-secondary">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Parking ID</th>
                          <th scope="col">Vehicle ID</th>
                          <th scope="col">Amount paid</th>
                          <th scope="col">Time out</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($paid_vehicles as $paid_vehicle)
                          <tr>
                            <th scope="row">{{ $paid_vehicle->id }}</th>
                            <td>{{ $paid_vehicle->parking_id}}</td>
                            <td>{{ $paid_vehicle->car->plate_number }} {{ $paid_vehicle->car->plate_name }}</td>
                            <td>{{ $paid_vehicle->paid_amount }}</td>
                            <td>{{ $paid_vehicle->created_at }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                </table>
                {{$paid_vehicles->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
@endsection