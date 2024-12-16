@extends('layouts.admin_layout')

@push('scripts')
    <!-- This is the styling for the modal of importing kaspersky keys -->
    <style>
        .modal {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0s 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s ease;
        }

        .modal-dialog {
            max-width: 500px;
            margin: 0 auto;
            border-radius: 8px;
        }

        .modal-content {
            border-radius: 8px;
        }
        .modal-title {
            color: #2c2c64;
            font-weight: 600;
        }
        .closeBtn {
            color: #fc4b3b;
        }
        .closeBtn i {
            font-size: x-large;
        }
        .importBtn {
            background-color: #fc4b3b;
            color: #fff;
            text-decoration: uppercase;
            font-weight: bold;
        }
        .importBtn:hover {
            background-color: #2c2c64;
            color: #000;
        }
        .importForm {
            margin-bottom: 2rem;
        }
    </style>
@endpush

@section('content')
<!-- KASPERSKY KEYS TABLE-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kaspersky Keys</h4>
            </div>
            <div class="card-body">
                <!-- Dropdown for filtering status -->
                <div class="mb-3">
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter" class="form-control">
                        <option value="">All</option>
                        <option value="1">Sold</option>
                        <option value="0">Not Sold</option>
                    </select>
                </div>

                <!-- Table for keys -->
                <div class="table-responsive">
                    <table id="kasperskyKeysTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Licence Key</th>
                                <th>Sold Status</th>
                                <th>Time Acquired</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Product Name</th>
                                <th>Licence Key</th>
                                <th>Sold Status</th>
                                <th>Time Acquired</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($kaspersky_keys as $key)
                            <tr>
                                <!-- Displaying the product name instead of product ID -->
                                <td>
                                    <a href="#">
                                        {{ $key->product->product_name }}
                                    </a>
                                </td>

                                <td>{{ $key->key_code }}</td>

                                <!-- Using status with icons -->
                                <td>
                                    @if ($key->sold_status == 1)
                                        <span class="badge badge-success">
                                            <i class="fa fa-check-circle"></i> Sold
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="fa fa-times-circle"></i> Not Sold
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $key->created_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cards for Exporting and Importing using Excel -->
                <div class="row mt-4">
                    <!-- Export Data card-->
                    <div class="col-md-6">
                        <div class="card bg-primary text-white">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Export Data</h5>
                                <!-- Icon for Export -->
                                <i class="fas fa-upload fa-2x"></i>
                            </div>
                            <div class="card-body text-center">
                                <a href="{{ route('exportKasperskyKeys') }}" class="btn btn-light">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Import Data card-->
                    <div class="col-md-6">
                        <div class="card bg-info text-white">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Import Data</h5>
                                <!-- Icon for Import -->
                                <i class="fas fa-download fa-2x"></i>
                            </div>
                            <div class="card-body text-center">
                                <!-- Trigger Import Modal -->
                                <button id="importBtn" class="btn btn-light">
                                    <i class="fas fa-file-upload"></i> Import from Excel
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Import Modal for user to upload the data-->
                    <div class="modal" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="importModalLabel">Import Kaspersky Keys from Excel Sheet</h5>
                                    <button type="button" class="closeBtn" id="closeModal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- File to upload the form -->
                                    <form action="{{ route('importKasperskyKeys') }}" method="POST" enctype="multipart/form-data" class="importForm">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file">Choose Excel File</label>
                                            <input type="file" name="file" id="file" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn importBtn">Import</button>
                                    </form>

                                    <!-- Import Guidelines -->
                                    <div class="alert alert-info">
                                        <strong>Guidelines for Importing Data:</strong>
                                        <ul>
                                            <li>The file must be in <strong>Excel (.xlsx)</strong> format.</li>
                                            <li>The first row should contain the column headers: <strong>product_id</strong>, <strong>key_code</strong>, and <strong>sold_status</strong>.</li>
                                            <li><strong>product_id:</strong> The ID of the product (must exist in the database).</li>
                                            <li><strong>key_code:</strong> The unique license key for the product.</li>
                                            <li><strong>sold_status:</strong> The status of the key (0 for "Not Sold", 1 for "Sold").</li>
                                            <li>Ensure there are no empty rows in the file.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!-- This script registers the table to the dataTables to make it dynamic -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable and store it in a variable
            var table = $('#kasperskyKeysTable').DataTable();

            // Event listener for the status filter dropdown
            $('#statusFilter').on('change', function() {
                var selectedStatus = $(this).val();

                // Apply the filter on the Sold Status column (index 2)
                if (selectedStatus !== '') {
                    // Directly filter by the numeric sold_status (0 for Not Sold, 1 for Sold)
                    table.column(2).search('^' + selectedStatus + '$', true, false).draw();
                } else {
                    // Reset the search when "All" is selected
                    table.column(2).search('').draw();
                }
            });
        });
    </script>
    <!-- This is the script that will controll the opening and closing of the modal to import the data -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the modal and button elements
            var modal = document.getElementById("importModal");
            var btn = document.getElementById("importBtn");
            var closeBtn = document.getElementById("closeModal");

            // When the user clicks the button, open the modal
            btn.addEventListener("click", function() {
                modal.classList.add("show");  // Show the modal with fade-in effect
            });

            // When the user clicks the close button (×), close the modal
            closeBtn.addEventListener("click", function() {
                modal.classList.remove("show");  // Hide the modal with fade-out effect
            });

            // Optional: Close the modal when clicking outside of the modal content
            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.classList.remove("show");  // Close the modal if clicked outside
                }
            });
        });
    </script>
@endpush