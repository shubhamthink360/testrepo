/*---------------Cropper------------*/
$(document).ready(function() {
var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
$(".cropped-image-container").hide();

$("body").on("change", ".image", function(e) {
    var files = e.target.files;
    var done = function(url) {
        image.src = url;
        $modal.modal('show');
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
        file = files[0];

        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function(e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});

$modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
    });
}).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
});

$("#crop").click(function() {
    canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400,
    });
    
    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
            var base64data = reader.result;

            $.ajax({
                type: "POST",
                dataType: "json",
                url: myUrl,
                data: {
                    '_token': $('meta[name="_token"]').attr('content'),
                    'image': base64data
                },
                success: function(data) {
                    console.log('data',data);
                    $modal.modal('hide');
                    $("#croppedImage").attr("src", base64data);
                    $(".cropped-image-container").show();
                    console.log(data.image_url);
                    $("#thumbnail").val(data.file_name);
                    var deleteButton = '<button type="button" class="btn btn-danger btn-sm delete-image" data-image="' + data.image_url + '">Delete</button>';
                    $('.image-controls').html(deleteButton);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});

// Delete Image
$("body").on("click", ".delete-image", function() {
    var imageUrl = $(this).data("image");
    var deleteUrl = deleteImageUrl.replace('__imageName__', imageUrl.split('/').pop());
    console.log('image url delete',imageUrl); 

    // Make an AJAX request to the route that handles image deletion
    $.ajax({
        type: "POST",
        dataType: "json",
        url: deleteUrl,
        data: {
            '_token': $('meta[name="_token"]').attr('content'),
            // 'imageName': imageUrl.split('/').pop() // Extract the image name from the URL
        },
        success: function(data) {
            // Handle success (e.g., hide the image container, remove the delete button, etc.)
            $("#croppedImage").attr("src", "");
            $(".cropped-image-container").hide();
            $('.image-controls').html('');
            $("#reset-image").val("");
            $("#thumbnail").val("");
        }
    });
});
});