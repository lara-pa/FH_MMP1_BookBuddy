// Author: Lara Pantlitschko
// MultiMediaTechnology / FH Salzburg
// Purpose: MultiMediaProjekt 1

async function searchBooks() {
    const query = document.getElementById('searchquery').value;
    const url = `../api/api.php?query=${encodeURIComponent(query)}`;

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
    } catch (error) {
        console.error('Fehler:', error);
        document.getElementById('results').innerHTML = 'Fehler beim Abrufen der Bücher: ' + error.message;
    }
}

function displayResults(data) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    if (data.length > 0) {
        data.forEach((item, index) => {
            const title = item.title || 'Kein Titel';
            const authors = item.author || 'Kein Autor';
            const thumbnail = item.thumbnail || '';

            const bookDiv = document.createElement('div');
            bookDiv.classList.add('book');
            bookDiv.innerHTML = `
                ${thumbnail ? `<img src="${thumbnail}" alt="${title} cover">` : ''}
                <div id="singleresult">
                    <h2>${title}</h2>
                    <h3>${authors}</h3>
                    <button onclick="showDetails(${index})" id="detailsbutton">Mehr Informationen</button>
                </div>
            `;
            resultsDiv.appendChild(bookDiv);
        });
    } else {
        resultsDiv.innerHTML = 'Keine Ergebnisse gefunden.';
    }
}

function showDetails(index) {
    const book = window.bookItems[index];
    window.location.href = `details.php?book_id=${book.book_id}`;
}


function addToReadlist(title, authors, thumbnail) {

    const list = document.getElementById('list-select').value;

    var link = "../readlist/list_save.php?list=" + list + "&bookTitle=" + title + "&bookAuthor=" + authors + "&bookThumbnail=" + thumbnail;
    window.location.href = link;
}

function addComment(title, authors) {

    const comment = document.getElementById('comment').value;

    var link = "comment_add.php?comment=" + comment + "&bookTitle=" + title + "&bookAuthor=" + authors;
    window.location.href = link;
}
