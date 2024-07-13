@extends('layouts.app')

@section('header')
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Choose Bright</h1>
            <nav aria-label="breadcrumb">
                <!-- Breadcrumb content here -->
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <!-- Search Start -->
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control border-0" id="search-name"
                                placeholder="Name / Email / Phone / Location" />
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0" id="search-job-category">
                                <option value="">Select Job Category</option>
                                <option value="1">admin</option>
                                <option value="2">covid19</option>
                                <option value="3">customerservice</option>
                                <option value="4">distributionshipping</option>
                                <option value="5">grocery</option>
                                <option value="6">hospitalityhotel</option>
                                <option value="7">marketingsales</option>
                                <option value="8">other</option>
                                <option value="9">production</option>
                                <option value="10">restaurantfoodservice</option>
                                <option value="11">retail</option>
                                <option value="12">supplychain</option>
                                <option value="13">transportation</option>
                                <option value="14">warehouse</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0" id="search-visa-type">
                                <option value="">Select Visa Type</option>
                                <option value="1">All</option>
                                <option value="2">DP</option>
                                <option value="3">EP</option>
                                <option value="4">F</option>
                                <option value="5">LTVP</option>
                                <option value="6">MY</option>
                                <option value="7">SG</option>
                                <option value="8">SP</option>
                                <option value="9">WP</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control border-0" id="search-zip-code" placeholder="Zip" />
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control border-0" id="search-min-salary"
                                placeholder="Min. Salary" />
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control border-0" id="search-max-salary"
                                placeholder="Max. Salary" />
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark border-0 w-100" id="search-button">Search</button>
                    <button class="btn btn-danger border-0 w-100" style="margin-top: 9px;" id="reset-button">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Search End -->

    <!-- Table Start -->
    <div class="bg-light py-5">
        <table id="jobseekers-table" class="table table-bordered table-striped">
            <thead>
                <tr style="background-color:#00B074 !important; color:#fff">
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Desired Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- Table End -->

    <!-- Modal Structure -->
    <div class="modal fade" id="jobseeker-modal" tabindex="-1" aria-labelledby="jobseekerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobseekerModalLabel">Job Seeker Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Full Name:</strong> <span id="modal-full-name"></span></p>
                            <p><strong>Email:</strong> <span id="modal-email"></span></p>
                            <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
                            <p><strong>Location:</strong> <span id="modal-location"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Zip Code:</strong> <span id="modal-zip-code"></span></p>
                            <p><strong>Desired Salary:</strong> <span id="modal-desired-salary"></span></p>
                            <p><strong>Job Categories:</strong> <span id="modal-job-categories"></span></p>
                            <p><strong>Visa Types:</strong> <span id="modal-visa-types"></span></p>
                        </div>
                    </div>
                    <hr id="education-separator">
                    <div id="education-section" class="info-box">
                        <h6>Education</h6>
                        <ul id="modal-education"></ul>
                    </div>
                    <hr id="work-experience-separator">
                    <div id="work-experience-section" class="info-box">
                        <h6>Work Experience</h6>
                        <ul id="modal-work-experience"></ul>
                    </div>
                    <hr id="employment-history-separator">
                    <div id="employment-history-section" class="info-box">
                        <h6>Employment History</h6>
                        <ul id="modal-employment-history"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
    let table = $('#jobseekers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url('jobseekers/datatables') }}',
            data: function(d) {
                d.name = $('#search-name').val();
                d.job_category_ids = $('#search-job-category').val();
                d.visa_type_ids = $('#search-visa-type').val();
                d.zip_code = $('#search-zip-code').val();
                d.min_salary = $('#search-min-salary').val();
                d.max_salary = $('#search-max-salary').val();
            }
        },
        language: {
            emptyTable: "No job seekers available",
            zeroRecords: "No matching job seekers found"
        },
        columns: [
            {
                data: 'full_name',
                name: 'full_name',
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },
            {
                data: 'email',
                name: 'email',
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },
            {
                data: 'phone',
                name: 'phone',
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },
            {
                data: 'location',
                name: 'location',
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },
            {
                data: 'desired_salary_cleaned',
                name: 'desired_salary_cleaned',
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            }
        ]
    });

    $('#search-button').on('click', function() {
        let name = $('#search-name').val().trim();
        let jobCategory = $('#search-job-category').val();
        let visaType = $('#search-visa-type').val();
        let zipCode = $('#search-zip-code').val().trim();
        let minSalary = $('#search-min-salary').val().trim();
        let maxSalary = $('#search-max-salary').val().trim();

        if (!name && !jobCategory && !visaType && !zipCode && !minSalary && !maxSalary) {
            alert('Please enter/select at least one filter.');
            return; // Prevent search if no filters are provided
        }

        table.draw(); // Proceed with search if validation passes
    });

    $('#jobseekers-table').on('click', '.view-btn', function() {
        let jobseekerId = $(this).data('id');

        $.ajax({
            url: '{{ url('jobseeker') }}/' + jobseekerId,
            method: 'GET',
            success: function(response) {
                if (response.error === 0) {
                    let data = response.data;
                    $('#modal-full-name').text(data.full_name);
                    $('#modal-email').text(data.email);
                    $('#modal-phone').text(data.phone);
                    $('#modal-location').text(data.location);
                    $('#modal-zip-code').text(data.zip_code);
                    $('#modal-desired-salary').text(data.desired_salary_cleaned);
                    $('#modal-job-categories').text(data.job_categories);
                    $('#modal-visa-types').text(data.visa_types);

                    // Clear previous data
                    $('#modal-education').empty();
                    $('#modal-work-experience').empty();
                    $('#modal-employment-history').empty();

                    // Handle Education
                    if (data.education && data.education.length > 0) {
                        $('#education-section').show();
                        $('#education-separator').show();
                        data.education.forEach(function(edu) {
                            $('#modal-education').append(
                                '<li>' +
                                '<strong>Institution:</strong> ' + edu.university_institution + '<br>' +
                                '<strong>Degree:</strong> ' + edu.degree_speciality + '<br>' +
                                '<strong>Start Date:</strong> ' + edu.start_date + '<br>' +
                                '<strong>End Date:</strong> ' + edu.end_date + '<br>' +
                                '<strong>Description:</strong> ' + edu.description +
                                '</li><br>'
                            );
                        });
                    } else {
                        $('#education-section').hide();
                        $('#education-separator').hide();
                    }

                    // Handle Work Experience
                    if (data.work_experience && data.work_experience.length > 0) {
                        $('#work-experience-section').show();
                        $('#work-experience-separator').show();
                        data.work_experience.forEach(function(exp) {
                            $('#modal-work-experience').append(
                                '<li>' +
                                '<strong>Title:</strong> ' + exp.title + '<br>' +
                                '<strong>Company:</strong> ' + exp.company + '<br>' +
                                '<strong>Start Date:</strong> ' + exp.start_date + '<br>' +
                                '<strong>End Date:</strong> ' + exp.end_date + '<br>' +
                                '<strong>Description:</strong> ' + exp.description + '<br>' +
                                '<strong>Leaving Reason:</strong> ' + exp.leaving_reason +
                                '</li><br>'
                            );
                        });
                    } else {
                        $('#work-experience-section').hide();
                        $('#work-experience-separator').hide();
                    }

                    // Handle Employment History
                    if (data.employment_history && data.employment_history.length > 0) {
                        $('#employment-history-section').show();
                        $('#employment-history-separator').show();
                        data.employment_history.forEach(function(hist) {
                            $('#modal-employment-history').append(
                                '<li>' +
                                '<strong>Company:</strong> ' + hist.employer_org_name + '<br>' +
                                '<strong>Position:</strong> ' + hist.position_title + '<br>' +
                                '<strong>Type:</strong> ' + hist.position_type + '<br>' +
                                '<strong>Description:</strong> ' + hist.description + '<br>' +
                                '<strong>Start Date:</strong> ' + hist.start_date + '<br>' +
                                '<strong>End Date:</strong> ' + hist.end_date +
                                '</li><br>'
                            );
                        });
                    } else {
                        $('#employment-history-section').hide();
                        $('#employment-history-separator').hide();
                    }

                    $('#jobseeker-modal').modal('show');
                }
            },
            error: function() {
                alert('Error retrieving job seeker details');
            }
        });
    });

    $('#reset-button').on('click', function() {
        // Clear all filter inputs
        $('#search-name').val('');
        $('#search-job-category').val('');
        $('#search-visa-type').val('');
        $('#search-zip-code').val('');
        $('#search-min-salary').val('');
        $('#search-max-salary').val('');

        // Trigger DataTable reload
        table.ajax.reload();
    });
});

    </script>
@endpush
