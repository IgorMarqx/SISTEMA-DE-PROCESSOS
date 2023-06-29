function variables() {
    const select = document.querySelector('.valueAdmin');

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
        select,
        cpf,
        oab
    }
}

function error() {
    const { organ, office, capacity, telephone, select, cpf, oab } = variables();

    if (select.value == 'error' || select.value == 1) {
        organ.style.display = 'none'
        office.style.display = 'none'
        capacity.style.display = 'none'
        telephone.style.display = 'none'
        cpf.style.display = 'none'
        oab.style.display = 'none'
    }

    select.addEventListener('change', () => {
        if (select.value == 'error' || select.value == 1) {
            organ.style.display = 'none'
            office.style.display = 'none'
            capacity.style.display = 'none'
            telephone.style.display = 'none'
            cpf.style.display = 'none'
            oab.style.display = 'none'
        }
    })

}

function user() {
    const { organ, office, capacity, telephone, select, cpf, oab } = variables();

    select.addEventListener('change', () => {
        if (select.value == 0) {
            organ.style.display = ''
            office.style.display = ''
            capacity.style.display = ''
            telephone.style.display = ''
            cpf.style.display = 'none'
            oab.style.display = 'none'
        }
    })

}

function lawyer() {
    const { organ, office, capacity, telephone, select, cpf, oab } = variables();

    select.addEventListener('change', () => {
        if (select.value == 2) {
            organ.style.display = 'none'
            office.style.display = 'none'
            capacity.style.display = 'none'
            telephone.style.display = ''
            cpf.style.display = ''
            oab.style.display = ''
        }
    })
}

function directors() {
    const { organ, office, capacity, telephone, select, cpf, oab } = variables();

    select.addEventListener('change', () => {
        if (select.value == 3) {
            organ.style.display = ''
            office.style.display = ''
            capacity.style.display = ''
            telephone.style.display = ''
            cpf.style.display = 'none'
            oab.style.display = 'none'
        }
    })
}

document.addEventListener('DOMContentLoaded', function () {
    error();
    user();
    lawyer();
    directors();
    variables();
});









