@extends('layouts.parent')

@section('title', 'My Transaction')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">My Transaction</h5>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                    <li class="breadcrumb-item active">MyTransaction</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-title"><i class="bi bi-cart"></i> List Transaction </div>

            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name Account</td>
                        <td>Reciever Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Status</td>
                        <td>Total Price</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($myTransaction as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>
                                @if ($row->status == 'EXPIRED')
                                    <span class="badge bg-danger text-uppercase">Expired</span>
                                @elseif ($row->status == 'PENDING')
                                    <span class="badge bg-warning text-uppercase">Pending</span>
                                @elseif ($row->status == 'SETTLEMENT')
                                    <span class="badge bg-info text-uppercase">Settlement</span>
                                @else
                                    <span class="badge bg-success text-uppercase">Success</span>
                                @endif
                            </td>
                            <td>RP. {{ number_format($row->total_price) }}</td>
                            <td>
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('admin.my-transaction.show', $row->name) }}" class="btn btn-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                @else
                                    <a href="{{ route('user.my-transaction.show', $row->name) }}" class="btn btn-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
