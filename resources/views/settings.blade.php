<!-- resources/views/settings.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-1  d-flex">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('vehicles.index') }}'">
                    <i class="bi bi-arrow-left"></i> <!-- Gear icon -->
                </button>
            </div>
            <div class="col-md-8">
                <h1>Settings</h1>
            </div>
            
        </div>
        &nbsp;
        <h2>Types</h2>
        <hr class="my-4">
        <div class="mb-3">
            <form action="{{ route('types.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Type:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter type" required>
                    </div>
                    <div class="col-md-4">
                        <label for="price" class="form-label">Price:</label>
                        <input type="number" name="price" step="0.01" min="0" class="form-control" placeholder="Enter price" required>
                       
                    </div>
                    <div class="col-md-4 d-flex  align-items-center">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>

          <table class="table">
          <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
              
                </tr>
            </thead>
            <tbody>
            @isset($types)
                @foreach($types as $type)
            <tr>
                <td>
                {{ $type->id }}
                </td>
                <td>
                {{ $type->name }}
                </td>
                <td>
                ${{ $type->price }}
                </td>
                <td>
                <form action="{{ route('types.destroy', $type->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
                </td>
            </tr>
            
            </tbody>
            @endforeach
            @endisset
          </table>
          
         

                  
             
        </ul>
    </div>
    &nbsp;
    <h2>Daily Earnings</h2>
    <hr class="my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Earning</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dailyEarnings as $dailyEarning)
                    <tr>
                        <td>{{ $dailyEarning->date }}</td>
                        <td>${{ number_format($dailyEarning->earning, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
