<?php
	$conn = new mysqli("localhost","root","","hotelsystem");

	// $sql = "CREATE TABLE RESERVATIONS(
	// 	RES_ID INT AUTO_INCREMENT PRIMARY KEY,
	// 	CUSTOMER_ID INT NOT NULL,
	// 	CONTACT BIGINT(10) NOT NULL,
	// 	ADDRESS VARCHAR(20) NOT NULL,
	// 	GENDER VARCHAR(10) NOT NULL,
	// 	DOB DATE NOT NULL,
	// 	ROOM_ID INT NOT NULL,
	// 	NUMBER_OF_ROOMS INT(30) NOT NULL,
	// 	CHECK_IN DATE NOT NULL,
	// 	CHECK_OUT DATE NOT NULL,
	// 	FOREIGN KEY(ROOM_ID) REFERENCES ROOMS(ROOM_ID),
	//  FOREIGN KEY(CUSTOMER_ID) REFERENCES CUSTOMERS(CUS_ID)
	// )";

			

	$sql = "CREATE TABLE CANCELLATIONS(
		CANCEL_ID INT(30) AUTO_INCREMENT PRIMARY KEY,
		DETAILS VARCHAR(200) NOT NULL,
		REMARKS VARCHAR(200) NOT NULL,
		CUS_ID INT NOT NULL,
		FOREIGN KEY(CUS_ID) REFERENCES CUSTOMERS(CUS_ID)
	)";

	 //$sql = "ALTER TABLE CANCELLATION RENAME TO CANCELLATIONS";

	//  $sql = "CREATE TABLE RESERVATIONS_ROOMS(
	// 	  		ID INT PRIMARY KEY,
	// 			RESERVATION_ID INT,
	// 			ROOM_ID INT,
	// 			NO_OF_ROOM INT NOT NULL,
	// 		  CHECKOUT_ROOM VARCHAR(25) NOT NULL,
	// 		  CHECKOUT_DATE DATE NOT NULL,
	// 			FOREIGN KEY(ROOM_ID) REFERENCES ROOMS(ROOM_ID),
	// 			FOREIGN KEY(RESERVATION_ID) REFERENCES RESERVATIONS(RES_ID)
	
	// )"
// ;

	if ($conn->query($sql)==TRUE) {
		echo "Table is created successfully";
	}
	else{
		echo "Error creting table: ".$conn->error;
	}
?>