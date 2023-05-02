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
                                <div class="card-body p-4 p-md-5" id="form">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5"><b>Student Result</b></h3>
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <a href="{{ url('view-student-result') }}"><button type="button" class="btn btn-light btn-sm text-white bg-dark float-right">View All  Result</button></a>
                                   <br><br>
                                    <form action="{{ url('create-student-result') }}" method="post">
                                        @csrf
                                        <div class="row ">
                                            <div class="form-group col-6 mx-0">
                                            </div>
                                            <div class="form-group col-6 mx-0">
                                                <label for=""><b>Select Student</b></label>
                                                <select class="form-control" name="student" id="student_id"
                                                    id="" required>
                                                    <option value=" "> Select Student</option>
                                                    @foreach ($student as $result)
                                                        <option value="{{ $result->id }}">
                                                            {{ $result->student_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('student')
                                                    <div class="text-warning">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="number" name="math" value="{{ old('math') }}"
                                                        class="form-control form-control-lg" />
                                                    <label class="form-label">Enter Math Number</label>
                                                    @error('math')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="number" name="science"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('science') }}" />
                                                    <label class="form-label">Enter Science Number</label>
                                                    @error('science')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                                <div class="form-outline datepicker w-100">
                                                    <input type="number" name='english'
                                                        class="form-control form-control-lg"
                                                        value="{{ old('english') }}" />
                                                    <label class="form-label">Enter English Number</label>
                                                    @error('english')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                                <div class="form-outline datepicker w-100">
                                                    <input type="number" class="form-control form-control-lg"
                                                        name="gujarati" value="{{ old('gujarati') }}" />
                                                    <label class="form-label">Enter Gujarati Number</label>
                                                    @error('gujarati')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input type="number" name="computer"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('computer') }}" />
                                                    <label class="form-label">Enter Computer Number</label>
                                                    @error('computer')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <select class="form-control form-control-lg" id="year"
                                                        name="year">
                                                        @foreach (range(date('Y'), date('Y') - 20) as $year)
                                                            <option value="{{ $year }}">
                                                                {{ $year }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="form-label">Enter Exam year</label>
                                                    @error('year')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input type="number" name="obtained_mark"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('obtained_mark') }}" />
                                                    <label class="form-label">Enter Obtained_marks</label>
                                                    @error('obtained_mark')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input type="number" name="total_mark"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('total_mark') }}" />
                                                    <label class="form-label"> Enter Total Marks</label>
                                                    @error('total_mark')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input type="text" name="percentage"
                                                        class="form-control form-control-lg" value="%"
                                                        value="%" />
                                                    <label class="form-label" for="emailAddress">Enter
                                                        Percentage</label>
                                                    @error('percentage')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input type="text" class="form-control form-control-lg"
                                                        name="percentile" value="%" />
                                                    <label class="form-label"> Enter Percentile</label>
                                                    @error('percentile')
                                                        <div class="text-warning">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-outline">
                                            <button type="submit"
                                                class="btn btn-success btn-lg float-right text-dark bg-success">Save</button>
                                        </div>
                                    </form>
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
            $('#create').on('click', function() {
                $("#table").hide();
                $("#form").show();
            });
            $('#view').on('click', function() {
                $("#table").show();
                $("#form").hide();
            });
        });
    </script>
</x-app-layout>
