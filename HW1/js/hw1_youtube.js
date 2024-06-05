function onResponse(response) {
    console.log('Risposta ricevuta');
    console.log(response.status);
    return response.json();
}

function onJsonVideos(json) {
    console.log("json RICEVUTO");
    console.log(json);

    const library = document.querySelector('#second_view_search');
    library.innerHTML = '';

    const results = json.items;
    let num_results = Object.keys(results).length;

   // console.log(results);
   // console.log(num_results);

    for(let i = 0;i<num_results;i++){
        //leggo tutto il documento
        const videos_list = results[i];
        //leggo titolo e miniatura
        const video_title = videos_list.snippet.title;
        const video_img = videos_list.snippet.thumbnails.high.url;
        const video_url = "https://www.youtube.com/watch?v=" + videos_list.id.videoId;
        //creo il div che contiene titolo e miniatura
        const lista = document.createElement("div");
        lista.classList.add("album");
        //creo l'immagine
        const img = document.createElement("img");
        img.src = video_img;
        

        
       
        img.addEventListener("click",ytLink,false);
        img.myParam = video_url;

        //creo la didascalia
        const caption = document.createElement("span");
        caption.textContent = video_title;

        
        

        lista.appendChild(img);
        lista.appendChild(caption);
        library.appendChild(lista);

    }


 
}




function search_videos(event) {
    
    event.preventDefault();

    const input = document.querySelector('#second_cerca');
    const input_value = input.value;
    
    if (input_value) {
        const url = "do_search_youtube.php?titolo="+ input_value;
        const contenuto = encodeURIComponent(input_value);
        //ho verificato che effettivamente è stato inserito un valore nel campo di testo
        console.log(" ricerco elementi con contenuto: " + contenuto);

        console.log('Eseguo ricerca: ' + input_value);

        fetch(url
        ).then(onResponse).then(onJsonVideos);

    }


}

function ytLink(event){
   window.open(event.currentTarget.myParam, '_blank');
}

const second_form = document.querySelector("#second_search");
second_form.addEventListener('submit', search_videos);

