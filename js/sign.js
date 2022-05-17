$('#quenmk').click(function () {
    // e.preventDefault();
    $('#a-sign').css(
        "display", "none"
    )
    $('#b-sign').css(
        "display", "block"
    )
    console.log('a')

});
$('#huy').click(function () {
    // e.preventDefault();
    $('#b-sign').css(
        "display", "none"
    )
    $('#a-sign').css(
        "display", "block"
    )
});

$('#dangnhap').click(function (e) {

    const email = $('#username');
    const password = $('#password');
    const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.val())) {
    e.preventDefault();
        alert('Hay nhap dia chi email hop le.\nExample@gmail.com');
        email.focus;
        return false;
    }
    if (password.val() === '') {
    e.preventDefault();
        $('#password').html(`<div class="error" style="position: absolute; bottom: 0;background: #fff; padding:10px; border:1px solid #ccc; color: red">Please fill out this field </div>`)
        alert('Hay nhap password');
        
    }
});