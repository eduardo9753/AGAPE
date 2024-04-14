@extends('layouts.app')


@section('body')

    <body>

        <!-- Page wrapper start -->
        <div class="page-wrapper">

            <!-- App container starts -->
            <div class="app-container">

                <!-- App header starts -->
                @include('helpers.header-start')
                <!-- App header ends -->

                <!-- App navbar starts -->
                @include('template.nav-admin')
                <!-- App Navbar ends -->

                <!-- App body starts -->
                <div class="app-body">

                    <!-- Container starts -->
                    <div class="container">

                        <!-- Row start -->
                        <div class="row">
                            <div class="col-12 col-xl-6">

                                <!-- Breadcrumb start -->
                                <ol class="breadcrumb mb-3">
                                    <li class="breadcrumb-item">
                                        <i class="icon-house_siding lh-1"></i>
                                        <a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">Dashboards</li>
                                    <li class="breadcrumb-item text-light">Analytics</li>
                                </ol>
                                <!-- Breadcrumb end -->
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row gx-2">
                            <div class="col-xl-6 col-12">
                                <!-- Row start -->
                                <div class="row gx-2">
                                    <div class="col-sm-6 col-12">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <h5 class="card-title">Today's Tickets</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Completed</span>
                                                    <span class="fw-bold">75%</span>
                                                </div>
                                                <div class="progress small">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <h5 class="card-title">New Tickets</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Assigned</span>
                                                    <span class="fw-bold">5</span>
                                                </div>
                                                <div class="progress small">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="row gx-2">
                                    <div class="col-sm-4 col-6">
                                        <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                                            <div class="position-relative shape-block">
                                                <img src="{{ asset('assets/images/shape1.png') }}" class="img-fluid img-4x"
                                                    alt="Bootstrap Themes" />
                                                <i class="icon-book-open"></i>
                                            </div>
                                            <div class="ms-2">
                                                <h3 class="m-0 fw-semibold">27</h3>
                                                <h6 class="m-0 fw-light text-light">Active</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                                            <div class="position-relative shape-block">
                                                <img src="{{ asset('assets/images/shape2.png') }}" class="img-fluid img-4x"
                                                    alt="Bootstrap Themes" />
                                                <i class="icon-check-circle"></i>
                                            </div>
                                            <div class="ms-2">
                                                <h3 class="m-0 fw-semibold">18</h3>
                                                <h6 class="m-0 fw-light text-light">Solved</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                                            <div class="position-relative shape-block">
                                                <img src="{{ asset('assets/images/shape3.png') }}" class="img-fluid img-4x"
                                                    alt="Bootstrap Themes" />
                                                <i class="icon-x-circle"></i>
                                            </div>
                                            <div class="ms-2">
                                                <h3 class="m-0 fw-semibold">12</h3>
                                                <h6 class="m-0 fw-light text-light">Closed</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                                            <div class="position-relative shape-block">
                                                <img src="{{ asset('assets/images/shape4.png') }}" class="img-fluid img-4x"
                                                    alt="Bootstrap Themes" />
                                                <i class="icon-add_task"></i>
                                            </div>
                                            <div class="ms-2">
                                                <h3 class="m-0 fw-semibold">3</h3>
                                                <h6 class="m-0 fw-light text-light">Open</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                                            <div class="position-relative shape-block">
                                                <img src="{{ asset('assets/images/shape5.png') }}" class="img-fluid img-4x"
                                                    alt="Bootstrap Themes" />
                                                <i class="icon-alert-triangle"></i>
                                            </div>
                                            <div class="ms-2">
                                                <h3 class="m-0 fw-semibold">5</h3>
                                                <h6 class="m-0 fw-light text-light">Critical</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                                            <div class="position-relative shape-block">
                                                <img src="{{ asset('assets/images/shape6.png') }}"
                                                    class="img-fluid img-4x" alt="Bootstrap Themes" />
                                                <i class="icon-access_time"></i>
                                            </div>
                                            <div class="ms-2">
                                                <h3 class="m-0 fw-semibold">7</h3>
                                                <h6 class="m-0 fw-light text-light">High</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->



                        <!-- Row start -->
                        <div class="row gx-2">
                            <div class="col-xl-6 col-lg-12 col-12">
                                <div class="card mb-2">
                                    <div class="card-header">
                                        <h5 class="card-title">Top 5 Agents</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="border rounded-3">
                                            <div class="table-responsive">
                                                <table class="table align-middle custom-table m-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Agent</th>
                                                            <th>Tickets</th>
                                                            <th>Time Spent</th>
                                                            <th>Feedback</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <div class="fw-semibold">Elisa Shah</div>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-primary">54</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge border border-light">2 Hrs 30
                                                                    Mins</span>
                                                            </td>
                                                            <td>
                                                                <div class="starReadOnly1 rating-stars my-2"></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>
                                                                <div class="fw-semibold">Ladonna Jones</div>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-primary">49</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge border border-light">2 Hrs 21
                                                                    Mins</span>
                                                            </td>
                                                            <td>
                                                                <div class="starReadOnly2 rating-stars my-2"></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <div class="fw-semibold">Jewel Alexander</div>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-primary">45</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge border border-light">2 Hrs 15
                                                                    Mins</span>
                                                            </td>
                                                            <td>
                                                                <div class="starReadOnly1 rating-stars my-2"></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <div class="card mb-2">
                                    <div class="card-header">
                                        <h5 class="card-title">Feedback</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="scroll200">
                                            <div class="my-2">
                                                <div class="d-flex align-items-start">
                                                    <div class="media-box me-3 bg-primary rounded-5">
                                                        <i class="icon-thumbs-up"></i>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h5>Christian Ochoa</h5>
                                                        <p class="mb-1">Amazing</p>
                                                        <p class="m-0 text-light">3 mins ago</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start">
                                                    <div class="media-box me-3 bg-primary rounded-5">
                                                        <i class="icon-thumbs-up"></i>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h5>Lily Lyons</h5>
                                                        <p class="mb-1">Thanks</p>
                                                        <p class="m-0 text-light">9 mins ago</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Row end -->

                    </div>
                    <!-- Container ends -->

                </div>
                <!-- App body ends -->

                <!-- App footer start -->
                <div class="app-footer">
                    <div class="container">
                        <span>© SysPedidos @php
                            echo date('Y');
                        @endphp </span>
                    </div>
                </div>
                <!-- App footer end -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Page wrapper end -->


    </body>
@endsection
