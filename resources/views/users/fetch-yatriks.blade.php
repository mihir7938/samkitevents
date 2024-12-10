<div class="card">
    <div class="card-header">
        <h3 class="card-title">Yatriks</h3>
    </div>
    <div class="card-body">
        <table id="fetch_yatrik_data" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th width="100">Name</th>
                    <th width="100">Mobile No</th>
                    <th>Attendance</th>
                    <th>Gift</th>
                    <th>Start</th>
                    <th>Start Time</th>
                    <th>End</th>
                    <th>End Time</th>
                    <th>Email</th>
                    <th>Aadhar Number</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Emergency Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Religious Method</th>
                </tr>
            </thead>
            <tbody>
                @foreach($yatra as $y)
                    <tr>
                        <td>{{$y->yatrik->member_id}}</td>
                        <td>{{$y->yatrik->name}}</td>
                        <td>{{$y->yatrik->mobile_number}}</td>
                        <td>{{($y->attendance == "1") ? 'Present' : 'Absent'}}</td>
                        <td>{{($y->gift == "1") ? 'Assigned' : 'Pending'}}</td>
                        <td>{{$y->start_event}}</td>
                        <td>{{$y->start_date ? Carbon\Carbon::parse($y->start_date)->format('j M, Y h:i A') : ''}}</td>
                        <td>{{$y->end_event}}</td>
                        <td>{{$y->end_date ? Carbon\Carbon::parse($y->end_date)->format('j M, Y h:i A') : ''}}</td>
                        <td>{{$y->yatrik->email}}</td>
                        <td>{{$y->yatrik->aadhar_number}}</td>
                        <td>{{$y->yatrik->gender}}</td>
                        <td>{{$y->yatrik->age}}</td>
                        <td>{{$y->yatrik->emergency_number}}</td>
                        <td>{{$y->yatrik->address}}</td>
                        <td>{{$y->yatrik->city}}</td>
                        <td>{{$y->yatrik->religious_method}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Attendance</th>
                    <th>Gift</th>
                    <th>Start</th>
                    <th>Start Time</th>
                    <th>End</th>
                    <th>End Time</th>
                    <th>Email</th>
                    <th>Aadhar Number</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Emergency Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Religious Method</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>