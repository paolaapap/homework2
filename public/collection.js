const fixHeader = document.querySelector('#fix_header');
const dinamicHeader = document.querySelector('#dinamic_header');
const dataListFilter = document.querySelector('#filters');
const filter_section = document.querySelector('#filter');
const filterInput = document.querySelector('#filter_input');
const artworksSection = document.querySelector('#artworks_section');

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

function fetch_all(){
    fetch("fetch_category_collection").then(fetchResponse).then(fetchCategoryJson);
    fetch("fetch_collection").then(fetchResponse).then(fetchArtworksJson); 
}

function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}

function fetchCategoryJson(json){
    if(json.length == 0){
        return;
    }
    dataListFilter.innerHTML = '';
    for (let result in json){
        const op = document.createElement("option");
        op.value=json[result].category;
        dataListFilter.appendChild(op);
    }
}

filterInput.addEventListener("change", fetchSearchByCategory);

function fetchSearchByCategory(event){
    const ct = encodeURIComponent(event.target.value);
    fetch(`fetch_collection/${ct}`).then(fetchResponse).then(fetchArtworksJson);
    if(!filter_section.querySelector('h1')){
        const h1 = document.createElement("h1");
        h1.textContent="Remove filter";
        filter_section.appendChild(h1);
        h1.addEventListener("click", fetch_all);
    }
}

function fetchArtworksJson(json){
    if(json.length == 0){
        noResults(artworksSection);
        return;
    }

    filterInput.value='';
    artworksSection.innerHTML = '';

    for (let result in json){

        const div = document.createElement("div");
        div.classList.add('artworks');
        div.dataset.index = json[result].id;
        artworksSection.appendChild(div);

        const img = document.createElement("img");
        img.src=json[result].content.image;
        div.appendChild(img);
        img.addEventListener("click", show_collection_details);

        const author = document.createElement("span");
        author.textContent= json[result].content.author;
        div.append(author);

        const id_collection = encodeURIComponent(div.dataset.index);
        fetch(`fetch_show_like/${id_collection}`).then(fetchResponse).then(fetchAddHeartJson);
        
        function fetchAddHeartJson(json){
            const cuore = document.createElement("img");
            cuore.src = json[0].img;
            cuore.classList.add("cuore");
            div.appendChild(cuore);
            cuore.addEventListener("click", fetch_add_remove_like);
        }

        function fetch_add_remove_like(){
            const id_collection = encodeURIComponent(div.dataset.index);
            fetch(`fetch_add_remove_like/${id_collection}`).then(fetchResponse).then(fetchLikeJson);
        }

        function fetchLikeJson(json){
            if(json.res == true){
                if(div.querySelector('.cuore')){
                    const old_img = div.querySelector('.cuore');
                    old_img.src = json.img;
                    old_img.addEventListener("click", fetch_add_remove_like);
                } else {
                    const cuore = document.createElement("img");
                    cuore.src = json.img;
                    cuore.classList.add("cuore");
                    div.appendChild(cuore);
                    cuore.addEventListener("click", fetch_add_remove_like);  
                    cuore.addEventListener("click", stopProp);  
                }
            } else {
                window.location.href = 'login';
            }
        }

    }
}

function noResults(father){
    father.innerHTML='';
    const span_error = document.createElement('span');
    span_error.textContent = 'No results found.'
    father.appendChild(span_error);
}


function show_collection_details(event){
    const id = encodeURIComponent(event.currentTarget.parentNode.dataset.index);
    window.location.href = `info_collection/${id}`;
}