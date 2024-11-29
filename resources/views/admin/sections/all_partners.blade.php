@extends('layouts.admin_layout')

@section('content')
<!-- ALL PARTNERS TABLE -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cybill Software Partners</h4>
            </div>
            <div class="card-body">
                <!-- Dropdown for filtering partners by admin status and verification -->
                <form method="GET" action="{{ route('admin.all_partners') }}">
                    <div class="mb-3">
                        <label for="productFilter" class="form-label">Filter by</label>
                        <select id="productFilter" name="filter" class="form-select custom-select" onchange="this.form.submit()">
                            <option value="">All Partners</option>
                            <option value="verified" {{ request('filter') == 'verified' ? 'selected' : '' }}>Verified</option>
                            <option value="unverified" {{ request('filter') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                            <option value="non-admin" {{ request('filter') == 'non-admin' ? 'selected' : '' }}>Non-Admin</option>
                            <option value="admin" {{ request('filter') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </form>

                <!-- Table for displaying partners -->
                <div class="table-responsive">
                    <table id="AllPartnersTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Member Since</th>
                                <th>Verification Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Member Since</th>
                                <th>Verification Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allPartners as $partner)
                            <tr>
                                <td>{{ $partner->name }}</td>
                                <td>{{ $partner->email }}</td>
                                <td>{{ $partner->phone }}</td>
                                <td>{{ $partner->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($partner->email_verified_at)
                                        Verified
                                    @else
                                        Unverified
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#AllPartnersTable').DataTable();
        });
    </script>
@endpush
