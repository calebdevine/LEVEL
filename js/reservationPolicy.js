document.addEventListener('DOMContentLoaded', function() {
    // Attach event listeners to all reservation forms
    document.querySelectorAll('.reservationForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(form);
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
              }
            // Send the form data via AJAX
            fetch('../../php/pages/reservationPage.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message); // Show success message
                    // Update the available seats count dynamically
                    const availableSeats = form.parentElement.querySelector('.available-seats');
                    
                    if (availableSeats) {
                        const btn = form.parentElement.querySelector('#btn-form');
                        if(btn){
                            console.log(btn);
                            $seats= parseInt(availableSeats.textContent)
                            if(data.type == 'insert'){
                                $seats -= 1;
                                if($seats == 0){
                                    //aggiungo p corsi pieni class="alert"
                                    const p = document.createElement('p');
                                    span.textContent = 'Corsi pieni';
                                    span.classList.add('alert');
                                    form.parentElement.appendChild(span);
                                }
                                //modifico bottone con textContet = cancella prenotazione
                                btn.value = 'Cancella prenotazione';
                                //modifico bottone con class delete
                                btn.classList.remove('reserv');
                                btn.classList.add('delete');
                                availableSeats.textContent = $seats;
                                
                            }else{
                                if($seats == 0){
                                    // tolgo p corsi pieni
                                    const p = form.parentElement.querySelector('.alert');
                                    if(p){
                                        p.remove();
                                    }
                                }
                                //modifico bottone con textContet = prenota
                                btn.value = 'Prenota';
                                //modifico input con class reserv
                                btn.classList.remove('delete');
                                btn.classList.add('reserv');
                                availableSeats.textContent = $seats+1;
                                
                            } 
                        }else{
                            alert('Errore: impossibile trovare btn');
                        }
                        
                    }
                } else {
                    alert(data.message); // Show error message
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Si è verificato un errore durante la prenotazione ");
            });
        });
    });
});