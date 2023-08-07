{{-- Edit --}}
{{-- <a href="{{ route('package.edit', ['id' => $getSingleData->id]) }}">Edit</a> --}}

{{-- //Delete  --}}
{{-- <form action="{{ route('package.destroy', ['id' => $getSingleData->id]) }}" method="POST" --}}
{{-- onsubmit="return confirm('Are you sure you want to delete this package?');">
@csrf
@method('DELETE')
<button type="submit">Delete</button>
</form> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <form action="{{ route('upload.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="startingPriceCheckbox" class="form-label">Want to Add Starting Price</label>
                <input type="checkbox" class="form-check-input" id="startingPriceCheckbox" name="startingPriceCheckbox">
            </div>
            <div class="mb-3 d-none" id="startingPriceInput">
                <label for="startingPrice" class="form-label">Add Starting Price</label>
                <input type="text" class="form-control" name="startingPrice" id="startingPrice">
                @error('startingPrice')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dayNightCheckbox" class="form-label">Want to Add Day Night</label>
                <input type="checkbox" class="form-check-input" id="dayNightCheckbox" name="dayNightCheckbox">
            </div>
            <div class="mb-3 d-none" id="dayNightInputs">
                <label for="addDay" class="form-label">Add Day</label>
                <input type="text" class="form-control" name="addDay" id="addDay">
                @error('addDay')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="addNight" class="form-label">Add Night</label>
                <input type="text" class="form-control" name="addNight" id="addNight">
                @error('addNight')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#startingPriceCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#startingPriceInput').removeClass('d-none');
                } else {
                    $('#startingPriceInput').addClass('d-none');
                }
            });

            $('#dayNightCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#dayNightInputs').removeClass('d-none');
                } else {
                    $('#dayNightInputs').addClass('d-none');
                }
            });
        });
    </script>
</body>

</html>
