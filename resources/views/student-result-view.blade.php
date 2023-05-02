<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <div class="py-8">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3><b> {{ __('Create student Result') }}</b></h3>
                    <a href="{{ url('http://127.0.0.1:8000/dashboard') }}"><button type="button "
                            style="float:right;text-decoration:underline">Back</button>
                    </a>
                </div>
                <section class="gradient-custom">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 ">
                            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                <a href="{{ url('student-result') }}"><button type="button"
                                        class="btn btn-primary bg-dark float-right" id="create">Create
                                        Result</button>
                                    <div class="card-body p-4 p-md-5" id="form">
                                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5"><b>Student Result</b></h3>
                                    </div>
                                    <div class="class" id="table">
                                        <table class="table table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Student Name</th>
                                                    <th scope="col">Math</th>
                                                    <th scope="col">Science</th>
                                                    <th scope="col">English</th>
                                                    <th scope="col">Gujarati</th>
                                                    <th scope="col">Computer</th>
                                                    <th scope="col">Year</th>
                                                    <th scope="col">Obtained_marks</th>
                                                    <th scope="col">Total Marks</th>
                                                    <th scope="col">Percentage</th>
                                                    <th scope="col">Percentile</th>
                                                    <th scope="col">Record Added By</th>
                                                    <th scope="col">Edit </th>
                                                    <th scope="col">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($student as $result)
                                                    <tr>
                                                        <th scope="row">{{ $result->student->student_name }}</th>
                                                        <td>{{ $result->maths }}</td>
                                                        <td>{{ $result->science }}</td>
                                                        <td>{{ $result->english }}</td>
                                                        <td>{{ $result->gujarati }}</td>
                                                        <td>{{ $result->computer }}</td>
                                                        <td>{{ $result->exam_year }}</td>
                                                        <td>{{ $result->obtained_marks }}</td>
                                                        <td>{{ $result->total_marks }}</td>
                                                        <td>{{ $result->percentage }}</td>
                                                        <td>{{ $result->percentile }}</td>
                                                        <td>{{ $result->ecord_added_by }}</td>
                                                        <td><a  href="{{ url('get-student-result') }}/{{ $result->student_id }}"><button   type="button"  class="btn btn-primary bg-dark">Edit</button></a>                                              </td>
                                                        <td><a href="{{ url('delete-student-result') }}/{{ $result->student_id }}"  @method('DELETE')><button type="button"  class="btn btn-warning bg-dark text-white">Delete</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</x-app-layout>
