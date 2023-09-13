SET default_storage_engine=InnoDB;
SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED ;
SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED ;

/* ACCOUNT DATABASE SCHEMA */

CREATE TABLE `mst_account` (
	`fcompanyid` VARCHAR(16) NOT NULL COLLATE 'utf8mb4_general_ci',
	`faccountid` VARCHAR(40) NOT NULL COLLATE 'utf8mb4_general_ci',
	`factive_flag` VARCHAR(1) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fname` VARCHAR(64) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`flname` VARCHAR(32) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`ffname` VARCHAR(32) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fmname` VARCHAR(32) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`faddress` VARCHAR(120) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fphone` VARCHAR(120) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fofficeid` VARCHAR(16) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`faccesslvl` VARCHAR(16) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fmemo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`flogon_flag` VARCHAR(1) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fuserid` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fpassword` VARCHAR(120) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fpassword_update` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`flast_logon` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fsecurity_question` VARCHAR(64) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fsecurity_answer` VARCHAR(120) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`femail` VARCHAR(64) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fbirthdate` VARCHAR(16) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fsex` VARCHAR(32) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fcivil_status` VARCHAR(32) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fcreated_by` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fcreated_date` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fupdated_by` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fupdated_date` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fbirth_place` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci'
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;


create table mst_product(
	fcompanyid varchar(16) not null,	
	fproductid  varchar(64) not null,	
	fname varchar(64) not null,
	fdescription VARCHAR(64),
	factive_flag varchar(1),
	fsale_flag varchar(1),								
	fmemo varchar(255),	
	ftag VARCHAR(64),		
	fstnd_cost numeric(16,6),								
	fprev_cost numeric(16,6),																															
	ftax_type varchar(1),															
	fuom varchar(16),
	fstock int,		
	fstatus varchar(16),								
	fexpiry_alert varchar(1),								
	fcategory_id VARCHAR(32),
	fwarranty_duration numeric(12),
	fcreated_by varchar(40),
	fcreated_date varchar(20),
	fupdated_by varchar(40),
	fupdated_date varchar(20)
);



create table mst_product_category( 
	fcompanyid varchar(16) not null,
	fcategoryid varchar(16) not null,
	fcategory_name varchar(16),
	fcategory_description VARCHAR(32),
	fcategory_tag VARCHAR(16),
	fcategory_img VARCHAR(32),
	fcreated_by varchar(40),
	fcreated_date varchar(20),
	fupdated_by varchar(40),
	fupdated_date varchar(20)
);


create table pos_sale
(
	frecno		numeric(12,0) not NULL, /* The uniqueid of every transactions  */
	fcompanyid 	varchar(16), /* Companyid */
	fzcounter	numeric(12,0),  /* Fzcounter every EOD count */
	fsale_date	varchar(16), /* Date on the transactions */
	fsale_time	varchar(10), /* Time on the transactions */
	fcashierid	varchar(40), /* cashier / seller on the transactions */
	ftermid		varchar(16), /* Terminalid creating the transactions */
	ftrx_no		numeric(12,0), /* number the transactions */
	fdocument_no	numeric(12,0), /* Reciept number the transactions */
	fofficeid varchar(16), /* Office ID of the transactions */
	fvoid_flag	varchar(1), /* 1 if voided and 0 if posted */
	frcash		numeric(16,6), /* Total amount to be pay */
	fchange		numeric(16,6), /* Change from customer payment */
	fcash		numeric(16,6), /* cash from customer payment */
	fdiscount	numeric(16,6), /* Discount of the transaction */
	fgross		numeric(16,6), /* Net gross from the transaction */
	ftax		numeric(16,6), /* tax from the transactxion */
	ftotal_cost	numeric(16,6), /* cost from the transaction same as frcash */
	ftotal_qty	varchar(32), /* Total items brought */
	fcreated_by varchar(40), /* cashier name created this transaction */
	fcreated_date varchar(20), /* date created this transaction */
	fupdated_by varchar(40), /* cashier updated this transaction */
	fupdated_date varchar(20), /* date updated this transaction */
	fterm_updated_by varchar(4), /* terminal updated this transaction */
	fterm_updated_date varchar(14) /* date of terminal updated this transaction */

);

create table pos_sale_product
(

	frecno		numeric(12,0) not null, /* Primary key and foreign key use for linking */
	fseqno		numeric(6,0) not null, /* Sequence number of the product from transaction */
	fcompanyid 	varchar(16), /* Company ID */
	ftermid		varchar(16), /* Terminalid creating the transactions */
	fsale_date	varchar(16),  /* Date on the transactions */
	fproductid	varchar(64), /* Product ID */
	fqty		numeric(16,6), /* Quantity */
	fuom		varchar(16), /* Unit of measure */
	funitprice	numeric(16,6), /* Unit price of the product */
	ftax		numeric(16,6), /* Tax amount of the product */
	fexpiry varchar(16), /* Expiry date of the product */
	fstatus_flag varchar(1), /* Status of the product either 1 or 2 */
	fcreated_by varchar(40), /* created by cashier */
	fcreated_date varchar(20), /* created date */
	fupdated_by varchar(40), /* updated by cashier */
	fupdated_date varchar(20) /* Updated Date */

);

create table pos_sale_payment
(

	frecno		numeric(12,0) not null, /* Primary key and foreign key use for linking */
	fcompanyid 	varchar(16), /* Company ID */
	ftermid		varchar(16), /* Terminal ID created the transaction */
	fcashierid	varchar(40), /* Cashier ID created the transaction */
	fsale_date	varchar(16), /* date created the transaction */
	ftrxdate	varchar(16), /* transaction date the transaction with Hours, Minutes and seconds */
	famount		numeric(16,6), /* Amount to be paid from the transaction */
	fcreated_by varchar(40), /* Created by cashier */
	fcreated_date varchar(20), /* Created Date */
	fupdated_by varchar(40), /* Updated by cashier */
	fupdated_date varchar(20) /* Updated Date */

);

create table pos_reading (
	fcompanyid 		varchar(16) not null, /* Company ID */
	ftermid 		varchar(16)  not null,  /* Terminal ID */
	fzcounter 		numeric(12,0)  not null, /* Current z-counter */
	fpzcounter 		numeric(12,0), /* Previous Z-counter */
	fsale_date		varchar(16), /* Transaction Date */
	ffdocument_no	varchar(16), /* First Document number of the current day transaction */
	ftdocument_no	varchar(16), /* Last Document number of the current day transaction */
	ftotal_transaction	varchar(16), /* Total Transaction */
	fgross			numeric(16,6), /* Net gross of the current day transaction */
	ftax			numeric(16,6), /* Tex of the current day transaction */
	fpgross			numeric(16,6), /* Previous NRGT */
	fgross2			numeric(16,6), /* Present NRGT */
	fcreated_by 	varchar(16), /* EOD by  */
	fcreated_date 	varchar(20), /* EOD date  */
	fupdated_by 	varchar(16), /* EOD updated by  */
	fupdated_date 	varchar(20) /* EOD updated Date  */
                
);




create table sm_company (
	fcompanyid varchar(16) not null ,
	fname varchar(64),
	factive_flag varchar(1),
	faddress1 varchar(64),
	fcompanylicense varchar(64),
	fcompanykey varchar(64),
	ftelno varchar(64),
	fmemo varchar(255),
	fexpiry varchar(255),
	fcompanyemail varchar(64),	
	ffax varchar(64),
	fowner varchar(64),		
	fyest varchar(64),
	fverified varchar(16),
	fcompanyimg varchar(64),											
	fcreated_by varchar(40),
	fcreated_date varchar(20),
	fupdated_by varchar(40),
	fupdated_date varchar(20)
);

create table sm_company_mode (
	fcompanyid varchar(16) not null ,
	fmode = varchar (16) not null,
	fcreated_by varchar(40),
	fcreated_date varchar(20),
	fupdated_by varchar(40),
	fupdated_date varchar(20)
);


create table pos_terminal
(
	fcompanyid 	varchar(16) not null,
	ftermid		varchar(16) not null,
	fmemo 		varchar(80),
	fofficeid	varchar(16),
	fstatus_flag	varchar(1),
	factive_flag	varchar(1),
	fonline_status varchar(14),
	fterminal_mode varchar(1),
	flast_post varchar(14),
	fcashierid varchar(40),
	fversion varchar(32),
	fcreated_by varchar(40),
	fcreated_date varchar(20),
	fupdated_by varchar(40),
	fupdated_date varchar(20)
);

create table mst_info(
	fcompanyid 	varchar(16),
	fsource varchar(16),
	fmessage varchar(64),
	fstatus varchar(64),
	furl varchar(64),
	fcreated_date varchar(14),
	fupdated_date varchar(14)
);	

create table pos_sale_current(
	fcompanyid 	varchar(16),
	ftermid varchar (16),
	fzcounter varchar (16),
	frecno varchar (16),
	fproductid varchar (16),
	fqty int,
	fdiscount int,
	ftax int,
	fcreated_by varchar (16),
	fcreated_date varchar (16)
);	

create table sm_version(
	fversionid varchar(16),
	fversion varchar(16),
	fversion_alias varchar(32),
	fversion_note varchar(16),
	fversion_update varchar(32),
	fversion_released_date varchar(32),
	fversion_released_by varchar(32)
);

CREATE TABLE `sm_ip_logs` (
	`fid` INT(11) NOT NULL AUTO_INCREMENT,
	`fip_address` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fvisit_count` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fupdated_by` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fupdated_date` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`fid`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;


CREATE TABLE `sm_license` (
	`flicense_type` VARCHAR(32) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`flicense` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fcreated_by` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fcreated_date` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fupdated_by` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fupdated_date` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci'
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;





/*

ALTER TABLE `mst_product_category` MODIFY COLUMN `fcategory_img` VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;


INSERT DUMMY DATA FROM MST ACCOUNT TABLE

INSERT INTO mst_account (fcompanyid, faccountid, factive_flag, fname, flname, ffname, fmname, faddress, fphone, fofficeid, faccesslvl, fmemo, flogon_flag, fuserid, fpassword, fpassword_update, flast_logon, fsecurity_question, fsecurity_answer, femail, fbirthdate, fregister_date, fsex, fcivil_status, fcreated_by, fcreated_date, fupdated_by, fupdated_date)
VALUES
    ('COMP001', 'ACC001', 'Y', 'John', 'Doe', 'John', 'M', '123 Main St', '123-456-7890', 'OFF001', 'Admin', 'This is a memo for John Doe.', 'Y', 'johndoe123', 'hashed_password', '2023-07-25', '2023-07-25 08:00:00', 'What is your favorite color?', 'Blue', 'johndoe@example.com', '1990-01-01', '2023-07-25 08:00:00', 'Male', 'Single', 'AdminUser', '2023-07-25 08:00:00', 'AdminUser', '2023-07-25 08:00:00'),
    ('COMP001', 'ACC002', 'Y', 'Jane', 'Smith', 'Jane', 'A', '456 Oak Ave', '987-654-3210', 'OFF002', 'User', 'This is a memo for Jane Smith.', 'Y', 'janesmith321', 'hashed_password', '2023-07-25', '2023-07-25 09:30:00', 'What is your favorite animal?', 'Dog', 'janesmith@example.com', '1995-05-15', '2023-07-25 09:30:00', 'Female', 'Married', 'AdminUser', '2023-07-25 09:30:00', 'AdminUser', '2023-07-25 09:30:00'),
    ('COMP002', 'ACC003', 'N', 'Mike', 'Johnson', 'Mike', 'L', '789 Elm Rd', '555-123-4567', 'OFF003', 'User', 'No memo for Mike Johnson.', 'N', 'mikejohn', 'hashed_password', '2023-07-25', '2023-07-25 12:15:00', 'What city were you born in?', 'New York', 'mikejohn@example.com', '1985-12-10', '2023-07-25 12:15:00', 'Male', 'Divorced', 'AdminUser', '2023-07-25 12:15:00', 'AdminUser', '2023-07-25 12:15:00'),
    ('COMP002', 'ACC004', 'Y', 'Emily', 'Williams', 'Emily', 'K', '101 Maple Lane', '444-555-6666', 'OFF001', 'User', 'No memo for Emily Williams.', 'Y', 'emilywill', 'hashed_password', '2023-07-25', '2023-07-25 14:45:00', 'What is your mother\'s maiden name?', 'Smith', 'emilywill@example.com', '1998-08-20', '2023-07-25 14:45:00', 'Female', 'Single', 'AdminUser', '2023-07-25 14:45:00', 'AdminUser', '2023-07-25 14:45:00'),
    ('COMP003', 'ACC005', 'Y', 'David', 'Lee', 'David', 'S', '222 Pine St', '777-888-9999', 'OFF002', 'User', 'This is a memo for David Lee.', 'Y', 'davidlee', 'hashed_password', '2023-07-25', '2023-07-25 16:30:00', 'What was your first pet\'s name?', 'Max', 'davidlee@example.com', '1993-04-05', '2023-07-25 16:30:00', 'Male', 'Single', 'AdminUser', '2023-07-25 16:30:00', 'AdminUser', '2023-07-25 16:30:00');





INSERT INTO mst_account (
    fcompanyid, faccountid, factive_flag, fname, flname, ffname, fmname,
    faddress, fphone, fofficeid, faccesslvl, fmemo, flogon_flag, fuserid,
    fpassword, fpassword_update, flast_logon, fsecurity_question, fsecurity_answer,
    femail, fbirthdate, fsex, fcivil_status, fcreated_by,
    fcreated_date, fupdated_by, fupdated_date, fbirth_place
)
VALUES
    ('COMP001', 'ACC001', 'Y', 'John Doe', 'Doe', 'John', 'M', '123 Main St', '555-1234', 'OFFICE001', 'ADMIN', 'Sample memo 1', 'Y', 'johndoe', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite color?', 'Blue', 'john.doe@example.com', '1990-01-15', 'Male', 'Single', 'adminuser', '2023-07-01', 'adminuser', '2023-07-27', 'New York'),
    ('COMP002', 'ACC002', 'Y', 'Jane Smith', 'Smith', 'Jane', 'F', '456 Oak St', '555-5678', 'OFFICE002', 'USER', 'Sample memo 2', 'Y', 'janesmith', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your pet''s name?', 'Fluffy', 'jane.smith@example.com', '1988-12-10', 'Female', 'Married', 'user123', '2023-07-02', 'user123', '2023-07-27', 'Los Angeles'),
    ('COMP003', 'ACC003', 'N', 'James Johnson', 'Johnson', 'James', 'M', '789 Elm St', '555-9876', 'OFFICE003', 'USER', 'Sample memo 3', 'N', 'jamesjohnson', 'hashed_password', 'hashed_password', '2023-07-27', 'What was your first car?', 'Mustang', 'james.johnson@example.com', '1985-05-20', 'Male', 'Divorced', 'user456', '2023-07-03', 'user456', '2023-07-27', 'Chicago'),
    ('COMP004', 'ACC004', 'Y', 'Sarah Lee', 'Lee', 'Sarah', 'F', '987 Maple Ave', '555-2468', 'OFFICE004', 'USER', 'Sample memo 4', 'Y', 'sarahlee', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite book?', 'Pride and Prejudice', 'sarah.lee@example.com', '1992-09-30', 'Female', 'Single', 'user789', '2023-07-04', 'user789', '2023-07-27', 'London'),
    ('COMP005', 'ACC005', 'N', 'Michael Brown', 'Brown', 'Michael', 'M', '234 Pine Rd', '555-1357', 'OFFICE005', 'ADMIN', 'Sample memo 5', 'N', 'michaelbrown', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite sport?', 'Basketball', 'michael.brown@example.com', '1987-11-18', 'Male', 'Married', 'adminuser2', '2023-07-05', 'adminuser2', '2023-07-27', 'Sydney'),
    ('COMP006', 'ACC006', 'Y', 'Emily Davis', 'Davis', 'Emily', 'F', '567 Cedar Ln', '555-3698', 'OFFICE006', 'USER', 'Sample memo 6', 'Y', 'emilydavis', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite movie?', 'The Shawshank Redemption', 'emily.davis@example.com', '1993-03-25', 'Female', 'Single', 'user987', '2023-07-06', 'user987', '2023-07-27', 'Paris'),
    ('COMP007', 'ACC007', 'N', 'Daniel Wilson', 'Wilson', 'Daniel', 'M', '876 Oakwood Dr', '555-8023', 'OFFICE007', 'USER', 'Sample memo 7', 'Y', 'danielwilson', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite food?', 'Pizza', 'daniel.wilson@example.com', '1991-08-12', 'Male', 'Divorced', 'user654', '2023-07-07', 'user654', '2023-07-27', 'Berlin'),
    ('COMP008', 'ACC008', 'Y', 'Olivia Martin', 'Martin', 'Olivia', 'F', '789 Oak Ave', '555-6482', 'OFFICE008', 'ADMIN', 'Sample memo 8', 'N', 'oliviamartin', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite hobby?', 'Painting', 'olivia.martin@example.com', '1989-06-08', 'Female', 'Married', 'adminuser3', '2023-07-08', 'adminuser3', '2023-07-27', 'Tokyo'),
    ('COMP009', 'ACC009', 'N', 'William Anderson', 'Anderson', 'William', 'M', '345 Maple Rd', '555-8642', 'OFFICE009', 'USER', 'Sample memo 9', 'Y', 'williamanderson', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite vacation spot?', 'Bali', 'william.anderson@example.com', '1994-02-05', 'Male', 'Single', 'user321', '2023-07-09', 'user321', '2023-07-27', 'Cape Town'),
    ('COMP010', 'ACC010', 'Y', 'Ava Taylor', 'Taylor', 'Ava', 'F', '234 Elm Ave', '555-7309', 'OFFICE010', 'ADMIN', 'Sample memo 10', 'N', 'avataylor', 'hashed_password', 'hashed_password', '2023-07-27', 'What is your favorite song?', 'Imagine', 'ava.taylor@example.com', '1990-10-28', 'Female', 'Single', 'adminuser4', '2023-07-10', 'adminuser4', '2023-07-27', 'New Delhi');

_________________________________

CREATE DUMMY TRANSACTION (POS SALE TABLE) --->

INSERT INTO pos_sale (frecno, fcompanyid, fzcounter, fsale_date, fsale_time, fcashierid, ftermid, ftrx_no, fdocument_no, fofficeid, fvoid_flag, frcash, fchange, fcash, fdiscount, fgross, ftax, ftotal_cost, ftotal_qty, fcreated_by, fcreated_date, fupdated_by, fupdated_date, fterm_updated_by, fterm_updated_date) VALUES('000002', 'XAMAL5135DA', '0001', '20230813', '123042', '508851', '0001', '000002', '000002', '0001', '0', '150.00', '02.00', '152.00', '0.00', '150.00', '0.00', '150.00', '8', 'admin', '20230813', 'admin', '20230813', '0001', '20230813');

_________________________________

CREATE DUMMY TRANSACTION (POS SALE PAYMENT TABLE) --->

INSERT INTO pos_sale_payment (frecno, fcompanyid, ftermid, fcashierid, fsale_date, ftrxdate, famount, fcreated_by, fcreated_date, fupdated_by, fupdated_date) VALUES('000001', 'XAMAL5135DA', '0001', '508851', '20230813', '20230813123041', '130.00', 'admin', '20230813', 'admin', '20230813');

_________________________________

CREATE DUMMY TRANSACTION (POS SALE PRODUCT TABLE) --->
INSERT INTO pos_sale_product (frecno, fseqno, fcompanyid, ftermid, fsale_date, fproductid, fqty, fuom, funitprice, ftax, fexpiry, fstatus_flag, fcreated_by, fcreated_date, fupdated_by, fupdated_date) VALUES('000001', '1', 'XAMAL5135DA', '0001', '20230813', '8849032341', '1', 'pieces', '130.00', '0.00', '20240813', '1', 'admin', '20230813', 'admin', '20230813');


_________________________________

CREATE DUMMY TRANSACTION (POS READING TABLE) --->

INSERT INTO pos_reading (fcompanyid, ftermid, fzcounter, fpzcounter, fsale_date, ffdocument_no, ftdocument_no, ftotal_transaction, fgross, ftax, fpgross, fgross2, fcreated_by, fcreated_date, fupdated_by, fupdated_date) VALUES('XAMAL5135DA', '0001', '0001', '0000', '20230813', '000001', '000003', '3', '335.00', '0.00', '0.00', '335.00', 'admin', '20230813', 'admin', '20230813');

_________________________________

CREATE DUMMY COMPANY (SM_COMPANY TABLE) --->


INSERT INTO sm_company (fcompanyid, fname, factive_flag, faddress, fcompanylicense, fcompanykey, ftelno, fmemo, fexpiry, fcompanyemail, ffax, fowner, fyest, fverified, fcompanyimg, fcreated_by, fcreated_date, fupdated_by, fupdated_date) VALUES('XAMAL5135DA', 'Xamal Group Inc', '1', 'Hirakawa cho, Chiyoda-kuTokyo', 'XML-99141315VR', 'XML4031241', '+63-32-261-1995', 'Not set', '20230817', 'info@xamalgroup.com', 'not set', 'John Doe', '1995', '1', '123.img', 'admin', '20230816', 'admin', '20230816');

_________________________________

VERSION (SM_VERSION TABLE) --->

INSERT INTO sm_version (fversionid, fversion, fversion_alias, fversion_note, fversion_update, fversion_released_date, fversion_released_by) VALUES ('V0001', 'V1.0.0.30 -Alpha.1', 'Demo', 'Initial Release for production testing', '20230826', '20230827', 'developer');

-- Inserting Test Data 1
INSERT INTO mst_product (fcompanyid, fproductid, fname, fdescription, factive_flag, fsale_flag, fmemo, ftag, fstnd_cost, fprev_cost, ftax_type, fuom, fexpiry_alert, fcategory_id, fwarranty_duration, fcreated_by, fcreated_date, fupdated_by, fupdated_date)
VALUES ('COMP001', 'PROD001', 'Product A', 'Description A', 'Y', 'Y', 'Test Memo 1', 'Tag 1', 10.50, 9.99, 'A', 'Each', 'N', 'CAT001', 12, 'User1', '2023-08-06', 'User1', '2023-08-06');

-- Inserting Test Data 2
INSERT INTO mst_product (fcompanyid, fproductid, fname, fdescription, factive_flag, fsale_flag, fmemo, ftag, fstnd_cost, fprev_cost, ftax_type, fuom, fexpiry_alert, fcategory_id, fwarranty_duration, fcreated_by, fcreated_date, fupdated_by, fupdated_date)
VALUES ('COMP001', 'PROD002', 'Product B', 'Description B', 'Y', 'N', 'Test Memo 2', 'Tag 2', 15.25, 14.50, 'B', 'Box', 'Y', 'CAT002', 6, 'User2', '2023-08-06', 'User2', '2023-08-06');

-- Inserting Test Data 3
INSERT INTO mst_product (fcompanyid, fproductid, fname, fdescription, factive_flag, fsale_flag, fmemo, ftag, fstnd_cost, fprev_cost, ftax_type, fuom, fexpiry_alert, fcategory_id, fwarranty_duration, fcreated_by, fcreated_date, fupdated_by, fupdated_date)
VALUES ('COMP002', 'PROD003', 'Product C', 'Description C', 'N', 'Y', 'Test Memo 3', 'Tag 3', 8.99, 8.75, 'A', 'Piece', 'N', 'CAT001', 24, 'User3', '2023-08-06', 'User3', '2023-08-06');

-- Inserting Test Data 4
INSERT INTO mst_product (fcompanyid, fproductid, fname, fdescription, factive_flag, fsale_flag, fmemo, ftag, fstnd_cost, fprev_cost, ftax_type, fuom, fexpiry_alert, fcategory_id, fwarranty_duration, fcreated_by, fcreated_date, fupdated_by, fupdated_date)
VALUES ('COMP002', 'PROD004', 'Product D', 'Description D', 'Y', 'N', 'Test Memo 4', 'Tag 4', 5.49, 5.25, 'B', 'Pack', 'Y', 'CAT003', 36, 'User4', '2023-08-06', 'User4', '2023-08-06');

-- Inserting Test Data 5
INSERT INTO mst_product (fcompanyid, fproductid, fname, fdescription, factive_flag, fsale_flag, fmemo, ftag, fstnd_cost, fprev_cost, ftax_type, fuom, fexpiry_alert, fcategory_id, fwarranty_duration, fcreated_by, fcreated_date, fupdated_by, fupdated_date)
VALUES ('COMP003', 'PROD005', 'Product E', 'Description E', 'Y', 'Y', 'Test Memo 5', 'Tag 5', 12.75, 11.99, 'A', 'Each', 'N', 'CAT004', 18, 'User5', '2023-08-06', 'User5', '2023-08-06');


*/


