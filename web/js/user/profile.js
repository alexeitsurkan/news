$(document).ready(function () {
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar').css({'background': 'url('+ e.target.result +')','background-size': 'cover'});
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#add_avatar').on('click', function () {
        $('#input_add_avatar').click();
    });
    $('#input_add_avatar').on('change',function () {
        readURL(this);
    });
});