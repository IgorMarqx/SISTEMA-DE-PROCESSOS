function variables() {
    const select = document.querySelector('.valueAdmin');

    const organ = document.querySelector('.organ');
    const office = document.querySelector('.office');
    const capacity = document.querySelector('.capacity');
    const telephone = document.querySelector('.telephone');
    const cpf = document.querySelector('.cpf');
    const oab = document.querySelector('.oab');

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









