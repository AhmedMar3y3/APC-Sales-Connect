@extends('Leader.layout')
@section('main')

<!-- Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="container dashboard">
    <div class="row">
        <!-- Doctors Card -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Doctors <span>| Total</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $totalDoctors }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pharmacies Card -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Pharmacies <span>| Total</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-prescription"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $totalPharmacies }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
              <!-- Total Medications Card -->
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Medications <span>| Total</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-capsule"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalMedications }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Total Representatives -->
        
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Representatives <span>| Total</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $representatives }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Supervisors <span>| Total</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $supervisors }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Code   -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Code for Supervisors</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $code }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard .row {
        justify-content: center;
    }

    .dashboard .info-card {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        border-radius: 12px;
        margin-top: 15px;
        min-height: 120px; 

    }

    .dashboard .card-icon {
        color: #4154f1 !important;
        background: #fefefe !important;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 45px;
    }

    .dashboard h5.card-title {
        font-size: 1.5rem;
    }

    .dashboard h6 {
        font-size: 2rem;
    }

    .dashboard .container {
        max-width: 1000px;
    }
</style>

@endsection
