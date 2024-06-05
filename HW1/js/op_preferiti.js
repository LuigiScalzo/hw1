document.addEventListener('DOMContentLoaded', function() {
    const favoriteSections = document.querySelectorAll('.favorite-section');
    const overlay = document.getElementById('overlay');
    const closeBtn = document.getElementById('close-btn');
    const favoriteList = document.getElementById('favorite-list');

    favoriteSections.forEach(section => {
        section.addEventListener('click', async () => {
            const listType = section.getAttribute('data-list');
            

            if(listType ==="brani"){
                try {
                

                    const response = await fetch(`recupera_preferiti.php?tipo=${listType}`);
    
                    const items = await response.json();
    
    
                    favoriteList.innerHTML = '';
    
                    if (items.error) {
    
                        console.error(items.error);
                    } else {
    
                        items.forEach(item => {
                            const listItem = document.createElement('li');
                            listItem.innerHTML = `
                            <img src="${item.image_url}" alt="${item.title}" style="width: 100px; height: 100px;">
                                <div>
                                    <span>${item.title}</span>
                                    <p>${item.artist || ''}</p>
                                </div>`;
                            favoriteList.appendChild(listItem);
                        });
    
                        overlay.style.display = "flex";
                    }
                } catch (error) {
                    console.error('Errore nel recupero dei preferiti:', error);
                }
            }else if(listType ==="artisti"){

                





            }else if(listType==="album"){







            }else if(listType==="playlist"){






            } 

           
        });
    });

    closeBtn.addEventListener('click', () => {
        overlay.style.display = "none";
    });
});

