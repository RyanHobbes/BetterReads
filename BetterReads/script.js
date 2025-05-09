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
