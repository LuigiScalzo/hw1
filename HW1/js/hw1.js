function chiudiMenu(event) {
    const button_chiudi = event.currentTarget;
    const linee = document.getElementById("tendina");
    const stile = linee.style.display;
    if (stile !== "flex") {
        linee.style.display = "flex";
    } else {
        linee.style.display = "none";
    }

}

function createImage(src) {
    const image = document.createElement("img");
    image.src = src;
    return image;
}


function apriImmagine(event) {
    const image = event.currentTarget.src;
    const i = createImage(image);
    document.body.classList.add("no-scroll");
    modalView.style.top = window.pageYOffset + 'px';
    modalView.appendChild(i);
    modalView.classList.remove("hidden");

}

function ClosedModal() {
    document.body.classList.remove("no-scroll");
    modalView.classList.add("hidden");
    modalView.innerHTML = " ";
}




function apriListaPreferiti(event) {
    const button = event.currentTarget;
    const lista_preferite = document.getElementById("listapreferite");
    const lista_preferite_style = lista_preferite.style.display;

    if (lista_preferite_style !== "flex") {
        lista_preferite.style.display = "flex";
    }
    else {
        lista_preferite.style.display = "none";
    }

}

const button_chiudi = document.querySelector("#listaMenu button");
button_chiudi.addEventListener("click", chiudiMenu);


const modalView = document.querySelector("#modal-view");
modalView.addEventListener("click", ClosedModal);

const imagini = (document.getElementsByClassName("image"));
for (const im of imagini) {
    im.addEventListener("click", apriImmagine);
}

const button_listapreferiti = document.querySelector("#frase button");
button_listapreferiti.addEventListener("click", apriListaPreferiti);










