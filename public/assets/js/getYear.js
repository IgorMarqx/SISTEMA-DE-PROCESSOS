function year() {
    var selectAno = document.getElementById("filterYear");
    var anoAtual = new Date().getFullYear(); // Obtém o ano atual

    // Limpa as opções existentes
    selectAno.innerHTML = "";

    // Adiciona as opções de anos
    for (var i = anoAtual; i >= 2023; i--) {
        var option = document.createElement("option");
        option.text = 'Último ano ' + i;
        option.value = i;
        selectAno.appendChild(option);
    }
}

function year2() {
    var selectAno = document.getElementById("filterYear2");
    var anoAtual = new Date().getFullYear(); // Obtém o ano atual

    // Limpa as opções existentes
    selectAno.innerHTML = "";

    // Adiciona as opções de anos
    for (var i = anoAtual; i >= 2023; i--) {
        var option = document.createElement("option");
        option.text = 'Último ano ' + i;
        option.value = i;
        selectAno.appendChild(option);
    }
}


year();
year2();
