    <main>
        <h1>Prenotazione Corsi Fitness Settimanali</h1>
        
        <div class="calendar">
            <div class="day">
                <h2>Lunedì</h2>
                <div class="course" id="tabata">
                    <h3>TABATA <h3>- 60 min (Posti disponibili: <span class="available-seats">15</span>) 
                    <button onclick="bookCourse(this)">Prenota</button>
                </div>
                <div class="course" >
                    Pilates - 45 min (Posti disponibili: <span class="available-seats">2</span>) 
                    <button onclick="bookCourse(this)">Prenota</button>
                </div>
            </div>
            <div class="day">
                <h2>Martedì</h2>
                <div class="course">
                    Spinning - 30 min (Posti disponibili: <span class="available-seats">0</span>) 
                    <button onclick="bookCourse(this)" disabled>Prenota</button>
                </div>
            </div>
            <div class="day">
                <h2>Mercoledì</h2>
                <div class="course">
                    Zumba - 60 min (Posti disponibili: <span class="available-seats">3</span>) 
                    <button onclick="bookCourse(this)">Prenota</button>
                </div>
            </div>
            <div class="day">
                <h2>Giovedì</h2>
                <div class="course">
                    Body Pump - 60 min (Posti disponibili: <span class="available-seats">4</span>) 
                    <button onclick="bookCourse(this)">Prenota</button>
                </div>
            </div>
            <div class="day">
                <h2>Venerdì</h2>
                <div class="course">
                    Yoga Relax - 60 min (Posti disponibili: <span class="available-seats">1</span>) 
                    <button onclick="bookCourse(this)">Prenota</button>
                </div>
            </div>
            <div class="day">
                <h2>Sabato</h2>
                <div class="course">
                    HIIT - 30 min (Posti disponibili: <span class="available-seats">6</span>) 
                    <button onclick="bookCourse(this)">Prenota</button>
                </div>
            </div>
        </div>

        <section class="reservation-summary">
            <h2>Riepilogo Prenotazione</h2>
            <p>Corso selezionato: [Nome Corso]</p>
            <p>Data: [Data]</p>
            <p>Orario: [Orario]</p>
            <h3>Informazioni Personali</h3>
            <form>
                <input type="text" placeholder="Nome" required>
                <input type="email" placeholder="Email" required>
                <input type="tel" placeholder="Numero di Telefono" required>
                <button type="submit">Conferma Prenotazione</button>
            </form>
        </section>

        <section class="info">
            <h2>Politiche di Cancellazione</h2>
            <p>È possibile cancellare la prenotazione fino a 24 ore prima dell'inizio del corso.</p>
            <h2>Contatti</h2>
            <p>Telefono: 0123456789</p>
            <p>Email: [info@fitnesscenter.it](mailto:info@fitnesscenter.it)</p>
        </section>
    </main>
    <script src="./../../js/reservationPolicy.js"></script>




