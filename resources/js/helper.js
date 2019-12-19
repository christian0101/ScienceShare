// source: https://codepen.io/waqasy/pen/rkuJf
function previewFile(input)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

let toastsView = new Toast();

function showNotification (msg, duration, options) {
   toastsView.create(msg, duration, options);
}
