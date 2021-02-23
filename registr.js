jQuery(document).ready(function($) {
    $('.registrationload').click(function(e, ) {
        e.preventDefault();
        let login = $('input[name="login"]').val();
        let password = $('input[name="password"]').val();
        let password_repeat = $('input[name="password_repeat"]').val();
        let email = $('input[name="email"]').val();
        let name = $('input[name="name"]').val();
        $.ajax({
            url: 'include/register.php',
            type: 'POST',
            datatype: 'json',
            data: {
                login: login,
                password: password,
                password_repeat: password_repeat,
                email: email,
                name: name

            },
            success() {
                async function getinfo() {
                    let info = await fetch('include/JS_AJAX/registrreque.json');
                    let content = await info.json();
                    if (content[0].status === true) {
                        document.location.href = 'login.html';
                    }
                    if ((content[0].status === false) && (content[0].type == '1')) {
                        $('.loginValidation').text(content[0].message);
                    }
                    if ((content[0].status === false) && (content[0].type == '2')) {
                        $('.passwordValidation').text(content[0].message);
                    }
                    if ((content[0].status === false) && (content[0].type == '3')) {
                        $('.password_repeatValidation').text(content[0].message);
                    }
                    if ((content[0].status === false) && (content[0].type == '4')) {
                        $('.emailValidation').text(content[0].message);
                    }
                    if ((content[0].status === false) && (content[0].type == '5')) {
                        $('.nameValidation').text(content[0].message);
                    }

                }
                getinfo();
            }
        });
    });
});