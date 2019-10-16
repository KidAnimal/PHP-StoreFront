DROP DATABASE TERM_PROJECT;
CREATE DATABASE TERM_PROJECT; 

CREATE TABLE EMPLOYEE 
(
    employeeID DECIMAL(12) NOT NULL PRIMARY KEY,
    employeePassword VARCHAR(30)NOT NULL,
    employeeFirstName VARCHAR(30)NOT NULL, 
    employeeLastName VARCHAR(30)NOT NULL,
    employeeEmail VARCHAR(30)NOT NULL
);
CREATE TABLE CUSTOMER 
(
    customerID DECIMAL(12) NOT NULL PRIMARY KEY,
    customerFirstName VARCHAR(30)NOT NULL, 
    customerLastName VARCHAR(30)NOT NULL,
    customerEmail VARCHAR(30)NOT NULL, 
    customerLastLogged DECIMAL(4,2)
);
(
    artID DECIMAL(12)NOT NULL PRIMARY KEY, 
    artTitle VARCHAR(30)NOT NULL
)
CREATE TABLE ART_ORDER
(
    orderID DECIMAL(12) NOT NULL PRIMARY KEY
);
CREATE TABLE products (
  productID         INT            NOT NULL   AUTO_INCREMENT,
  categoryID        INT            NOT NULL,
  productCode       VARCHAR(10)    NOT NULL,
  productName       VARCHAR(255)   NOT NULL,
  description       TEXT           NOT NULL,
  listPrice         DECIMAL(10,2)  NOT NULL,
  discountPercent   DECIMAL(10,2)  NOT NULL   DEFAULT 0.00,
  dateAdded         DATETIME       NOT NULL,
  PRIMARY KEY (productID), 
  INDEX categoryID (categoryID), 
  UNIQUE INDEX productCode (productCode)
);
CREATE TABLE categories (
  categoryID        INT            NOT NULL AUTO_INCREMENT,
  categoryName      VARCHAR(255)   NOT NULL,
  PRIMARY KEY (categoryID)
);
CREATE TABLE administrators (
  adminID           INT            NOT NULL   AUTO_INCREMENT,
  emailAddress      VARCHAR(255)   NOT NULL,
  password          VARCHAR(255)   NOT NULL,
  firstName         VARCHAR(255)   NOT NULL,
  lastName          VARCHAR(255)   NOT NULL,
  PRIMARY KEY (adminID)
);

CREATE TABLE orders (
  orderID           INT            NOT NULL   AUTO_INCREMENT,
  customerID        INT            NOT NULL,
  orderDate         DATETIME       NOT NULL,
  shipAmount        DECIMAL(10,2)  NOT NULL,
  taxAmount         DECIMAL(10,2)  NOT NULL,
  shipDate          DATETIME                  DEFAULT NULL,
  shipAddressID     INT            NOT NULL,
  cardType          INT            NOT NULL,
  cardNumber        CHAR(16)       NOT NULL,
  cardExpires       CHAR(7)        NOT NULL,
  billingAddressID  INT            NOT NULL,
  PRIMARY KEY (orderID), 
  INDEX customerID (customerID)
);

CREATE TABLE orderItems (
  itemID            INT            NOT NULL   AUTO_INCREMENT,
  orderID           INT            NOT NULL,
  productID         INT            NOT NULL,
  itemPrice         DECIMAL(10,2)  NOT NULL,
  discountAmount    DECIMAL(10,2)  NOT NULL,
  quantity          INT NOT NULL,
  PRIMARY KEY (itemID), 
  INDEX orderID (orderID), 
  INDEX productID (productID)
);

INSERT INTO CUSTOMER(customerID,customerFirstName,customerLastName,customerEmail,customerLastLogged) VALUES
(1, 'Rick','Sanchez','birdperson@aol.com','today'),
(2, 'Morty','Smith','IloveJessica@jessica','yesterday'),
(3, 'GearHead','Von Gear','timesatickin@gmail.com','never');

INSERT INTO orders (orderID, customerID, orderDate, shipAmount, taxAmount, shipDate, shipAddressID, cardType, cardNumber, cardExpires, billingAddressID) VALUES
(1, 1, '2014-05-30 09:40:28', '5.00', '32.32', '2014-06-01 09:43:13', 1, 2, '4111111111111111', '04/2019', 2),
(2, 2, '2014-06-01 11:23:20', '5.00', '0.00', NULL, 3, 2, '4111111111111111', '08/2018', 4),
(3, 1, '2014-06-03 09:44:58', '10.00', '89.92', NULL, 1, 2, '4111111111111111', '04/2019', 2);

INSERT INTO orderItems (itemID, orderID, productID, itemPrice, discountAmount, quantity) VALUES
(1, 1, 2, '399.00', '39.90', 1),
(2, 2, 4, '699.00', '69.90', 1),
(3, 3, 3, '499.00', '49.90', 1),
(4, 3, 6, '549.99', '0.00', 1);
INSERT INTO CATEGORIES(categoryID, categoryName) VALUES
    (1, 'Pen and Ink'), 
    (2, 'Paint'),
    (3, 'Mixed Media'),
    (4, 'Graphic Design'),
    (5, 'Digital'),
    (6, 'Other');

INSERT INTO PRODUCTS(productID,categoryID,productCode,productName,description,listPrice,discountPercent,dateAdded) VALUES
    (1,5,'SROV1','Sona Rovath','Depiction of a warrior from the Ebolt Clan','120','5','08:12:2018'),
    (2,5,'TSU12','Tight Suit Issue 2','Page 1 and 2 of Tight Suit Issue 2','30','5','08:12:2018'),
    (3,5,'THORV1','Thorvain','The Soul of a warrior captured by a demon','100','5','08:12:2018'),
    (4,5,'VALD1','Valdja - Landscape','Landscape Concept of the world known as Valdja','120','5','08:12:2018'),
    (5,3,'BART1','Barter','Piece 2/6 showing life in Manaurath','120','5','08:12:2018'),
    (6,3,'LERN1','Learn','Piece 6/6 showing life after scethe.','120','5','08:12:2018');

INSERT INTO administrators (adminID,emailAddress,password,firstName,lastName) VALUES
    (1,'cs602_user','cs602_secret','cs','SixZeroTwo'),
    (2,'brendonr@bu.edu','password','Brendon','Reynolds'); 