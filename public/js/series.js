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


//LISTA//

document.addEventListener("DOMContentLoaded", function() {
    const rowsPerPage = 5; // Quantas linhas por página
    const seriesTableBody = document.getElementById('seriesTableBody');
    const pagination = document.getElementById('pagination');

    const data = [
        { nome: 'Game of Thrones', temporadas: 8, vistas: 5 },
        { nome: 'Breaking Bad', temporadas: 5, vistas: 5 },
        // Adicione mais séries aqui...
    ];

    function renderTable(page) {
        // Limpa as linhas da tabela
        seriesTableBody.innerHTML = '';
        
        // Cálculo dos índices de início e fim para a página atual
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedItems = data.slice(start, end);

        // Renderiza as linhas da tabela
        paginatedItems.forEach(item => {
            const row = `<tr>
                <td>${item.nome}</td>
                <td>${item.temporadas}</td>
                <td>${item.vistas}</td>
                <td>
                    <button class="edit-btn">Editar</button>
                    <button class="delete-btn">Deletar</button>
                </td>
            </tr>`;
            seriesTableBody.innerHTML += row;
        });
    }

    function renderPagination(totalItems) {
        const totalPages = Math.ceil(totalItems / rowsPerPage);

        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.innerText = i;
            button.addEventListener('click', function() {
                renderTable(i);
                updatePagination(i);
            });

            pagination.appendChild(button);
        }
    }

    function updatePagination(currentPage) {
        const buttons = pagination.querySelectorAll('button');
        buttons.forEach(button => {
            button.classList.remove('active');
            if (parseInt(button.innerText) === currentPage) {
                button.classList.add('active');
            }
        });
    }

    // Inicializa a tabela e a paginação
    renderTable(1);
    renderPagination(data.length);
});

//FIM DA LISTA//