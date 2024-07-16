const fixHeader = document.querySelector('#fix_header');
const dinamicHeader = document.querySelector('#dinamic_header');
const divImage = document.querySelector('#image');
const divDetails = document.querySelector('#details');
const auction_id = document.querySelector('#show_auction').dataset.index;

function checkScrolling(event)
{
    let scroll = document.documentElement.scrollTop;
    if(scroll > 0) 
    {   
        dinamicHeader.classList.remove('hidden');
        fixHeader.classList.add('hidden');
        
    }
    else
    {   
        dinamicHeader.classList.add('hidden');
        fixHeader.classList.remove('hidden');
    }
}

document.addEventListener('scroll',checkScrolling);

fetch_all();
setInterval(fetch_all, 5000);
setInterval(expires, 5000); 

function fetch_all(){
    fetch(`/fetch_auction/${auction_id}`).then(fetchResponse).then(fetchAuctionJson);
}

function expires(){
    fetch("/fetch_check_expires").then(fetchResponse).then(fetchExpiresJson);
}

function fetchExpiresJson(json){
    if(json.ok){
        fetch_all();
    }
}

function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}


let old_price = 0;

function fetchAuctionJson(json){
    if(!json.res){
        window.location.href="/running_auction";
        return;
    }

    divImage.innerHTML = '';
    divDetails.innerHTML = '';
    const path = json.foto;
    const src = path.substring(path.indexOf("uploads")); 
    const img = document.createElement("img");
    img.src= "http://127.0.0.1:8000/" +src;
    divImage.appendChild(img);
    
    const titolo = document.createElement("h1");
    titolo.textContent = json.titolo;
    divDetails.appendChild(titolo);

    const durata = document.createElement("span");
    durata.textContent = "Deadline: " + json.durata;
    durata.classList.add("deadline");
    divDetails.appendChild(durata);

    const num_offerte = document.createElement("span");
    num_offerte.textContent = "Offers from other users: " + json.num_offerte;
    divDetails.appendChild(num_offerte);

    const prezzo_iniziale = document.createElement("span");
    prezzo_iniziale.textContent = "Starting price: " + json.prezzo_iniziale + "$";
    divDetails.appendChild(prezzo_iniziale);

    const ultimo_prezzo = document.createElement("span");
    ultimo_prezzo.textContent = "Latest price: " + json.ultimo_prezzo + "$";
    divDetails.appendChild(ultimo_prezzo);

    
    if(old_price < json.ultimo_prezzo){
        ultimo_prezzo.classList.add("lampeggiante");
        old_price = json.ultimo_prezzo;
    }

    const form = document.createElement("form");
    const token = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;
    form.name = "offers_form";
    form.method = "post"
    form.action = `/info_auction/${auction_id}`;
    const input = document.createElement("input");
    input.type = "text";
    input.name = "offers";
    input.placeholder = "Make an offer now!"
    form.appendChild(input);
    const csrfInput = document.createElement("input");
    csrfInput.type = "hidden";
    csrfInput.name = "_token";
    csrfInput.value = token;
    form.appendChild(csrfInput);
    divDetails.appendChild(form);
}