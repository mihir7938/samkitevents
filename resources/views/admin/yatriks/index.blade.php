@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Yatriks</h1>
        <a href="{{route('admin.yatriks.import')}}" class="btn btn-primary">Import Yatriks</a>
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
                            <th>Name</th>
                            <th>Member ID</th>
                            <th>Yatrik ID</th>
                            <th>Mobile No</th>
                            <th>Event Name</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Member ID</th>
                            <th>Yatrik ID</th>
                            <th>Mobile No</th>
                            <th>Event Name</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($yatriks as $yatrik)
                            <tr>
                                <td style="width: 140px;">
                                    <a href="{{route('admin.yatriks.view', ['id' => $yatrik->id])}}" class="btn btn-outline-dark btn-circle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('admin.yatriks.edit', ['id' => $yatrik->id])}}" class="btn btn-outline-primary btn-circle">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{route('admin.yatriks.delete', ['id' => $yatrik->id])}}" class="btn btn-outline-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{route('admin.yatriks.download', ['id' => $yatrik->id])}}" class="btn btn-outline-secondary btn-circle">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </td>
                                <td>{{$yatrik->name}}</td>
                                <td>{{$yatrik->member_id}}</td>
                                <td>{{$yatrik->custom_yatrik_id}}</td>
                                <td>{{$yatrik->mobile_number}}</td>
                                <td>{{$yatrik->event->name}}</td>
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