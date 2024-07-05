// Author: Lara Pantlitschko
// MultiMediaTechnology / FH Salzburg
// Purpose: MultiMediaProjekt 1

const genres = ['Thriller', 'Romance', 'Crime', 'Fantasy'];
const maxResultsPerGenre = 3;

async function fetchBooksByGenre(genre, maxResults, apiKey) {
    const url = `https://www.googleapis.com/books/v1/volumes?q=subject:${genre}&orderBy=newest&maxResults=${maxResults}&key=${apiKey}`;

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Network response war nicht in Ordnung: ' + response.statusText);
        }
        const data = await response.json();

        if (!data.items) {
            throw new Error(`Keine Daten für Genre ${genre} gefunden.`);
        }
        return data.items;
    } catch (error) {
        console.error('Fehler:', error);
        document.getElementById('newbooks').innerHTML = 'Fehler beim Fetchen der Google Books API Daten: ' + error.message;
        return [];
    }
}

function filterFutureBooks(books) {
    const currentDate = new Date();
    return books.filter(book => {
        const publishedDate = new Date(book.volumeInfo.publishedDate);
        return publishedDate <= currentDate;
    });
}

function displayNewbooks(booksByGenre) {
    const resultsDiv = document.getElementById('newbooks');
    resultsDiv.innerHTML = '<p id="indextitel">Neue Bücher:</p>';

    Object.keys(booksByGenre).forEach(genre => {
        const genreDiv = document.createElement('div');
        genreDiv.innerHTML = `<h2>${genre}</h2>`;
        booksByGenre[genre].forEach((item, index) => {
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
                    <h3>${title}</h3>
                    <h4>${authors}</h4>
                </div>
            `;
            genreDiv.appendChild(bookDiv);
        });
        resultsDiv.appendChild(genreDiv);
    });
}

async function getNewestBooksByGenres(apiKey, genres, maxResultsPerGenre) {
    window.bookItemsByGenre = {};
    for (const genre of genres) {
        const books = await fetchBooksByGenre(genre, maxResultsPerGenre, apiKey);
        const filteredBooks = filterFutureBooks(books);
        window.bookItemsByGenre[genre] = filteredBooks;
    }
    displayNewbooks(window.bookItemsByGenre);
}

getNewestBooksByGenres(apiKey, genres, maxResultsPerGenre);
