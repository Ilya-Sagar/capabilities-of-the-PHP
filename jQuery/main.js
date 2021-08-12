// make rules for input fields
let name = $("form #name")
name.change(function () {
    if (name.val().match(/^[A-Z a-z А-Я а-я ёЁ \s]*$/) === null) {
        name.css('background-color', 'red')
    } else {
        name.css('background', '')
    }
});


let age = $('form #age')

let phone = $("form #phone")
phone.change(function () {
    if (phone.val().match(/^[0-9 \( \) \- \s]*$/) === null) {
        phone.css('background-color', 'red')
    } else {
        phone.css('background', '')
    }
});


let salary = $('form #salary')


let department = $("form #department")
department.change(function () {
    if (department.val().match(/^[A-Z a-z А-Я а-я ёЁ \s]*$/) === null) {
        department.css('background-color', 'red')
    } else {
        department.css('background', '')
    }
});


// make button's behaviour
let button = $('form #button')
button.mousedown(function () {
    if (check()) {
        $.ajax({
            url: 'http://localhost/main.php',
            method: 'post',
            dataType: 'json',
            data: JSON.stringify({
                name: name.val(),
                age: age.val(),
                phone: phone.val(),
                salary: salary.val(),
                department: department.val()
            })
        })
            .done((res) => {
                showMessage('Вы были добавлены')
            })
            .fail((xhr, ajaxOptions, thrownError) => {
                showMessage('Во время добавления произошла ошибка')
            })
    } else {
        showMessage('Поля заполнены неправильно')
    }
});

// check for input field are filled right
function check() {
    success = true

    $('input:not(input[type=button])').each(function () {
        if (this.style.backgroundColor == 'red' || this.value == '') {
            success = false
        }
    })

    return success
}

// info window instead of alert
$('.modal').hide()

// bind hide action to cross
$('.modal .close').mousedown(() => {
    $('.modal').hide()
})


function showMessage(message) {
    $('.modal span').text(message)
    $('.modal').show()
}
