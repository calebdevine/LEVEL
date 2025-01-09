<?php
require_once('./../dbUtility/dbConfig.php');
require_once('./../dbUtility/queryManager.php');
require_once('./../dbUtility/databaseManager.php');
require_once './../loginManager/sessionUtil.php';

if (session_status() === PHP_SESSION_NONE) session_start();

// Initialize the response array
$response = ['success' => false, 'message' => ''];

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the course ID and email from the POST data
    $courseId = $_POST['corso'] ?? null;
    $email = $_POST['email'] ?? null;
    $userId = findUserByEmail($email);

    if(reservedCorseForUserId($userId, $courseId)){
        if(isset($_SESSION["email"])){
            $result = deleteReservation($userId, $courseId);
            if ($result) {
                $response['success'] = true;
                $response['type'] = 'delete';
                $response['message'] = 'Cancellazione avvenuta con successo!';
            } else {
                $response['message'] = 'Errore durante la cancellazione. Riprova più tardi.';
            }
        }else{
            $response['message'] = 'Corso già prenotato da questo utente!';
        }
        
    }else{
        // Validate the input
        if ($courseId && $email) {
            // Check if the course exists and has available seats
            $course = getCourseById($courseId)[0];
            if ($course) { 
                $reservations = getNumReservationForCourse($courseId);
                $availableSeats = $course['max_places'] - $reservations;
                if ($availableSeats > 0) {
                    // Attempt to make the reservation
                    $result = insertNewReservation($userId, $courseId);
                    if ($result) {
                        $response['success'] = true;
                        $response['type'] = 'insert';
                        $response['message'] = 'Prenotazione effettuata con successo!';
                    } else {
                        $response['message'] = 'Errore durante la prenotazione. Riprova più tardi.';
                    }
                } else {
                    $response['message'] = 'Il corso è pieno. Non ci sono posti disponibili.';
                }
            } else {
                $response['message'] = "Corso ( ". $course['course_name']." ) non trovato.";
            }
        } else {
            
            if(!$courseId){
                $response['message'] = 'Il corso non è stato selezionato.';
            }
            if(!$email){
                $response['message'] = 'L\'indirizzo email non è stato inserito.';
            }
        }
    }
} else {
    $response['message'] = 'Richiesta non valida.';
}

// Set the content type to JSON and return the response
header('Content-Type: application/json');
echo json_encode($response);
?>