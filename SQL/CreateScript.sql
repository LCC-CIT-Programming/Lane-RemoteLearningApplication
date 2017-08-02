DROP TABLE IF EXISTS `CITLabMonitor`.`Resolution` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Question` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Schedule` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`TutorExpertise` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`StudentRegistration` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Tutor` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Task` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Visit` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Section` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Term` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Course` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Location` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Instructor` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Student` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`Major` ;
DROP TABLE IF EXISTS `CITLabMonitor`.`AppUser` ;
DROP VIEW IF EXISTS `CITLabMonitor`.`onlinetutors`;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


CREATE SCHEMA IF NOT EXISTS `CITLabMonitor` DEFAULT CHARACTER SET utf8 ;
USE `CITLabMonitor` ;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Major`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Major` (
  `MajorId` INT NOT NULL AUTO_INCREMENT,
  `MajorName` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`MajorId`),
  UNIQUE INDEX `MajorName_UNIQUE` (`MajorName` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`AppUser`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`AppUser` (
  `UserID` INT NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(45) NULL DEFAULT NULL,
  `LastName` VARCHAR(45) NULL DEFAULT NULL,
  `LNumber` VARCHAR(9) NULL DEFAULT NULL,
  `Password` VARCHAR(16) NULL DEFAULT NULL,
  `EmailAddress` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`UserID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Student` (
  `MajorId` INT NOT NULL,
  `UserID` INT NOT NULL,
  PRIMARY KEY (`UserID`),
  INDEX `Student_Major_FK_idx` (`MajorId` ASC),
  INDEX `fk_Student_AppUser1_idx` (`UserID` ASC),
  CONSTRAINT `Student_Major_FK`
    FOREIGN KEY (`MajorId`)
    REFERENCES `CITLabMonitor`.`Major` (`MajorId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Student_AppUser1`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`AppUser` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Instructor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Instructor` (
  `UserID` INT NOT NULL,
  PRIMARY KEY (`UserID`),
  INDEX `fk_Instructor_AppUser1_idx` (`UserID` ASC),
  CONSTRAINT `fk_Instructor_AppUser1`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`AppUser` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Course` (
  `CourseNumber` VARCHAR(10) NOT NULL,
  `CourseName` VARCHAR(50) NOT NULL,
  `LeadInstructorId` INT NOT NULL,
  PRIMARY KEY (`CourseNumber`),
  UNIQUE INDEX `CourseName_UNIQUE` (`CourseName` ASC),
  INDEX `Course_Instructor_FK_idx` (`LeadInstructorId` ASC),
  CONSTRAINT `Course_Instructor_FK`
    FOREIGN KEY (`LeadInstructorId`)
    REFERENCES `CITLabMonitor`.`Instructor` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Term`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Term` (
  `TermId` INT NOT NULL,
  `TermName` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`TermId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Section`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Section` (
  `SectionNumber` VARCHAR(10) NOT NULL,
  `Year` INT NOT NULL,
  `TermId` INT NOT NULL,
  `CourseNumber` VARCHAR(10) NOT NULL,
  `UserID` INT NOT NULL,
  INDEX `fk_Section_Term1_idx` (`TermId` ASC),
  PRIMARY KEY (`SectionNumber`),
  INDEX `fk_Section_Course1_idx` (`CourseNumber` ASC),
  INDEX `fk_Section_Instructor_idx` (`UserID` ASC),
  CONSTRAINT `fk_Section_Term1`
    FOREIGN KEY (`TermId`)
    REFERENCES `CITLabMonitor`.`Term` (`TermId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Section_Course1`
    FOREIGN KEY (`CourseNumber`)
    REFERENCES `CITLabMonitor`.`Course` (`CourseNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Section_Instructor`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`Instructor` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`StudentRegistration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`StudentRegistration` (
  `UserID` INT NOT NULL,
  `SectionNumber` VARCHAR(10) NOT NULL)
  /*INDEX `StudentRegistration_Section_FK_idx` (`SectionNumber` ASC),
  CONSTRAINT `StudentRegistration_Student_FK`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`Student` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `StudentRegistration_Section_FK`
    FOREIGN KEY (`SectionNumber`)
    REFERENCES `CITLabMonitor`.`Section` (`SectionNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
	*/
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Location` (
  `LocationId` INT NOT NULL AUTO_INCREMENT,
  `LocationName` VARCHAR(50) NOT NULL,
  `StationId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`LocationId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Visit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Visit` (
  `VisitId` INT NOT NULL AUTO_INCREMENT,
  `StartTime` DATETIME NOT NULL,
  `EndTime` DATETIME NULL DEFAULT NULL,
  `UserID` INT NOT NULL,
  `LocationId` INT NOT NULL,
  `Role` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`VisitId`),
  INDEX `Visit_User_FK_idx` (`UserID` ASC),
  INDEX `Visit_Location_FK_idx` (`LocationId` ASC),
  CONSTRAINT `Visit_User_FK`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`AppUser` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Visit_Location_FK`
    FOREIGN KEY (`LocationId`)
    REFERENCES `CITLabMonitor`.`Location` (`LocationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Task` (
  `TaskId` INT NOT NULL AUTO_INCREMENT,
  `VisitId` INT NOT NULL,
  `CourseNumber` VARCHAR(10) NULL DEFAULT NULL,
  `StartTime` DATETIME NOT NULL,
  `EndTime` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`TaskId`),
  INDEX `Task_Visit_FK_idx` (`VisitId` ASC),
  INDEX `Task_Section_FK_idx` (`CourseNumber` ASC),
  CONSTRAINT `Task_Visit_FK`
    FOREIGN KEY (`VisitId`)
    REFERENCES `CITLabMonitor`.`Visit` (`VisitId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Task_Section_FK`
    FOREIGN KEY (`CourseNumber`)
    REFERENCES `CITLabMonitor`.`Section` (`CourseNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Tutor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Tutor` (
  `UserID` INT NOT NULL,
  `TutorBio` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  INDEX `fk_Tutor_AppUser1_idx1` (`UserID` ASC),
  CONSTRAINT `fk_Tutor_AppUser1`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`AppUser` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`TutorExpertise`
-- -----------------------------------------------------
/*
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`TutorExpertise` (
  `TutorExpertiseID` INT NOT NULL AUTO_INCREMENT,
  `Course_CourseNumber` VARCHAR(10) NOT NULL,
  `UserID` INT NOT NULL,
  PRIMARY KEY (`TutorExpertiseID`),
  INDEX `fk_TutorExpertise_Course1_idx` (`Course_CourseNumber` ASC),
  INDEX `fk_TutorExpertise_Tutor1_idx` (`UserID` ASC),
  CONSTRAINT `fk_TutorExpertise_Course1`
    FOREIGN KEY (`Course_CourseNumber`)
    REFERENCES `CITLabMonitor`.`Course` (`CourseNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TutorExpertise_Tutor1`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`Tutor` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Schedule` (
  `ScheduleID` INT NOT NULL AUTO_INCREMENT,
  `UserID` INT NOT NULL,
  `StartTime` DATETIME NOT NULL,
  `EndTime` DATETIME NOT NULL,
  `WeekDay` INT NOT NULL,
   PRIMARY KEY(`ScheduleID`),
  INDEX `fk_Schedule_Tutor1_idx` (`UserID` ASC),
  CONSTRAINT `fk_Schedule_Tutor1`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`Tutor` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Question` (
  `QuestionID` INT NOT NULL AUTO_INCREMENT,
  `UserID` INT NOT NULL,
  `Subject` VARCHAR(45) NULL,
  `Description` VARCHAR(300) NULL DEFAULT NULL,
  `Status` VARCHAR(20) NULL DEFAULT NULL,
  `AskTime` DATETIME NULL DEFAULT NULL,
  `OpenTime` DATETIME NULL DEFAULT NULL,
  `CloseTime` DATETIME NULL DEFAULT NULL,
  `CourseNumber` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`QuestionID`),
  INDEX `fk_Question_Student1_idx` (`UserID` ASC),
  INDEX `fk_Question_Course1_idx` (`CourseNumber` ASC),
  CONSTRAINT `fk_Question_Student1`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`Student` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Question_Course1`
    FOREIGN KEY (`CourseNumber`)
    REFERENCES `CITLabMonitor`.`Course` (`CourseNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITLabMonitor`.`Resolution`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CITLabMonitor`.`Resolution` (
  `QuestionId` INT NOT NULL,
  `UserID` INT NOT NULL,
  `Resolution` VARCHAR(512) NULL,
  INDEX `fk_Resolution_Question1_idx` (`QuestionId` ASC),
  INDEX `fk_Resolution_Tutor_idx` (`UserID` ASC),
  CONSTRAINT `fk_Resolution_Question1`
    FOREIGN KEY (`QuestionId`)
    REFERENCES `CITLabMonitor`.`Question` (`QuestionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Resolution_Tutor`
    FOREIGN KEY (`UserID`)
    REFERENCES `CITLabMonitor`.`Tutor` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- View `CITLabMonitor`.`onlinetutors`
-- -----------------------------------------------------
CREATE VIEW onlinetutors AS
SELECT UserID
FROM visit
WHERE EndTime IS NULL
AND (Role = 'Tutor' OR Role = 'Faculty');
-- AND UserID IN (SELECT UserID FROM tutor);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
