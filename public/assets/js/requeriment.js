function variables() {
    var coord = document.querySelector('.coord1');
    const coord_office_1 = document.querySelector('.coord_office_1');

    return {
        coord,
        coord_office_1
    }
}

function getCoord() {
    const { coord, coord_office_1 } = variables();
    coord_office_1.style.display = 'none';

    coord.addEventListener('change', function () {
        coord_office_1.style.display = '';
    })
}

document.addEventListener('DOMContentLoaded', function () {
    getCoord();
    variables();
});


