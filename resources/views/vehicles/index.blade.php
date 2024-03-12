<!-- resources/views/vehicles/index.blade.php -->
<?php
use App\Models\Type;
use Carbon\Carbon;

$types = Type::all();
$exitTimevehices = Carbon::now();
$exitTime = Carbon::now();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
       <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Parking Lot Automation</h1>
            </div>
            <div class="col-md-4 d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('settings') }}'">
                    <i class="bi bi-gear"></i> <!-- Gear icon -->
                </button>
            </div>
        </div>

        <form action="{{ route('vehicles.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="plate_number" class="form-label">Plate Number:</label>
                    <input type="text" name="plate_number" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" id="type" class="form-select" required>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="hourly_rate" class="form-label">Hourly Rate:</label>
                    <input type="number" name="hourly_rate" id="hourly_rate" step="0.01" min="0" class="form-control" >
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Vehicle</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Plate Number</th>
                    <th>Type</th>
                    <th>Hourly Rate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>{{ ucfirst($vehicle->type) }}</td>
                    <td>{{ $vehicle->hourly_rate }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#checkoutModal{{ $vehicle->id }}">
                            Checkout
                        </button>
                        <!-- Checkout Modal -->
                        <div class="modal fade" id="checkoutModal{{ $vehicle->id }}" tabindex="-1" aria-labelledby="checkoutModalLabel{{ $vehicle->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="checkoutModalLabel{{ $vehicle->id }}">Checkout Vehicle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Plate Number: {{ $vehicle->plate_number }}</p>
                                        <p>Type: {{ ucfirst($vehicle->type) }}</p>
                                        <p>Hourly Rate: ${{ $vehicle->hourly_rate }}</p>
                                        <hr>
                                        <p>Entry Time: {{ $vehicle->entry_time }}</p>
                                        <p>Exit Time: {{ $exitTimevehices }}</p>
                                        <p>Total Fee: ${{ number_format(($vehicle->hourly_rate * $exitTime->diffInSeconds($vehicle->entry_time)) / 3600, 2) }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('type').addEventListener('change', function() {
            var typeId = this.value;
            var hourlyRateInput = document.getElementById('hourly_rate');
            
            // AJAX request ile seçilen Type'a göre Hourly Rate'i getir
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    hourlyRateInput.value = response.price;
                }
            };
            xhr.open('GET', '/types/' + typeId, true);
            xhr.send();
        });
    });
</script>

</body>
</html>
