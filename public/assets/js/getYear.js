function year() {
    var selectAno = document.getElementById("filterYear");
    var anoAtual = new Date().getFullYear();

    var urlParams = new URLSearchParams(window.location.search);
    var anoSelecionado = urlParams.get("filterYear");

    selectAno.innerHTML = "";

    for (var i = anoAtual; i >= 2023; i--) {
        var option = document.createElement("option");
        option.text = i;
        option.value = i;

        if (i == anoSelecionado) {
            option.selected = true;
        }

        selectAno.appendChild(option);
    }
}

function year2() {
    var selectAno = document.getElementById("filterYear2");
    var anoAtual = new Date().getFullYear();

    var urlParams = new URLSearchParams(window.location.search);
    var anoSelecionado = urlParams.get("filterYear");

    selectAno.innerHTML = "";

    for (var i = anoAtual; i >= 2023; i--) {
        var option = document.createElement("option");
        option.text = i;
        option.value = i;

        if (i == anoSelecionado) {
            option.selected = true;
        }

        selectAno.appendChild(option);
    }
}

function displayYear() {
    var selectAno = document.getElementById("filterYear");
    var selectMes = document.getElementById("filterDays");
    var anoAtual = new Date().getFullYear();

    if (selectAno.value != anoAtual) {
        selectMes.style.display = 'none';
    } else {
        selectMes.style.display = '';
    }
}

function displayYear2() {
    var selectAno = document.getElementById("filterYear2");
    var selectMes = document.getElementById("filterDays2");
    var anoAtual = new Date().getFullYear();

    if (selectAno.value != anoAtual) {
        selectMes.style.display = 'none';
    } else {
        selectMes.style.display = '';
    }
}

window.onload = function () {
    year();
    year2();
    displayYear();
    displayYear2();
};
