
CREATE TABLE ACCOUNT(
  ACC_EMAIL VARCHAR(100) NOT NULL PRIMARY KEY,
  ACC_PASS CHAR(32) NOT NULL,
  ACC_FNAME VARCHAR(25) NOT NULL,
  ACC_LNAME VARCHAR(25) NOT NULL,
  ACC_TYPE VARCHAR(12) NOT NULL,
  ACC_TEMP_PASS VARCHAR(32),
  ACC_TEMP_PASS_EXPIRES DATETIME
);

CREATE TABLE INSTRUCTOR(
  ACC_EMAIL VARCHAR(100) PRIMARY KEY,
  FOREIGN KEY (ACC_EMAIL) REFERENCES ACCOUNT(ACC_EMAIL)
);

CREATE TABLE STUDENT(
  ACC_EMAIL VARCHAR(100) PRIMARY KEY,
  FOREIGN KEY (ACC_EMAIL) REFERENCES ACCOUNT(ACC_EMAIL)
);


CREATE TABLE CLASS(
  CLS_ID VARCHAR(100) NOT NULL PRIMARY KEY,
  CLS_NAME VARCHAR(100) NOT NULL,
  ACC_EMAIL VARCHAR(100),
  CLS_SDATE DATE NOT NULL,
  CLS_EDATE DATE NOT NULL,
  CLS_MAXENROLLMENT INT NOT NULL,
  FOREIGN KEY (ACC_EMAIL) REFERENCES INSTRUCTOR(ACC_EMAIL)
);



CREATE TABLE COURSE(
  CRS_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  CRS_CHAP INT NOT NULL,
  CRS_NAME VARCHAR(100) NOT NULL
);


CREATE TABLE GRADE(
  GRD_CODE CHAR(5) NOT NULL PRIMARY KEY,
  GRD_DESCRIPTION VARCHAR(50) NOT NULL,
  GRD_VALUE INT
);

CREATE TABLE REQUIREMENT(
  REQ_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  CLS_ID VARCHAR(100) NOT NULL,
  CRS_ID INT NOT NULL,
  REQ_REQUIRED BOOLEAN NOT NULL,
  FOREIGN KEY (CLS_ID) REFERENCES CLASS(CLS_ID),
  FOREIGN KEY (CRS_ID) REFERENCES COURSE(CRS_ID)
);

CREATE TABLE COMPLETION(
  COM_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  ACC_EMAIL VARCHAR(100),
  REQ_ID INT,
  COM_SCORE INT,
  FOREIGN KEY (ACC_EMAIL) REFERENCES ACCOUNT(ACC_EMAIL),
  FOREIGN KEY (REQ_ID) REFERENCES REQUIREMENT(REQ_ID)
);


CREATE TABLE ENROLLMENT (
  ENR_ID INT AUTO_INCREMENT PRIMARY KEY,
  ACC_EMAIL VARCHAR(100),
  CLS_ID VARCHAR(100),
  FOREIGN KEY (ACC_EMAIL) REFERENCES STUDENT(ACC_EMAIL),
  FOREIGN KEY (CLS_ID) REFERENCES CLASS(CLS_ID)
);



CREATE VIEW VIEW_GRADEBOOK  AS(
  SELECT
    STUDENT.ACC_EMAIL,
    ACCOUNT.ACC_FNAME AS STU_FNAME,
    ACCOUNT.ACC_LNAME AS STU_LNAME,
    CLASS.CLS_ID,
    CLASS.CLS_NAME,
    COURSE.CRS_ID,
    COURSE.CRS_NAME,
    REQUIREMENT.REQ_ID,
    COMPLETION.COM_SCORE

  FROM STUDENT

    LEFT JOIN ACCOUNT
     ON STUDENT.ACC_EMAIL = ACCOUNT.ACC_EMAIL

    LEFT JOIN ENROLLMENT
      ON STUDENT.ACC_EMAIL = ENROLLMENT.ACC_EMAIL

    LEFT JOIN CLASS
      ON CLASS.CLS_ID = ENROLLMENT.CLS_ID

    LEFT JOIN REQUIREMENT
      ON REQUIREMENT.CLS_ID = CLASS.CLS_ID

    LEFT JOIN COMPLETION
      ON COMPLETION.REQ_ID = REQUIREMENT.REQ_ID

    LEFT JOIN COURSE
      ON REQUIREMENT.CRS_ID = COURSE.CRS_ID


  ORDER BY STU_LNAME, STU_FNAME
);

CREATE VIEW VIEW_CLASS_GRADES AS(
  SELECT
    CLASS.CLS_ID,
    CLASS.CLS_NAME,
    ACCOUNT.ACC_FNAME,
    ACCOUNT.ACC_LNAME,
    CLASS.CLS_MAXENROLLMENT,
    REQUIREMENT.REQ_ID,
    COMPLETION.COM_SCORE

  FROM CLASS
    LEFT JOIN ACCOUNT
      ON ACCOUNT.ACC_EMAIL = CLASS.ACC_EMAIL

    LEFT JOIN REQUIREMENT
      ON REQUIREMENT.CLS_ID = CLASS.CLS_ID

    LEFT JOIN COMPLETION
      ON COMPLETION.REQ_ID = REQUIREMENT.REQ_ID

  #WHERE COMPLETION.COM_SCORE IS NOT NULL
  ORDER BY CLASS.CLS_NAME
);

CREATE VIEW VIEW_CLASSES AS(
  SELECT
    CLASS.CLS_ID,
    CLASS.CLS_NAME,
    ACCOUNT.ACC_FNAME AS INSTRUCT_FNAME,
    ACCOUNT.ACC_LNAME AS INSTRUCT_LNAME,
    CLASS.CLS_MAXENROLLMENT,
    REQUIREMENT.REQ_ID,
    COMPLETION.COM_SCORE

  FROM CLASS
    LEFT JOIN ACCOUNT
      ON ACCOUNT.ACC_EMAIL = CLASS.ACC_EMAIL

    LEFT JOIN REQUIREMENT
      ON REQUIREMENT.CLS_ID = CLASS.CLS_ID

    LEFT JOIN COMPLETION
      ON COMPLETION.REQ_ID = REQUIREMENT.REQ_ID

  ORDER BY CLASS.CLS_NAME
);

CREATE VIEW VIEW_STUDENT_CLASSES AS (
  SELECT ENROLLMENT.ACC_EMAIL AS STUD_EMAIL,
  CLASS.CLS_ID, CLASS.CLS_NAME,
   ACCOUNT.ACC_FNAME AS INSTRUCT_FNAME,
    ACCOUNT.ACC_LNAME  AS INSTRUCT_LNAME
  FROM ENROLLMENT
    LEFT JOIN CLASS ON CLASS.CLS_ID=ENROLLMENT.CLS_ID
    LEFT JOIN ACCOUNT ON ACCOUNT.ACC_EMAIL=CLASS.ACC_EMAIL);

CREATE VIEW VIEW_CLASS AS (
  SELECT CLASS.CLS_ID, CLASS.CLS_NAME, ACCOUNT.ACC_FNAME AS INSTRUCT_FNAME, ACCOUNT.ACC_LNAME AS INSTRUCT_LNAME
  FROM CLASS
  LEFT JOIN ACCOUNT ON ACCOUNT.ACC_EMAIL=CLASS.ACC_EMAIL);



/*CREATE VIEW VIEW_GRADEBOOK AS (
SELECT COMPLETION.ACC_EMAIL AS STUD_EMAIL, CLASS.CLS_ID, CLASS.CLS_NAME, CLASS.ACC_EMAIL AS ISNSTRUCT_EMAIL,
  ACCOUNT.ACC_FNAME AS INSTRUCT_FNAME, ACCOUNT.ACC_LNAME AS INSTRUCT_LNAME, REQUIREMENT.CRS_ID, COMPLETION.COM_ID, COMPLETION.COM_SCORE
FROM COMPLETION
LEFT JOIN REQUIREMENT ON REQUIREMENT.REQ_ID=COMPLETION.REQ_ID
LEFT JOIN CLASS ON CLASS.CLS_ID=REQUIREMENT.CLS_ID
LEFT JOIN ACCOUNT ON ACCOUNT.ACC_EMAIL=CLASS.ACC_EMAIL);
*/

/* Actual COURSE Data */
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (1, "History of Binary");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (2, "Powers of 2");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (3, "Decimal to Binary Conversion");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (4, "Binary to Decimal Conversion");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (5, "Binary Math");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (6, "Binary to Hex Converson");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (7, "2's Complement");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (8, "Venn Diagrams");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (9, "Truth Tables");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (10, "Creating Pseudo Code");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (11, "Using Raptor");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (12, "");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (13, "");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (14, "");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (15, "");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (16, "");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (17, "");
INSERT INTO COURSE (CRS_CHAP, CRS_NAME) VALUES (18, "");

/* Dummy REQUIREMENT data  */
INSERT INTO REQUIREMENT (CLS_ID, CRS_ID, REQ_REQUIRED) VALUES ("20398", "1", "1");
INSERT INTO REQUIREMENT (CLS_ID, CRS_ID, REQ_REQUIRED) VALUES ("20398", "2", "1");
INSERT INTO REQUIREMENT (CLS_ID, CRS_ID, REQ_REQUIRED) VALUES ("20398", "3", "1");
INSERT INTO REQUIREMENT (CLS_ID, CRS_ID, REQ_REQUIRED) VALUES ("20398", "4", "0");

/* Dummy COMPLETION data - set @email to student's email address  */
INSERT INTO COMPLETION (ACC_EMAIL, REQ_ID, COM_SCORE) VALUES(@email, "1", "100");
INSERT INTO COMPLETION (ACC_EMAIL, REQ_ID, COM_SCORE) VALUES(@email, "2", "72");
INSERT INTO COMPLETION (ACC_EMAIL, REQ_ID, COM_SCORE) VALUES(@email, "3", "85");

CREATE VIEW VIEW_CLASS_COURSES AS (
SELECT CLASS.CLS_ID, COURSE.CRS_ID, COURSE.CRS_CHAP, COURSE.CRS_NAME
  FROM REQUIREMENT
  LEFT JOIN CLASS ON CLASS.CLS_ID = REQUIREMENT.CLS_ID
  LEFT JOIN COURSE ON COURSE.CRS_ID = REQUIREMENT.CRS_ID
  ORDER BY CLASS.CLS_ID, COURSE.CRS_ID, COURSE.CRS_CHAP);

CREATE VIEW VIEW_ENROLLMENTS AS (
SELECT ACCOUNT.ACC_FNAME AS STU_FNAME, ACCOUNT.ACC_LNAME AS STU_LNAME, ACCOUNT.ACC_EMAIL AS STU_EMAIL, ENROLLMENT.CLS_ID
  FROM ENROLLMENT
  LEFT JOIN ACCOUNT ON ACCOUNT.ACC_EMAIL = ENROLLMENT.ACC_EMAIL
  ORDER BY ACCOUNT.ACC_LNAME);