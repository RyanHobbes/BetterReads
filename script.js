
document.addEventListener("DOMContentLoaded", function () {
    const booksReadSpan = document.getElementById("books-read");
    const hoursReadSpan = document.getElementById("hours-read");
    const updateButton = document.getElementById("update-reading");

    // Load saved progress from local storage
    let booksRead = localStorage.getItem("booksRead") || 0;
    let hoursRead = localStorage.getItem("hoursRead") || 0;

    booksReadSpan.textContent = booksRead;
    hoursReadSpan.textContent = hoursRead;

    // Update progress when button is clicked
    updateButton.addEventListener("click", function () {
        let newBooks = prompt("How many books have you read this year?");
        let newHours = prompt("How many hours have you spent reading?");

        if (newBooks !== null && !isNaN(newBooks)) {
            booksRead = parseInt(newBooks);
            localStorage.setItem("booksRead", booksRead);
            booksReadSpan.textContent = booksRead;
        }

        if (newHours !== null && !isNaN(newHours)) {
            hoursRead = parseInt(newHours);
            localStorage.setItem("hoursRead", hoursRead);
            hoursReadSpan.textContent = hoursRead;
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("rating");

    stars.forEach(star => {
        star.addEventListener("click", function () {
            const value = this.getAttribute("data-value");

            // Update hidden input value
            ratingInput.value = value;

            // Highlight selected stars
            stars.forEach(s => s.classList.remove("active"));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add("active");
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("carousel-content");

    // Fetch books from database
    fetch("fetch_books.php")
        .then(response => response.json())
        .then(books => {
            books.forEach(book => {
                const bookDiv = document.createElement("div");
                bookDiv.classList.add("book");

                bookDiv.innerHTML = `
                    <a href="${book.link}" target="_blank">
                        <img src="${book.cover_image}" alt="${book.title}">
                    </a>
                    <p>${book.title}</p>
                `;

                carousel.appendChild(bookDiv);
            });
        })
        .catch(error => console.error("Error fetching books:", error));
});
document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("carousel-content");
    const readList = document.getElementById("read-list");
    const toReadList = document.getElementById("want-to-read-list");

    // Fetch books from database
    fetch("fetch_books.php")
        .then(response => response.json())
        .then(books => {
            books.forEach(book => {
                // Create book element for carousel
                const bookDiv = document.createElement("div");
                bookDiv.classList.add("book");
                bookDiv.innerHTML = `
                    <a href="${book.link}" target="_blank">
                        <img src="${book.image}" alt="${book.title}">
                    </a>
                    <p>${book.title}</p>
                `;
                carousel.appendChild(bookDiv);

                // Add book to Read List
                const readItem = document.createElement("li");
                readItem.innerHTML = `<img src="${book.image}" alt="${book.title}"> ${book.title}`;
                readList.appendChild(readItem);

                // Add book to To-Be-Read List
                const toReadItem = document.createElement("li");
                toReadItem.innerHTML = `<img src="${book.image}" alt="${book.title}"> ${book.title}`;
                toReadList.appendChild(toReadItem);
            });
        })
        .catch(error => console.error("Error fetching books:", error));
});
function incrementStat(id) {
    const el = document.getElementById(id);
    let currentValue = parseInt(el.textContent);
    if (isNaN(currentValue)) currentValue = 0;
    el.textContent = currentValue + 1;
}

// Placeholder for server update (AJAX-style)
function addHours() {
    // You would normally use fetch() or XMLHttpRequest to send a request to the server
    // This is where you'd call a PHP handler (e.g., update_hours.php)
    incrementStat('hours-spent');
    alert('Hours updated locally — sync with server here!');
}

