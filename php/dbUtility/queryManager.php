<?php

	/*
		Questo file contiene tutte le query necessarie per il funzionamento del sito.
		Si include poi una funzione per convertire gli oggetti mysqli in oggetti php
		facilmente manipolabili.
	*/
    require_once "databaseManager.php"; 
	 
	function checkUser($email){
		global $levelDB;
		$email = $levelDB->sqlInjectionFilter($email);
		//$password = $levelDB->sqlInjectionFilter($password);
		$queryText = "SELECT * FROM user where email=\"$email\";";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		return  $result;

	}
	function fromSQLtoArray($SQLresult,$type){
		if($SQLresult==false) return [];
		if($type=='BOTH')return $SQLresult->fetch_all(MYSQLI_BOTH);
		else return $SQLresult->fetch_all(MYSQLI_ASSOC);
	}
	function getUser($codiceUtente){  
		global $levelDB;
		$codiceUtente = $levelDB->sqlInjectionFilter($codiceUtente);
		$queryText = "SELECT * FROM user WHERE idCode = $codiceUtente;";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC'); 
	}
	
	
	function getAllCourses(){
		global $levelDB;
		$queryText = 	"
						SELECT *
						FROM course;
					";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}

	function getCourseByid($id){
		global $levelDB;
		$queryText = 	"
						SELECT *
						FROM course
						WHERE courseId = '$id';
					";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}
	
	
	function getCoursesByDay($day){
		global $levelDB;
		$queryText = 	"
						SELECT *
						FROM course
						WHERE day = '$day';
					";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}

	function getNumReservationForCourse($id){
		global $levelDB;
		$queryText = 	"
						SELECT count(*) as num
						FROM reservations
						WHERE courseId  = '$id';
					";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
			return $result[0]['num'];
	   	}else{
			return -1;
	   	}
	}
	
	function findUserByEmail($email){
		global $levelDB;
		$queryText = 	"
						SELECT userId
						FROM user
						WHERE email = '$email';
					";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
			return $result[0]['userId'];
	   	}else{
			return -1;
	   	}
	}
	
	function insertNewReservation($userId, $corso){
		global $levelDB;
	 	$queryText =	"INSERT INTO `reservations` ( `userId`, `courseId`, `reservation_date`) VALUES 
	 					(\"$userId\", \"$corso\", now());
	 					";
	 	$result=$levelDB->performQuery($queryText);
		$levelDB->closeConnection();
	 	return $result;
	}
	function deleteReservation($userId, $courseId){
		global $levelDB;
		$queryText = "DELETE FROM `reservations` WHERE `userId` = '$userId'	AND `courseId` = '$courseId'";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		return $result;
	}

	function maxReservation($id){
		global $levelDB;
		$queryText = 	"
						SELECT max_places
						FROM course
						WHERE courseId  = '$id';
					";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
			return $result[0]['max_places'];
	   	}else{
			return -1;
	   	}
	}

	function reservedCorseForUserId($userId, $courseId){
		global $levelDB;
		$queryText = 	"
						SELECT * FROM reservations
						WHERE userId = '$userId' AND courseId = '$courseId';
		";
		$result = $levelDB->performQuery($queryText);
		$levelDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
			return 1;
			}else{
				return 0;
		}
	}













































	

	function getRooms(){
		global $bebDB;
		$queryText = 	"
						SELECT *
						FROM appartamento A
						WHERE A.descrizione = 'camera';
					";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}

	function getAppartment(){
		global $bebDB;
		$queryText = 	"
						SELECT *
						FROM appartamento A
						WHERE A.descrizione = 'appartamento';
					";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}

	// funzione che controlla la disponibilità di una camera o appartamento nel periodo indicato
	function checkRoomAvailability($checkin, $checkout,$room){
		global $bebDB;
		$checkin = $bebDB->sqlInjectionFilter($checkin);
		$checkout = $bebDB->sqlInjectionFilter($checkout);
		$room = $bebDB->sqlInjectionFilter($room);
		$roomId = getRoomId($room);
		$roomID = $roomId;
		$queryText = 	"
							SELECT if(count(*) > 0,1,0) as result
							FROM appartamento A
							WHERE A.idAppartamento = '$roomId' AND A.idAppartamento not in (SELECT P.idAppartamento 
							                               FROM prenotazione P
							                               WHERE P.stato <> 'annullata' AND 
						                                  ((P.dataCheckIn BETWEEN  \"$checkin \" AND  \"$checkout\") OR  
														  (P.dataCheckIn <  \"$checkin \" AND  P.dataCheckOut >  \"$checkin \" )));                          

						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}
	function getFreeRooms($checkin, $checkout,$guests){
		global $bebDB;
		$checkin = $bebDB->sqlInjectionFilter($checkin);
		$checkout = $bebDB->sqlInjectionFilter($checkout);
		$guests = $bebDB->sqlInjectionFilter($guests);
		$queryText = 	"
						SELECT *
						FROM appartamento A 
						WHERE A.postiLetto >= $guests AND A.idAppartamento not in (SELECT P.idAppartamento 
														FROM prenotazione P
														WHERE P.stato <> 'cancellata' AND 
													((P.dataCheckIn BETWEEN  \"$checkin \" AND  \"$checkout\") OR  (P.dataCheckIn <  \"$checkin \" AND  P.dataCheckOut >  \"$checkin \" )))                          
						ORDER BY `idAppartamento`;
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}
	// funzione che controlla l'esistenza di una camera o appartamento
	function existRoom($roomId){
		global $bebDB;
		$room = $bebDB->sqlInjectionFilter($roomId);
		$queryText = 	"
							SELECT count(*) as res
							FROM appartamento
							WHERE idAppartamento = '$roomId';
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		
		if(count($result) > 0){
			return $result[0]['res'];
		}else{
			return false;
		}
	}
	function getRoomName($roomId){
		global $bebDB;
		$roomId = $bebDB->sqlInjectionFilter($roomId);
		$queryText = 	"
						SELECT nome
						FROM appartamento
						WHERE idAppartamento = '$roomId';
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
			foreach ($result as $key => $value) {
				return $value['nome'];
			}
		}else{
			return $result;
		}
	}
	function getRoomId($room){
		global $bebDB;
		$roomName = $bebDB->sqlInjectionFilter($room);
		$queryText = 	"
						SELECT idAppartamento
						FROM appartamento
						WHERE nome = '$roomName';
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		// return fromSQLtoArray($result,'ASSOC');
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
		 	return $result[0]['idAppartamento'];
		 	
		}else{
		 	return 0;
		}
	}
	function getMaxGuests($roomId){
		global $bebDB;
		$roomId = $bebDB->sqlInjectionFilter($roomId);
		$queryText = 	"
						SELECT postiLetto
						FROM appartamento
						WHERE idAppartamento = '$roomId'
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
			return $result[0]['postiLetto'];
		}else{
			return $result;
		}
	}
	function getUserName($userId){
		global $bebDB;
		$userId = $bebDB->sqlInjectionFilter($userId);
		$queryText = 	"
						SELECT nome, cognome
						FROM utente
						WHERE codiceUtente = '$userId';
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result) > 0){
			foreach ($result as $key => $value) {
				return $value['cognome']." ".$value['nome'];
			}
		}else{
			return $result;
		}
	}
		

	//funzioni per le prenotazioni
	//prima di tutto devo creare un oggetto con i dati del cliente e della stanza
class Prenotazione{
		public $utente;
		public $room;
		public $checkin;
		public $checkout;
		public $guests;
		public $nights;
		public $reservationDate;
		public $rate;
		public $totalPrice;
		
		public function __construct($utente, $room, $checkin, $checkout,$guests){
			global $bebDB;
			$defaultPrice = 50;
			$this->utente=$bebDB->sqlInjectionFilter($utente);
			$this->room=$bebDB->sqlInjectionFilter($room);
			
			$this->checkin = $bebDB->sqlInjectionFilter($checkin);
			$this->checkout= $bebDB->sqlInjectionFilter($checkout);
			$this->guests = $bebDB->sqlInjectionFilter($guests);


			$timeIN = strtotime($this->checkin);
			$timeOUT = strtotime($this->checkout);
			$this->nights = ceil(abs($timeIN - $timeOUT) / 86400) ;
			$this->reservationDate = date("Y-m-d H:i"); 
			$pricePerNight = getPricePerNight($this);
			if ($pricePerNight){
				$this->totalPrice = $pricePerNight*$this->nights;
			}else{
				$this->totalPrice = $defaultPrice * $this->nights * $this->guests;
			}
		}
		
	}

	function calcRate($nights){
		if($nights < 7) return 'giornaliera';
		else if ($nights >= 7 && $nights <=30) return 'settimanale';
		else return 'mensile';
	}
	function getPrestige($roomId){
		global $bebDB;
		$queryText =	"
						SELECT prestigio
						FROM appartamento
						WHERE idAppartamento = '$roomId'
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();	
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result)>0){
			foreach ($result as $key => $value) {
			return $value['prestigio'];
		}
		}else{
			return $result;
		}
	}

	function getSeason($date){
		$winter = ['12', '01', '02'];
		$spring = ['03', '04', '05'];
		$summer = ['06', '07', '08'];
		$autumn = ['09', '10', '11'];
		
		$month = date('m', strtotime($date));
	 
		if (in_array($month, $winter)) {
			return 'inverno';
		} elseif (in_array($month, $spring)) {
			return 'primavera';
		} elseif (in_array($month, $summer)) {
		 	return 'estate';
		} elseif (in_array($month, $autumn)) {
		 	return 'autunno';
		} else {
			return null;
		}
	} 
	//calcolo il prezzo totale in base al numero di notti e alla tariffa media delle camere
	function getPricePerNight($p){
		global $bebDB;
		$prestige= getPrestige($p->room);
		$season = getSeason($p->checkin);
		$rate = calcRate($p->nights); 
		$queryText=		"
						SELECT prezzo
						FROM prezzocamera 			
						WHERE numeroOspiti ='$p->guests'AND prestigio ='$prestige' AND tariffa ='$rate' AND stagione = '$season'; 
						";
		$result = $bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		
		if(count($result)>0){
			foreach ($result as $key => $value) {
			return $value['prezzo'];
		}
		}else{
			return $result;
		}
	}



	//crea la prenotazione
	function addReservation($p){
		global $bebDB;
		$queryText =	"INSERT INTO `prenotazione` (`codicePrenotazione`, `codiceUtente`, `idAppartamento`, `dataPrenotazione`, 
						`dataCheckIn`, `dataCheckOut`, `numeroOspiti`, `notti`, `prezzo`, `stato`) VALUES 
						('', '$p->utente', '$p->room', \"$p->reservationDate\", \"$p->checkin\", \"$p->checkout\", '$p->guests', '$p->nights', '$p->totalPrice', 'pendente');
						";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return $result;
	}

	function confirmPrenotation($id){
		global $bebDB;
		$queryText=		"
						UPDATE prenotazione SET 
									stato='confermata'
						WHERE codicePrenotazione='$id';
					";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return $result;
	}
	//annulla una prenotazione
	function cancelPrenotation($id){
		global $bebDB;
		$queryText=		"
						UPDATE prenotazione SET 
									stato='annullata'
						WHERE codicePrenotazione='$id';
					";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return $result;
	}
	//elimina una prenotazione
	function deletePrenotation($id){
		global $bebDB;
		$queryText="DELETE FROM prenotazione WHERE codicePrenotazione='$id'";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return $result;
	}
	//modifica una prenotazione
	function modifyPrenotation($id,$p,$status){
		global $bebDB;
		$queryText=		"
						UPDATE prenotazione SET 
									idAppartamento='$p->room',
									dataCheckIn=\"$p->checkin\",
									dataCheckOut=\"$p->checkout\",
									dataPrenotazione =\"$p->reservationDate\",
									numeroOspiti='$p->guests',
									notti='$p->nights',
									prezzo='$p->totalPrice',
									stato='$status'
						WHERE codicePrenotazione='$id';
					";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return $result;
	}
	//recupera le prenotazioni
	function getAllPrenotations(){
		global $bebDB;
		$queryText=	"
					SELECT * 
					FROM prenotazione 
					ORDER BY dataPrenotazione DESC;
					";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}
	function getAllPrenotationsToConfirm(){
		global $bebDB;
		$queryText=	"
					SELECT * 
					FROM prenotazione 
					WHERE stato = \"pendente\"
					ORDER BY dataPrenotazione DESC;
					";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}
	//recupera le prenotazioni di un cliente
	function getPrenotationsByUserId($user){
		global $bebDB;
		$utente=$bebDB->sqlInjectionFilter($user);
		$queryText=	"
					SELECT * 
					FROM prenotazione 
					WHERE codiceUtente = '$utente'
					ORDER BY dataPrenotazione DESC";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		return fromSQLtoArray($result,'ASSOC');
	}

	function getReseervationStatus($reservationId){
		global $bebDB;
		$id = $bebDB->sqlInjectionFilter($reservationId);
		$queryText=	"
					SELECT stato 
					FROM prenotazione
					WHERE codicePrenotazione = '$id';
					";
		$result=$bebDB->performQuery($queryText);
		$bebDB->closeConnection();
		$result = fromSQLtoArray($result,'ASSOC');
		if(count($result)>0){
			foreach ($result as $key => $value) {
			return $value['stato'];
		}
		}else{
			return $result;
		}
	}
