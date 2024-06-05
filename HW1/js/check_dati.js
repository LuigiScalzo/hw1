//la funzione debounce function ritarda l'esecuzione della verifica dopo che l'utente smette di digitare
//le funzioni asincrone vengono chiamate solo se il debounce ha completato il timeout
function debounce(func, delay) {
    let timeoutId;
    return function (...args) {
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        timeoutId = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}

//async = parola chiave per dichiarare una funzione asincrona ed è molto più leggibile e gestibile rispetto a .then(). Essa ritorna implicitamente una promise
//(implicitamente perchè non ritorna effettivmanete un valore promise perchè è javascript che la trasforma in una promise) e fin quando la 'promise' non è stata risolta la funzione async si sospende 
async function checkUsername(username) {
    const response = await fetch('check_username.php', { //await = parola chiave usata all'interno di una funzione async e si usa
        //per attendere il completamento di una 'promise'. 
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'username=' + encodeURIComponent(username)
    });

    const result = await response.text(); // await response.text() attende che la promise restituita dal metodo text() dell'oggetto response sia risolta

    return result === 'taken';
}

async function checkEmail(email) {
    const response = await fetch('check_email.php', { //await fetch(...) attende che la promise restituita da fetch sia risolta.
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'email=' + encodeURIComponent(email)
    });

    const result = await response.text(); // await response.text() attende che la promise restituita dal metodo text() dell'oggetto response sia risolta

    return result === 'taken';
}

async function checkPassword(password) {
    const response = await fetch('check_password.php', { //await fetch(...) attende che la promise restituita da fetch sia risolta.
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'password=' + encodeURIComponent(password)
    });

    const result = await response.text(); // await response.text() attende che la promise restituita dal metodo text() dell'oggetto response sia risolta

    return result === 'taken';
}

document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username_signup');
    const emailInput = document.getElementById('email_signup');
    const errorView = document.getElementById('error_signup_check');

    const debouncedCheckUsername = debounce(async function () {
        const username = usernameInput.value;
        if (username.length >= 5) {
            const usernameTaken = await checkUsername(username);
            if (usernameTaken) {
                errorView.textContent = "L'username è già in uso.";
            } else {
                errorView.textContent = "";
            }
        } else {
            errorView.textContent = "";
        }
    }, 500);

    const debouncedCheckEmail = debounce(async function () {
        const email = emailInput.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(email)) {
            const emailTaken = await checkEmail(email);
            if (emailTaken) {
                errorView.textContent = "L'email è già in uso.";
            } else {
                errorView.textContent = "";
            }
        } else {
            errorView.textContent = "";
        }
    }, 500);

    //gli event listener agli input eseguono la verifica dopo che l'utente smette di digitare
    usernameInput.addEventListener('input', debouncedCheckUsername);
    emailInput.addEventListener('input', debouncedCheckEmail);

    const signupForm = document.getElementById('signup');
    signupForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        const username = usernameInput.value;
        const email = emailInput.value;
        const password = document.getElementById('password_signup').value;

        // Validazione username (almeno 5 caratteri)
        if (username.length < 5) {
            alert("L'username deve contenere almeno 5 caratteri.");
            return;
        }

        // Validazione password
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordRegex.test(password)) {
            alert("La password deve contenere almeno 8 caratteri, una lettera maiuscola, un numero e un simbolo.");
            return;
        }

        // Verifica se username è già in uso
        const usernameTaken = await checkUsername(username);
        if (usernameTaken) {
            alert("L'username è già in uso.");
            return;
        }

        // Validazione email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Inserisci un'email valida.");
            return;
        }

        // Verifica se email è già in uso
        const emailTaken = await checkEmail(email);
        if (emailTaken) {
            alert("L'email è già in uso.");
            return;
        }

        // Se tutte le validazioni passano, invia il form
        signupForm.submit();
    });
});


function VerificaPW(pw, cpw) {
    const vista = document.querySelector("#error_verify_password_view");
    vista.innerHTML = '';


    if (pw !== cpw) {
        const div_errore = document.createElement("div");
        div_errore.classList.add("errore");
        const avviso = document.createElement("p");
        avviso.textContent = "Errore: le password non corrispondono!";
        document.querySelector("#error_verify_password_view").style.display = "flex";

        div_errore.appendChild(avviso); // Aggiungi l'avviso al DOM
        vista.appendChild(div_errore);
    }

}

function PWVerificata() {
    const vista_result = document.querySelector("#success_verify_password_view");
    //vista_result.innerHTML = '';

    const div_result = document.createElement("div");
    div_result.classList.add("success");
    const avviso_for_result = document.createElement("p");
    avviso_for_result.textContent = "Password aggiornata! A breve verrai indirizzato alla pagina di Login.";
    //document.querySelector("#success_verify_password_view").style.display = "flex";

    div_result.appendChild(avviso_for_result); // Aggiungi l'avviso al DOM
    vista_result.appendChild(div_result);

}



async function ChangePassword(event) {
    event.preventDefault();


    const change_password = document.getElementById("new_password_up").value;
    const change_password_confirm = document.getElementById("confirm_new_password_up").value;

    // Validazione password in change password
    const passwordRegex2 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    if (!passwordRegex2.test(change_password)) {
        alert("La password deve contenere almeno 8 caratteri, una lettera maiuscola, un numero e un simbolo.");
        return;
    }
    if (VerificaPW(change_password, change_password_confirm)) {
        return;
    }
    else {

        const list = new FormData();
        list.append('password', change_password);
        list.append('confirmpassword', change_password_confirm);
        const response = await fetch('update_password.php', { //await = parola chiave usata all'interno di una funzione async e si usa
            //per attendere il completamento di una 'promise'. 
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: JSON.stringify(Object.fromEntries(list))
        });

        //console.log(JSON.stringify(Object.fromEntries(list)));
        const result = await response.text(); // await response.text() attende che la promise restituita dal metodo text() dell'oggetto response sia risolta

        if (result === "Valido.") {
            PWVerificata();
            document.querySelector("#update_password").style.display = "none";
            window.setTimeout("location.href = ('login.php')", 3000)

        }
        else {
            alert("Error");
            return;
        }
    }
}







/*const verifica_password = document.querySelector("#confirm_verify_password");
verifica_password.addEventListener("click",VerificaPW);
verifica_password.addEventListener("submit",VerificaPW);*/