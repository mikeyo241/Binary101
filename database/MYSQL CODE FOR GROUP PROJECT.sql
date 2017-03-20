
CREATE TABLE ACCOUNT(
ACC_EMAIL VARCHAR(100) NOT NULL PRIMARY KEY,
ACC_PASS CHAR(32) NOT NULL,
ACC_FNAME VARCHAR(25) NOT NULL, 
ACC_LNAME VARCHAR(25) NOT NULL,
ACC_TYPE VARCHAR(12) NOT NULL
);

CREATE TABLE INSTRUCTOR(
ACC_EMAIL VARCHAR(100) PRIMARY KEY,
FOREIGN KEY (ACC_EMAIL) REFERENCES ACCOUNT(ACC_EMAIL));

CREATE TABLE STUDENT(
ACC_EMAIL VARCHAR(100) PRIMARY KEY,
FOREIGN KEY (ACC_EMAIL) REFERENCES ACCOUNT(ACC_EMAIL));


CREATE TABLE CLASS(
CLS_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
CLS_NAME VARCHAR(100) NOT NULL,
ACC_EMAIL VARCHAR(100),
CLS_SDATE DATE NOT NULL,
CLS_EDATE DATE NOT NULL,
CLS_MAXENROLLMENT INT NOT NULL,
FOREIGN KEY (ACC_EMAIL) REFERENCES INSTRUCTOR(ACC_EMAIL));



CREATE TABLE COURSE(
CRS_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
CRS_SDATE DATE NOT NULL,
CRS_EDATE DATE NOT NULL,
CRS_NAME VARCHAR(100) NOT NULL
);


CREATE TABLE GRADE(
GRD_CODE CHAR(5) NOT NULL PRIMARY KEY,
GRD_DESCRIPTION VARCHAR(50) NOT NULL,
GRD_VALUE INT);



CREATE TABLE COMPLETION(
COM_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
ACC_EMAIL VARCHAR(100),
REQ_ID INT,
COM_SCORE INT,
FOREIGN KEY (ACC_EMAIL) REFERENCES ACCOUNT(ACC_EMAIL),
FOREIGN KEY (REQ_ID) REFERENCES REQUIREMENT(REQ_ID)
);



CREATE TABLE REQUIREMENT(
REQ_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
CLS_ID INT NOT NULL,
CRS_ID INT NOT NULL,
REQ_REQUIRED BOOLEAN NOT NULL,
FOREIGN KEY (CLS_ID) REFERENCES CLASS(CLS_ID),
FOREIGN KEY (CRS_ID) REFERENCES COURSE(CRS_ID));

CREATE TABLE ENROLLMENT (
ENR_ID INT AUTO_INCREMENT PRIMARY KEY,
ACC_EMAIL VARCHAR(100),
CLS_ID INT(11),
FOREIGN KEY (ACC_EMAIL) REFERENCES STUDENT(ACC_EMAIL),
FOREIGN KEY (CLS_ID) REFERENCES CLASS(CLS_ID)
);

CREATE VIEW VIEW_CLASS_GRADES AS(
  SELECT
    CLASS.CLS_ID,
    CLASS.CLS_NAME,
    CLASS.CLS_MAXENROLLMENT,
    REQUIREMENT.REQ_ID,
    COMPLETION.COM_SCORE

  FROM CLASS

    LEFT JOIN REQUIREMENT
      ON REQUIREMENT.CLS_ID = CLASS.CLS_ID

    LEFT JOIN COMPLETION
      ON COMPLETION.REQ_ID = REQUIREMENT.REQ_ID

  WHERE COMPLETION.COM_SCORE IS NOT NULL
  ORDER BY CLASS.CLS_NAME
);