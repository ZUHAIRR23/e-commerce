@extends('layouts.parent')

@section('title', 'User')

@section('content')

    <div class="card">
        <div class="card-body">
            <p class="badge bg-warning text-dark mt-2">
                <i class="bi bi-info-circle me-1"></i> | {{ Auth::user()->role }}
            </p>
            <h5 class="card-title fs-4 fw-bold">Hello👋.... {{ Auth::user()->name }}</h5>
            <h4 class="fs-5 fw-bold">{{ Auth::user()->email }}</h4>
            <p class="fs-6 fw-semibold">{{ Auth::user()->created_at }}</p>
        </div>
    </div>

    <div class="section dashboard">
        <div class="row">
            <div class="col-md-4">
                {{-- category card --}}
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Pending</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $pending }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end catagory card --}}
            </div>

            <div class="col-md-4">
                {{-- Product card --}}
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Settlement</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $settlement }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end product card --}}
            </div>

            <div class="col-md-4">
                {{-- User card --}}
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Expired</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $expired }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end User card --}}
            </div>

        </div>
    </div>

@endsection
