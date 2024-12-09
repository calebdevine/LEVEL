<?php require_once('../layout/header.php'); ?> 
    <?php
        require_once ("./../dbUtility/dbConfig.php");
        require_once ("./../dbUtility/queryManager.php");
        require_once ("./../dbUtility/databaseManager.php"); 
        require_once "./../loginManager/sessionUtil.php";
        if(session_status() === PHP_SESSION_NONE) session_start();
        $day = ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"];
    ?>
    <section class = "calendar">
        <div class="calendar-container">
            <div class="calendar-header">
                <h2 class="calendar-title">Calendario Prenotazioni</h2>
            </div>
            <div class="calendar-body">
                <?php
                    foreach ($day as $d){
                        $courses = getCoursesByDay($d);
                        if ($courses) {
                        echo("<div class=\"calendar-day\">");
                            echo("<h3>".$d."</h3>");
                                
                                    foreach ($courses as $c) {
                                        echo(" <div class=\"course\">");
                                            $id = $c['courseId'];
                                            $start = date("G:i",strtotime($c['start']));
                                            $end = date("G:i",strtotime($c['end']));
                                            $res = getNumReservationForCourse($id);
                                            $empty_places = $c['max_places'] - $res;
                                            
                                            echo "<h4>".$c['course_name']."</h4>";
                                            echo "<p> ORARIO : ". $start ." - ".$end."</p>";
                                            echo "<p> Istruttore : ".$c['trainer']."</p>" ;
                                            echo "<p> Posti disponibili : <span class=\"available-seats\"> ".$empty_places ."</span></p>";
                                            echo "<form action='../../php/pages/reservationPage.php' method='post'>
                                                    <input id=\"hidden\" type =\"hidden\" name =\"corso\" value = ".$id.">
                                                    Email : <input type=\email\" name=\"email\">
                                                    <input type=\"submit\" id=\"reserv\" value=\"Prenota\">";
                                            echo "</form>";
                                        echo("</div>");
                                    }
                                
                        echo("</div>");
                        }
                    }
                ?>
            </div>
        </div> 
    </section>
    
    
<?php require_once('../layout/footer.php'); ?>
