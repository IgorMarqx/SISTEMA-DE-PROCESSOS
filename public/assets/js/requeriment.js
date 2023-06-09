function variables() {
    var coord = document.querySelector('.coord1');
    var coord2 = document.querySelector('.coord2');
    var coord3 = document.querySelector('.coord3');
    const coord_office_1 = document.querySelector('.coord_office_1');
    const coord_office_2 = document.querySelector('.coord_office_2');
    const coord_office_3 = document.querySelector('.coord_office_3');

    return {
        coord,
        coord2,
        coord3,
        coord_office_1,
        coord_office_2,
        coord_office_3,
    }
}

function getCoord1() {
    const { coord, coord_office_1 } = variables();
    coord_office_1.style.display = 'none';

    coord.addEventListener('input', function () {
        const inputValue = coord.value;
        const inputLength = inputValue.length;

        if (inputLength > 0) {
            coord_office_1.style.display = '';
        } else {
            coord_office_1.style.display = 'none';
        }
    })
}

function getCoord2() {
    const { coord2, coord_office_2 } = variables();
    coord_office_2.style.display = 'none';

    coord2.addEventListener('input', function () {
        const inputValue = coord2.value;
        const inputLength = inputValue.length;

        if (inputLength > 0) {
            coord_office_2.style.display = '';
        } else {
            coord_office_2.style.display = 'none';
        }
    })
}

function getCoord3() {
    const { coord3, coord_office_3 } = variables();
    coord_office_3.style.display = 'none';

    coord3.addEventListener('input', function () {
        const inputValue = coord3.value;
        const inputLength = inputValue.length;

        if (inputLength > 0) {
            coord_office_3.style.display = '';
        } else {
            coord_office_3.style.display = 'none';
        }
    })
}

function showFieldsOnValidationErrors() {
    const { coord_office_1, coord_office_2, coord_office_3 } = variables();

    // Verificar se há erros de validação nos campos correspondentes
    const errorsExist = document.querySelectorAll('.is-invalid').length > 0;

    // Exibir os campos correspondentes se houver erros de validação
    if (errorsExist) {
        coord_office_1.style.display = 'flex';
        coord_office_2.style.display = 'flex';
        coord_office_3.style.display = 'flex';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    getCoord1();
    getCoord2();
    getCoord3();
    showFieldsOnValidationErrors
});
