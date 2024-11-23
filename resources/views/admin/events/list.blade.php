@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Days</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">All Records</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Days</th>
                            <th>Route Name</th>
                            <th>Event Name</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Action</th>
                            <th>Days</th>
                            <th>Route Name</th>
                            <th>Event Name</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($days as $day)
                            <tr>
                                <td style="width: 50px;" class="text-center">
                                    <a href="{{route('admin.events.edit.day', ['id' => $day->id])}}" class="btn btn-outline-primary btn-circle">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td>
                                <td>{{$day->name}}</td>
                                <td>{{$day->route_name}}</td>
                                <td>{{$day->event->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection