function setActiveNavBtn() {
    var url = window.location.href;
    var judicial = document.getElementById("judicial");
    var administrative = document.getElementById("administrative");

    if (url.includes(url)) {
        judicial.classList.add("active");
    } else if (url.includes(url)) {
        administrative.classList.add("active");
    }
}

window.addEventListener("load", setActiveNavBtn);
