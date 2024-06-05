function validazione_login(event) {
  
    const vista = document.querySelector("#error_login_view");
    vista.innerHTML = ''
    // verifico se tutti i campi inseriti sono corretti
    if (
      document.querySelector("#username_login").value.length === 0 ||
      document.querySelector("#password_login").value.length === 0
    ) {
      const div_errore = document.createElement("div");
      div_errore.classList.add("errore");
      const avviso = document.createElement("p");
      avviso.textContent = "Errore: tutti i campi devono essere compilati!";
      document.querySelector("#error_login_view").style.display = "flex";

      div_errore.appendChild(avviso); // Aggiungi l'avviso al DOM
      vista.appendChild(div_errore);
      event.preventDefault(); // Evita il comportamento predefinito del submit del modulo
    }
  }
  
   document.querySelector("#tasto_accedi").addEventListener("submit",validazione_login);

   document.querySelector("#tasto_accedi").addEventListener("click",validazione_login);

  
  
