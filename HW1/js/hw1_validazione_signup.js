/*function validazione_signup(event) {

    const vista = document.querySelector("#error_signup_view");
    vista.innerHTML = ''
    // verifico se tutti i campi inseriti sono corretti
    if (
      document.querySelector("#username_signup").value.length === 0 ||
      document.querySelector("#nome_signup").value.length === 0 || 
      document.querySelector("#cognome_signup").value.length === 0 || 
      document.querySelector("#data_di_nascita_signup").value.length === 0 || 
      document.querySelector("#email_signup").value.length === 0 ||
      document.querySelector("#sesso_signup").value.length === 0 ||
      document.querySelector("#indirizzo_signup").value.length === 0 ||
      document.querySelector("#codice_postale_signup").value.length === 0 ||
      document.querySelector("#nazione_signup").value.length === 0 ||
      document.querySelector("#citta_signup").value.length === 0 ||
      document.querySelector("#provincia_signup").value.length === 0 || 
      document.querySelector("#password_signup").value.length === 0
    ) {
      const div_errore = document.createElement("div");
      div_errore.classList.add("errore");
      const avviso = document.createElement("p");
      avviso.textContent = "Errore: tutti i campi devono essere compilati!";
      document.querySelector("#error_signup_view").style.display = "flex";

      div_errore.appendChild(avviso); // Aggiungi l'avviso al DOM
      vista.appendChild(div_errore);
      event.preventDefault(); // Evita il comportamento predefinito del submit del modulo
    }
  }
  
   document.querySelector("#bottone_registrati").addEventListener("submit",validazione_signup);

   document.querySelector("#bottone_registrati").addEventListener("click",validazione_signup);*/