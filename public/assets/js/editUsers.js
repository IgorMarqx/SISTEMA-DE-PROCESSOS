function variables() {
    var select = document.querySelector('#admin');
    var selectedOption = select.value;

    const organ = document.querySelector('.organ');
    const office = document.querySelector('.office');
    const capacity = document.querySelector('.capacity');
    const telephone = document.querySelector('.telephone');
    const cpf = document.querySelector('.cpf');
    const oab = document.querySelector('.oab');

    function saveSelectedValue() {
        localStorage.setItem('selectedValue', select.value);
    }

    function loadSelectedValue() {
        const selectedValue = localStorage.getItem('selectedValue');
        if (selectedValue) {
            select.value = selectedValue;
        }
    }

    // Salva o valor selecionado no localStorage quando houver alteração
    select.addEventListener('change', saveSelectedValue);

    // Carrega o valor selecionado do localStorage ao carregar a página
    loadSelectedValue();

    // Verifica o valor selecionado e exibe os campos apropriados
    if (select.value == 0) {
        organ.style.display = '';
        office.style.display = '';
        capacity.style.display = '';
        telephone.style.display = '';
        cpf.style.display = 'none';
        oab.style.display = 'none';
    } else if (select.value == 2) {
        organ.style.display = 'none';
        office.style.display = 'none';
        capacity.style.display = 'none';
        telephone.style.display = '';
        cpf.style.display = '';
        oab.style.display = '';
    } else if (select.value == 3) {
        organ.style.display = '';
        office.style.display = '';
        capacity.style.display = '';
        telephone.style.display = '';
        cpf.style.display = 'none';
        oab.style.display = 'none';
    }


    return {
        organ,
        office,
        capacity,
        telephone,
        selectedOption,
        select,
        cpf,
        oab
    }
}

function displayLawyer() {
    const { organ, office, capacity, telephone, selectedOption, cpf, oab, select } = variables();

    cpf.style.display = '';
    oab.style.display = '';
    telephone.style.display = '';
    organ.style.display = 'none';
    office.style.display = 'none';
    capacity.style.display = 'none';
}

function displayUser() {
    const { organ, office, capacity, telephone, selectedOption, cpf, oab, select } = variables();

    cpf.style.display = 'none';
    oab.style.display = 'none';
    organ.style.display = '';
    office.style.display = '';
    capacity.style.display = '';
    telephone.style.display = '';
}

function displayAdmin() {
    const { organ, office, capacity, telephone, selectedOption, cpf, oab, select } = variables();

    cpf.style.display = 'none';
    oab.style.display = 'none';
    organ.style.display = 'none';
    office.style.display = 'none';
    capacity.style.display = 'none';
    telephone.style.display = 'none';
}

function user() {
    const { organ, office, capacity, telephone, selectedOption, cpf, oab, select } = variables();

    if (select.value == 0) {
        displayUser();
    } else if (select.value == 1) {
        displayAdmin()
    } else if (select.value == 2) {
        displayLawyer();
    } else if (select.value == 3) {
        displayUser();
    }

    select.addEventListener('change', () => {
        if (select.value == 0) {
            displayUser();
        } else if (select.value == 1) {
            displayAdmin()
        } else if (select.value == 2) {
            displayLawyer();
        } else if (select.value == 3) {
            displayUser();
        }
        console.log(select.value)
    })
}

document.addEventListener('DOMContentLoaded', function () {
    user();
    displayAdmin();
    displayUser();
    displayLawyer();
    variables();
});
