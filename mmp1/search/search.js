// Author: Lara Pantlitschko
// MultiMediaTechnology / FH Salzburg
// Purpose: MultiMediaProjekt 1

async function searchBooks() {
    const query = document.getElementById('searchquery').value;
    const url = `https://www.googleapis.com/books/v1/volumes?q=${query}&key=${apiKey}&maxResults=20&orderBy=relevance`;

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Network response war nicht in Ordnung: ' + response.statusText);
        }
        const data = await response.json();
        if (!data.items) {
            throw new Error('Keine Daten gefunden.');
        }
        window.bookItems = data.items;
        displayResults(data);
    } catch (error) {
        console.error('Fehler:', error);
        document.getElementById('results').innerHTML = 'Fehler beim Fetchen der Google Books API Daten: ' + error.message;
    }
}

function displayResults(data) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    if (data.items) {
        data.items.forEach((item, index) => {
            const volumeInfo = item.volumeInfo;
            const title = volumeInfo.title || 'Kein Titel';
            const authors = volumeInfo.authors ? volumeInfo.authors.join(', ') : 'Kein Autor';
            const imageLinks = volumeInfo.imageLinks;
            const thumbnail = imageLinks ? imageLinks.thumbnail : '';

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
    const book = window.bookItems[index].volumeInfo;
    const params = new URLSearchParams({
        thumbnail: book.imageLinks ? book.imageLinks.thumbnail : '',
        title: book.title || 'Kein Titel',
        authors: book.authors ? book.authors.join(', ') : 'Kein Autor',
        description: book.description || 'Keine Beschreibung verfügbar',
        publisher: book.publisher || 'Unbekannt',
        publishedDate: book.publishedDate || 'Unbekannt',
        pageCount: book.pageCount || 'Unbekannt'
    });

    window.location.href = `details.php?${params.toString()}`;
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
