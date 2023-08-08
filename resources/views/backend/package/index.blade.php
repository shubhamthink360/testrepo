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
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Form Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <form action="{{ route('upload.store') }}" method="POST">
            @csrf
            {{-- Section 1 Started :: The section is for Type of the Package --}}
            <div class="row mb-3">
                <div class="col-md-12 offset-md-12">
                    <h3 class="mb-3"></h3>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="international">International</option>
                            <option value="domestic">Domestic</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <select name="location" id="location" class="form-control">
                            <!-- The options will be populated dynamically based on the selected type -->
                        </select>
                    </div>
                </div>
            </div>
            {{-- Section 1 ended --}}

            {{-- Section 2 Started :: The section is for the starting price, Day night checkbox --}}
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
            {{-- Section 2 Ended --}}

            {{-- Cropper Section --}}
            <div class="mb-3">
                <input type="file" name="image" class="image" id="reset-image">
                {{-- hidden input box --}}
                <input type="text" name="thumbnail" id="thumbnail">
            </div>
            <div class="cropped-image-container">
                <h2>Cropped Image</h2>

                <img id="croppedImage" src="" alt="Cropped Image" width="100px">
                <div class="image-controls"></div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var myUrl = "{{ route('upload.store') }}";
        var deleteImageUrl = "{{ route('delete.image', ['imageName' => '__imageName__']) }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/ajax/cropper.js') }}"></script>
    <script src="{{ asset('assets/ajax/get_countries_states.js') }}"></script>
    <script src="{{ asset('assets/ajax/price_day_night_checkbox.js') }}"></script>

</body>

</html>
