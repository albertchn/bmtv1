function change1() {
    var x = document.getElementById('password1').type;

    if (x == 'password') {
        document.getElementById('password1').type = 'text';
        document.getElementById('btn-showhide1').innerHTML = '<span class="iconify" data-icon="fluent:eye-hide-20-regular" data-inline="false"></span>';
    } else {
        document.getElementById('password1').type = 'password';
        document.getElementById('btn-showhide1').innerHTML = '<span class="iconify" data-icon="fluent:eye-show-20-regular" data-inline="false"></span>';
    }
}

function change2() {
    var x = document.getElementById('password2').type;

    if (x == 'password') {
        document.getElementById('password2').type = 'text';
        document.getElementById('btn-showhide2').innerHTML = '<span class="iconify" data-icon="fluent:eye-hide-20-regular" data-inline="false"></span>';
    } else {
        document.getElementById('password2').type = 'password';
        document.getElementById('btn-showhide2').innerHTML = '<span class="iconify" data-icon="fluent:eye-show-20-regular" data-inline="false"></span>';
    }
}