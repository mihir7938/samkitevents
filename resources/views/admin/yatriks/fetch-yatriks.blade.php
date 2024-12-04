<div class="card shadow mb-4">
    <div class="card-header">
        <h3 class="card-title">All Yatriks</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableYatrik" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">All <input type="checkbox" id="selectAllCheckbox"></th>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Event Name</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Event Name</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($yatriks as $yatrik)
                        <tr>
                            <td class="text-center"><input type="checkbox" id="checkbox{{$yatrik->id}}" name="checkbox{{$yatrik->id}}" class="checkboxes"></td>
                            <td>{{$yatrik->member_id}}</td>
                            <td>{{$yatrik->name}}</td>
                            <td>{{$yatrik->mobile_number}}</td>
                            <td>{{$yatrik->event->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <form method="POST" action="{{route('admin.yatriks.assign.save')}}" class="form" id="assign-yatriks" enctype="multipart/form-data">
            @csrf
            @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                <div class="row align-items-center route_div">
                    <div class="col-md-8">
                        <select class="form-control" id="day_name" name="day_name">
                            <option value="">Select Day</option>
                            @foreach($days as $day)
                                <option value="{{$day->id}}">{{ $day->name }} - {{ $day->route_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" name="event_id" value="{{$event_id}}" />
                        <button type="submit" class="btn btn-primary" id="submitBtn">Assign Yatriks</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>