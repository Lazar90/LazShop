@extends('layouts.auth', ['title' => 'Coupons'])

@section('content')
    <div class="container p-4">
        <h1>Coupons</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Coupons Table
                @can('coupon_create')
                    <a href="{{ route('coupons.create') }}" class="btn btn-primary btn-sm float-right">Create</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Expiry Day</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Expiry Day</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->type }}</td>
                                <td>{{ $coupon->amount }}</td>
                                <td>{{ $coupon->expiry_date }}</td>
                                <td class="d-flex">
                                    @can('coupon_edit')
                                        <a href="{{ route('coupons.edit', $coupon->id) }}"
                                           class="btn btn-info btn-sm mr-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('coupon_delete')
                                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?')">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <h2 class="text-center">No coupon found.</h2>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $coupons->links() }}
            </div>
        </div>
    </div>

@endsection
