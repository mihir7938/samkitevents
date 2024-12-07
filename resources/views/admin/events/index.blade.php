@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Events</h1>
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
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Days</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Days</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td style="width: 110px;">
                                    <a href="{{route('admin.events.list', ['id' => $event->id])}}" class="btn btn-outline-dark btn-circle">
                                        <i class="fas fa-calendar-day"></i>
                                    </a>
                                    <a href="{{route('admin.events.edit', ['id' => $event->id])}}" class="btn btn-outline-primary btn-circle">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{route('admin.events.delete', ['id' => $event->id])}}" class="btn btn-outline-danger btn-circle" onClick="return confirmAction();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <td>{{$event->name}}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y')}}</td>
                                <td>{{$event->total_days}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    function confirmAction(){
        if(prompt("Are you sure want to delete (Type 'Yes' to confirm)", '') == 'Yes') {
            return confirmDelete();
        } else {
            return false;
        }
    }
    function confirmDelete() {
        if(prompt("Event data will be deleted permanently (Type 'Yes' to confirm)", '') == 'Yes') {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection