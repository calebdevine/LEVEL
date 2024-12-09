function bookCourse(courseElement) {

    const courseElement = courseElement.parentNode
    const availableSeatsElement = courseElement.querySelector('.available-seats');
    console.log(availableSeatsElement.textContent);
    const availableSeats = parseInt(availableSeatsElement.textContent);
    
    if (availableSeats > 0) {
        availableSeatsElement.textContent = availableSeats - 1;
        courseElement.querySelector('button').disabled = availableSeats - 1 === 0;
        // Aggiungi logica per confermare la prenotazione
        alert('Prenotazione confermata!');
    } else {
        alert('Non ci sono posti disponibili per questo corso.');
    }
}



