@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Assign Yatriks</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Assign Records</h3>
        </div>
        <form method="POST" class="form" id="assign-yatriks-form" enctype="multipart/form-data">
            <div class="card-body">
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
                    <label for="event_name">Event Name*</label>
                    <select class="form-control" id="event_name" name="event_name">
                        <option value="">Select Event</option>
                        @foreach($events as $event)
                            <option value="{{$event->id}}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <div id="yatrik_results">
        @include('admin.yatriks.fetch-yatriks', ['yatriks' => $yatriks])
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    $(document).ready(function(){
        $('#assign-yatriks-form').validate({
            rules:{
                event_name:{
                    required: true
                }
            },
            messages:{
                event_name:{
                    required: "Please select event name."
                }
            },
            submitHandler: function (form) {
                $('.loader').show();
                $.ajax({
                    url: "{{ route('admin.yatriks.fetch') }}",
                    method: "POST",
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                      'event_id' : $("#event_name").val(),
                    },
                    success: function (data) {
                      $('.loader').hide();
                      $("#yatrik_results").html('');
                      $("#yatrik_results").show();
                      $('#yatrik_results').append(data);
                      $('#dataTableYatrik').DataTable({
                          "paging": false,
                          "scrollY": 200,
                          "destroy": true, //use for reinitialize datatable
                      });
                    },
                });
            }
        });
        $(document).on('click', '#submitBtn', function(){
            $('#assign-yatriks').validate({
                rules:{
                    day_name:{
                        required: true
                    }
                },
                messages:{
                    day_name:{
                        required: "Please select day."
                    }
                },
                errorPlacement: function(error, element) {
                    $(".route_div").after(error);
                },
                submitHandler: function (form) {
                    $('.loader').show();
                    form.submit();
                }
            });
        });
        $(document).on('change', '#selectAllCheckbox', function(){
            $('.checkboxes').prop('checked', $(this).prop('checked'));
        });
        $(document).on('change', '#day_name', function(){
            $('.loader').show();
            if($(this).val() == '') {
                $('#selectAllCheckbox').attr("disabled", true);
                $('.checkboxes').attr("disabled", true);
            } else {
                $('#selectAllCheckbox').removeAttr("disabled");
                $('.checkboxes').removeAttr("disabled");
            }
            $.ajax({
                url: "{{ route('admin.day.yatriks.fetch') }}",
                method: "POST",
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                  'event_id' : $("#event_id").val(),
                  'day_id' : $(this).val(),
                },
                success: function (response) {
                  $('.loader').hide();
                  $('.checkboxes').prop('checked', false);
                  $('.yatrik_gift').text('-');
                  if($(response.data).length == $('.checkboxes').length) {
                      $('#selectAllCheckbox').prop('checked', true);
                  } else {
                      $('#selectAllCheckbox').prop('checked', false);
                  }
                  $.each(response.data, function(key,value){
                      $('#yatrik_checkbox'+value.yatrik_id).prop('checked', true);
                      if(value.gift == 1) {
                        $('#yatrik_gift'+value.yatrik_id).html('Assigned');
                      } else {
                        $('#yatrik_gift'+value.yatrik_id).text('Pending');
                      }
                  });
                },
            });
        });   
    });
</script>
@endsection