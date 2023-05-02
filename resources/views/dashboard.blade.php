<x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Add student Record') }}
                    <a href="{{ url('student-result') }}"><button type="button " class="btn btn-success"  style="float:right">Create Result</button></a>
                    <button type="button " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" style="float:right">Add</button>
                </div>
                <table class="table" id="myTable" >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Date Of Birth</th>
                            <th>Address</th>
                            <th>Parent Mobile Number</th>
                            <th>Parent Email Id</th>
                            <th>Image</th>
                            <th>Student Year Group</th>
                            <th>Record Addredd By</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="tabledata">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"  style="overflow-y:scroll;height:600px">
                    <form id="form">
                        <div class="form-group">
                            <label for="student-name" class="col-form-label"> Student Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Student name">
                            <input class="form-control form-control-lg form-control-solid"  id ="id" hidden>
                        </div>
                        <div class="form-group">
                            <label for="student-age" class="col-form-label">Age</label>
                            <input type="number" class="form-control" id="age" placeholder="age"  min="1" max="300">
                        </div>
                        <div class="form-group">
                            <label for="Date of birth" class="col-form-label"> DOB</label>
                            <input type="date" class="form-control" id="dob" placeholder="date of birth">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="address">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Parent mobile number</label>
                            <input type="number" class="form-control" id="p_number" placeholder="Mobile number">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Parent Email Id</label>
                            <input type="email" class="form-control" id="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Student Photo</label>
                            <input type="FILE" class="form-control" id="image" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Student Year Group</label>
                            <input type="text" class="form-control" id="year" >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="color:black">Close</button>
                    <button type="button" class="btn btn-primary" style="color:black" id="save">Add</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
		$(document).ready(function () {
        var xhr;
        $('#myTable').DataTable();
        function request_call(url, mydata) {
            var base_url = window.location.origin;
            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            xhr = $.ajax({
                url:base_url+"/"+url,
                type: 'post',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                data: mydata,
            });
        }
        function request_calls(url, mydata) {
            var base_url = window.location.origin;
            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            xhr = $.ajax({
                url:base_url+"/"+url,
                type: 'post',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: mydata,
            });
        }
        function fetch_record(){
            var ids = '';
            request_call('student-record', "ids" + ids);
            xhr.done(function(response) {
                $('#tabledata').html(response);
            });
        }
        fetch_record();
        $('#save').click(function() {
            let ids=$('#id').val();
            let name = $('#name').val();
            let age = $('#age').val();
            let dob = $('#dob').val();
            let address = $('#address').val();
            let p_number = $('#p_number').val();
            let email = $('#email').val();
            var fileInput = document.getElementById('image');
            var formData = new FormData();
            formData.append('image', fileInput.files[0]);
            let year  =$('#year').val();
            if (!name) {
                Swal.fire({title: "error", icon: "warning", text: "Name field required!"});
            }else if (!age) {
                Swal.fire({title: "error", icon: "warning", text: "Age field required!"});
            }else if(!dob){
                Swal.fire({title: "error", icon: "warning", text: "Date of birth required!"});
            }else if(!address){
                Swal.fire({title: "error", icon: "warning", text: "Address field required!"});
            }else if(!p_number){
                Swal.fire({title: "error", icon: "warning", text: "Phone number required!"});
            }else if(!email){
                    Swal.fire({title: "error", icon: "warning", text: "Email id field required!"});
            }else if(!year){
                    Swal.fire({title: "error", icon: "warning", text: "Student Year Group required!"});
            }else{
                formData.append('id', ids);
                formData.append('name', name);
                formData.append('age', age);
                formData.append('dob', dob);
                formData.append('address', address);
                formData.append('p_number', p_number);
                formData.append('email', email);
                formData.append('year', year);
                request_call('add-student-record', formData);
                xhr.done(function(mydata) {
                    if(mydata){
                        $('.modal').removeClass('in').attr("aria-hidden","true").css("display", "none");
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $("#form").trigger("reset");
                        Swal.fire('success','Student Record Created Successfully !','success');
                    } else {
                        Swal.fire('warning','Something Error!','warning');
                    }
                    fetch_record();
                })
            }
        });
        $('#tabledata').delegate('.edit', 'click', function() {
            $("#form").trigger("reset");
            var student_id=$(this).attr('id');
            request_calls('edit-student-record', "id=" + student_id);
            xhr.done(function(response) {
                $('#id').val(response.id);
                $('#name').val(response.student_name);
                $('#age').val(response.age);
                $('#customer_id').val(response.customer_id);
                $("#dob").val(response.date_of_birth);
                $("#address").val(response.address);
                $("#p_number").val(response.parent_mobile_no).change();
                $('#email').val(response.parent_email_id);
                $('#year').val(response.student_year_group);
                $('#image').val(response.student_photo);
            });
        });
        $('#tabledata').delegate('.delete', 'click', function() {
            var student_id=$(this).attr('id');
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to Delete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete!"
            }).then(function(result) {
                if (result.value) {
                request_calls('delete-student-record', "id=" + student_id);
                xhr.done(function(response) {
                    if(response){
                            Swal.fire('success','Deleted Successfully!','success');
                    } else {
                        Swal.fire('warning','Something Error!','warning');
                    }
                    });
                    setTimeout(function(){
                        fetch_record();
                    }, 100);
                }
            })
        });
    });
    </script>
</x-app-layout>
