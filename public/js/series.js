const seriesList = document.getElementById("seriesList");
const seriesInput = document.getElementById("seriesInput");
const episodesInput = document.getElementById("episodesInput");

function addSeries() {
    const seriesText = seriesInput.value.trim();
    const episodesCount = parseInt(episodesInput.value.trim(), 10);
    if (seriesText !== "" && !isNaN(episodesCount) && episodesCount > 0) {
        const seriesItem = document.createElement("li");
        seriesItem.className = "series-item";
        seriesItem.innerHTML = `
            <span>${seriesText}</span>
            <button class="btn btn-sm btn-secondary editButton" onClick="editSeries(this)">Editar</button>
            <button class="btn btn-sm btn-danger deleteButton" onClick="deleteSeries(this)">Remover</button>
            <ul class="episodeList list-unstyled"></ul>
        `;
        seriesList.appendChild(seriesItem);
        seriesInput.value = "";
        episodesInput.value = "";
        addEpisodes(seriesItem.querySelector(".episodeList"), episodesCount);
    }
}

function editSeries(button) {
    const li = button.parentElement;
    const span = li.querySelector("span");
    const newText = prompt("Editar série:", span.textContent);
    if (newText !== null && newText.trim() !== "") {
        span.textContent = newText.trim();
    }
}

function deleteSeries(button) {
    const li = button.parentElement;
    seriesList.removeChild(li);
}

function addEpisodes(episodeList, count) {
    for (let i = 1; i <= count; i++) {
        const episodeItem = document.createElement("li");
        episodeItem.className = "episode-item";
        episodeItem.innerHTML = `
            <span>Temporada ${i}</span>
            <button class="btn btn-sm btn-success toggleWatchedButton" onClick="toggleWatched(this)">Marcar como Visto</button>
        `;
        episodeList.appendChild(episodeItem);
    }
}

function toggleWatched(button) {
    const li = button.parentElement;
    const span = li.querySelector("span");
    if (span.classList.contains("watched")) {
        span.classList.remove("watched");
        button.textContent = "Marcar como Visto";
    } else {
        span.classList.add("watched");
        button.textContent = "Marcar como Não Visto";
    }
}

//mobile hamburger suave// 

const toggle = document.querySelectorAll('.navbar-toggle');

toggle.addEventListener ('click', ()=>{
    const menu = document.getElementById('nav-item');
    if (menu.classList.contains('hide')){
            menu.classList.add('show');
            menu.classList.remove('hide');
    } else {
        menu.classList.add('hide');
        menu.classList.remove('show');
        }
})