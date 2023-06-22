function year() {
    var selectAno = document.getElementById("filterYear");
    var anoAtual = new Date().getFullYear();

    var urlParams = new URLSearchParams(window.location.search);
    var anoSelecionado = urlParams.get("filterYear");

    selectAno.innerHTML = "";

    for (var i = anoAtual; i >= 2022; i--) {
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

window.onload = function () {
    year();
    year2();
};
