@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Yatrik</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Add Record</h3>
        </div>
        <form method="POST" action="{{route('admin.yatriks.add.save')}}" class="form" id="add-yatriks-form" enctype="multipart/form-data">
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
                <div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="yatrik_id">Yatrik ID*</label>
                            <input type="text" class="form-control" id="yatrik_id" name="yatrik_id" placeholder="Enter Yatrik ID">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender*</label>
                            <select name="gender" id="gender" class="form-control">
                              <option value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">City*</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="age">Age*</label>
                            <input type="text" class="form-control" id="age" name="age" placeholder="Enter Age">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state">State*</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter State">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="aadhar_number">Aadhar Number* (Ex - 999988889999)</label>
                            <input type="text" class="form-control" id="aadhar_number" name="aadhar_number" placeholder="Enter Aadhar Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country*</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="father_husband_name">Father/Husband Name*</label>
                            <input type="text" class="form-control" id="father_husband_name" name="father_husband_name" placeholder="Enter Father/Husband Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reference">Reference*</label>
                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Enter Reference">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Mobile Number*</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Mobile Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emergency">Emergency Number*</label>
                            <input type="text" class="form-control" id="emergency" name="emergency" placeholder="Enter Emergency Number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="illness">Any Illness*</label>
                            <input type="text" class="form-control" id="illness" name="illness" placeholder="Enter Illness Details">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="_99_yatra">99 Yatra on Shatrunjay Tirth?*</label>
                            <select name="_99_yatra" id="_99_yatra" class="form-control">
                              <option value="">Select</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="_12_gaon_chari_palit_sangh_yatra">12 Gaon Chari Palit Sangh Yatra?*</label>
                            <select name="_12_gaon_chari_palit_sangh_yatra" id="_12_gaon_chari_palit_sangh_yatra" class="form-control">
                              <option value="">Select</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="present_penance">What penance are you currently pursuing?*</label>
                            <input type="text" class="form-control" id="present_penance" name="present_penance" placeholder="Enter Present Penance">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religious_method">Religious Method*</label>
                            <input type="text" class="form-control" id="religious_method" name="religious_method" placeholder="Enter Religious Method">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Profile Photo* (allowed only JPG,JPEG &amp; PNG files)</label>
                            <div class="input-group image_div">
                                <div class="custom-file">             
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    $(document).ready(function(){
        $('#add-yatriks-form').validate({
            rules:{
                event_name:{
                    required: true
                },
                yatrik_id:{
                    required: true,
                    digits: true,
                    maxlength: 5
                },
                name:{
                    required: true
                },
                gender:{
                    required: true
                },
                age:{
                    required: true,
                    digits: true
                },
                aadhar_number:{
                    required: true,
                    digits: true,
                    minlength: 12,
                    maxlength: 12
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                },
                father_husband_name: {
                    required: true
                },
                reference: {
                    required: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10
                },
                emergency: {
                    required: true,
                    digits: true,
                    minlength: 10
                },
                email: {
                    required: true,
                    alphanumeric: true
                },
                illness: {
                    required: true
                },
                _99_yatra: {
                    required: true
                },
                _12_gaon_chari_palit_sangh_yatra: {
                    required: true
                },
                present_penance: {
                    required: true
                },
                religious_method:{
                    required: true
                },
                image: {
                    required: true,
                    extension: "png|jpg|jpeg",
                    maxsize: 2000000,
                }
            },
            messages:{
                event_name:{
                    required: "Please select event name."
                },
                yatrik_id:{
                    required: "Please enter yatrik id."
                },
                name:{
                    required: "Please enter name."
                },
                gender:{
                    required: "Please select gender."
                },
                age:{
                    required: "Please enter age."
                },
                aadhar_number:{
                    required: "Please enter aadhar number."
                },
                address: {
                    required: "Please enter address."
                },
                city: {
                    required: "Please enter city."
                },
                state: {
                    required: "Please enter state."
                },
                country: {
                    required: "Please enter country."
                },
                father_husband_name: {
                    required: "Please enter father/husband name."
                },
                reference: {
                    required: "Please enter reference."
                },
                phone: {
                    required: "Plese enter mobile number.",
                },
                emergency: {
                    required: "Plese enter emergency number.",
                },
                email: {
                    required: "Please enter email.",
                    email: "Please provide a valid email."
                },
                illness: {
                    required: "Please enter illness details."
                },
                _99_yatra: {
                    required: "Please select option."
                },
                _12_gaon_chari_palit_sangh_yatra: {
                    required: "Please select option."
                },
                present_penance: {
                    required: "Please enter present penance."
                },
                religious_method:{
                    required: "Please enter religious method."
                },
                image: {
                    required: "Please select image.",
                    extension: "Please select valid image.",
                    maxsize: "File size must be less than 2MB."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "image" ) {
                    $(".image_div").after(error);
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
@endsection