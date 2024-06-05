

async function onJsonAlbum(json) {
  console.log('JSON ricevuto');
  console.log(json);
  const library = document.querySelector('#view_search');
  library.innerHTML = '';
  const results = json.albums.items;
  let num_results = results.length;
  if (num_results > 50) num_results = 50;
  for (let i = 0; i < num_results; i++) {
    const album_data = results[i];
    const title = album_data.name;
    const selected_image = album_data.images[0].url;
    const album = document.createElement('div');
    album.classList.add('album');
    const img = document.createElement('img');
    img.src = selected_image;
    const caption = document.createElement('span');
    caption.textContent = title;
    const button_preferito = document.createElement('button');
    button_preferito.textContent = 'Aggiungi ai preferiti';
    button_preferito.classList.add('custom_class');
    album.appendChild(img);
    album.appendChild(caption);
    album.appendChild(button_preferito);
    library.appendChild(album);
  }
}

async function onJsonArtist(json) {
  console.log('JSON ricevuto');
  console.log(json);
  const library = document.querySelector('#view_search');
  library.innerHTML = '';
  const results = json.artists.items;
  let num_results = results.length;
  if (num_results > 50) num_results = 50;
  for (let i = 0; i < num_results; i++) {
    const artist_list = results[i];
    const title = artist_list.name;
    const selected_image = artist_list.images[0].url;
    const list = document.createElement('div');
    list.classList.add('album');
    const img = document.createElement('img');
    img.src = selected_image;
    const caption = document.createElement('span');
    caption.textContent = title;
    const button_preferito = document.createElement('button');

    button_preferito.textContent = 'Aggiungi ai preferiti';
    button_preferito.classList.add('custom_class');
    list.appendChild(img);
    list.appendChild(caption);
    list.appendChild(button_preferito);


    const list1 = new FormData();
    list1.append('name_artist', title);
    list1.append('image_url', img.src);
    const response1 = await fetch('artist_check_preferiti.php', {

      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'

      },
      body: JSON.stringify(Object.fromEntries(list1))


    })

    const json1 = await response1.text();

    if(json1.includes("Trovato")){
      button_preferito.textContent = 'Preferito';
      button_preferito.classList.add('custom_class');
      list.appendChild(button_preferito);
    }else{
      button_preferito.textContent = 'Aggiungi ai preferiti';
      button_preferito.classList.add('custom_class');
      list.appendChild(button_preferito);
      button_preferito.addEventListener('click', changeToFavouriteArtist);

    }
    library.appendChild(list);
  }
}

async function onJsonTrack(json) {
  console.log('JSON ricevuto');
  console.log(json);
  const library = document.querySelector('#view_search');
  library.innerHTML = '';
  const results = json.tracks.items;
  let num_results = results.length;
  if (num_results > 50) num_results = 50;
  for (let i = 0; i < num_results; i++) {
    const track_list = results[i];
    const title = track_list.name;
    const artist = track_list.artists[0].name;
    const selected_image = track_list.album.images[0].url;
    const list = document.createElement('div');
    list.classList.add('album');
    const img = document.createElement('img');
    img.src = selected_image;
    const caption = document.createElement('span');
    caption.textContent = title;
    const caption_artist = document.createElement('p');
    caption_artist.textContent = artist;
    const button_preferito = document.createElement('button');

    list.appendChild(caption_artist);
    list.appendChild(img);
    list.appendChild(caption);
    

  
    const list1 = new FormData();
    list1.append('title', title);
    list1.append('artist', artist);
    list1.append('image_url', img.src);
    const response1 = await fetch('songs_check_preferiti.php', {

      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'

      },
      body: JSON.stringify(Object.fromEntries(list1))


    })

    const json1 = await response1.text();

    if(json1.includes("Trovato")){
      button_preferito.textContent = 'Preferito';
      button_preferito.classList.add('custom_class');
      list.appendChild(button_preferito);
    }else{
      button_preferito.textContent = 'Aggiungi ai preferiti';
      button_preferito.classList.add('custom_class');
      list.appendChild(button_preferito);
      button_preferito.addEventListener('click', changeToFavouriteSongs);

    }
    

    library.appendChild(list);

  }
}

async function onJsonPlaylist(json) {
  console.log('JSON ricevuto');
  console.log(json);
  const library = document.querySelector('#view_search');
  library.innerHTML = '';
  const results = json.playlists.items;
  let num_results = results.length;
  if (num_results > 50) num_results = 50;
  for (let i = 0; i < num_results; i++) {
    const playlist_list = results[i];
    const title = playlist_list.name;
    const selected_image = playlist_list.images[0].url;
    const list = document.createElement('div');
    list.classList.add('album');
    const img = document.createElement('img');
    img.src = selected_image;
    const caption = document.createElement('span');
    caption.textContent = title;
    const button_preferito = document.createElement('button');

    button_preferito.textContent = 'Aggiungi ai preferiti';
    button_preferito.classList.add('custom_class');

    list.appendChild(img);
    list.appendChild(caption);
    list.appendChild(button_preferito);
    library.appendChild(list);
  }
}

function onResponse(response) {
  console.log('Risposta ricevuta');
  console.log(response.status);
  return response.json();
}

//questo eventlistener garantisce che tutto il codice (che fa riferimento al dom) viene eseguito solo quando il dom è completamente pronto
document.addEventListener('DOMContentLoaded', (event) => {
  const searchForm = document.querySelector('#cerca');
  searchForm.addEventListener('submit', search);
});

async function search(event) {
  event.preventDefault();
  const input = document.querySelector('#cerca');
  const input_value = input.value;
  if (input_value) {
    const contenuto = encodeURIComponent(input_value);
    console.log("Ricerco elementi con contenuto: " + contenuto);
    const tipo = document.querySelector("#tipo");
    const tipo_value = tipo.value;
    console.log('Ricerco elementi di tipo: ' + tipo_value);
    console.log('Eseguo ricerca: ' + input_value);

    try {
      const response = await fetch(`do_search_spotify.php?titolo=${contenuto}&tipo=${tipo_value}&limit=50`);
      const json = await response.json();

      if (tipo_value === "album") {
        onJsonAlbum(json);
      } else if (tipo_value === "artist") {
        onJsonArtist(json);
      } else if (tipo_value === "track") {
        onJsonTrack(json);
      } else if (tipo_value === "playlist") {
        onJsonPlaylist(json);
      }


    } catch (error) {
      console.error('Errore nel recupero dei dati:', error);
    }
  } else {
    console.log("Inserisci il contenuto per effettuare la ricerca");
  }
}


async function changeToFavouriteSongs(event) {
  const button = event.currentTarget;
  const container = button.closest('.album');

  const artist = container.querySelector('p').textContent;
  const title = container.querySelector('span').textContent;
  const image_url = container.querySelector('img').src;

  //console.log(id_canzone);
  //console.log(container);
  try {
      const list2 = new FormData();
      list2.append('title', title);
      list2.append('artist', artist);
      list2.append('image_url', image_url);
      const response2 = await fetch('aggiungi_songs_to_preferito.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'

        },
        body: JSON.stringify(Object.fromEntries(list2))
      });

      // console.log(JSON.stringify(Object.fromEntries(list)));


      const json2 = await response2.text();

      if (json2 === "Inserito&Aggiuntoaipreferiti") {
        button.textContent = 'Preferito';
        button.disabled = true;
      } else {
        console.error(json2.error);
      }
    
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
}

async function changeToFavouriteArtist(event) {
  const button = event.currentTarget;
  const container = button.closest('.album');

  const name_artist = container.querySelector('p').textContent;
  const image_url = container.querySelector('img').src;

 
  try {
      const list = new FormData();
      list.append('artist', name_artist);
      list.append('image_url', image_url);
      const response2 = await fetch('aggiungi_artist_to_preferito.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'

        },
        body: JSON.stringify(Object.fromEntries(list))
      });

      // console.log(JSON.stringify(Object.fromEntries(list)));


      const json = await response2.text();

      if (json === "Inserito&Aggiuntoaipreferiti") {
        button.textContent = 'Preferito';
        button.disabled = true;
      } else {
        console.error(json.error);
      }
    
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
}






const form = document.querySelector("#search");
form.addEventListener('submit', search);



