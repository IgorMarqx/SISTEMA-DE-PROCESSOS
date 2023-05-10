const pass = document.getElementById('password')
const eye = document.getElementById('eye')

function eyeClick() {
    const typePass = pass.type == 'password'

    if (typePass) {
        showPassword()
    } else {
        hidePassword()
    }
}

function showPassword() {
    pass.setAttribute('type', 'text')
    eye.src = 'assets/img/eye-close.svg'
}

function hidePassword() {
    pass.setAttribute('type', 'password')
    eye.src = 'assets/img/eye-open.svg'
}
