CREATE TABLE CMS_DB.dbo.courseLObj (
  Stsrc char(1) NOT NULL,
  UserIn varchar(100) NOT NULL,
  DateIn datetime NOT NULL,
  UserUp varchar(100) NULL,
  DateUp datetime NULL,
  id uniqueidentifier NOT NULL,
  statusStudentOutcomeId uniqueidentifier NOT NULL,
  descIN varchar(max) NOT NULL,
  descEN varchar(max) NOT NULL,
  code varchar(50) NOT NULL,
  bloomTaxonomyId uniqueidentifier NULL,
  bloomTaxonomyName varchar(max) NULL,
  bloomTaxonomyDesc varchar(max) NULL,
  bloomTaxonomyCode varchar(max) NULL,
  bloomTaxonomyKeyword varchar(100) NULL,
  bloomTaxonomyLevel int NULL,
  CRSE_CODE varchar(50) NULL,
  CONSTRAINT PK_new_courseLObj_statusStudentOutcomeId PRIMARY KEY CLUSTERED (id)
)
ON [PRIMARY]
TEXTIMAGE_ON [PRIMARY]
GO

CREATE INDEX IDX_new_courseLObj_statusStudentOutcomeId
  ON CMS_DB.dbo.courseLObj (statusStudentOutcomeId)
  ON [PRIMARY]
GO

CREATE INDEX IDX_new_courseStudentOutcome_CRSE_CODE
  ON CMS_DB.dbo.courseLObj (code)
  ON [PRIMARY]
GO

ALTER TABLE CMS_DB.dbo.courseLObj
  ADD CONSTRAINT FK_new_courseLObj_statusStudentOutcomeId FOREIGN KEY (statusStudentOutcomeId) REFERENCES dbo.new_courseStudentOutcome (statusStudentOutcomeId)
GO


CREATE TABLE CMS_DB.dbo.courseLObj2LO (
  Stsrc char(1) NOT NULL,
  UserIn varchar(100) NOT NULL,
  DateIn datetime NOT NULL,
  UserUp varchar(100) NULL,
  DateUp datetime NULL,
  courseLObj2LOId uniqueidentifier NOT NULL,
  CRSE_CODE varchar(50) NULL,
  courseLObjID uniqueidentifier NULL,
  courseOutlineLearningOutcomeID int NULL,
  courseOutlineID int NULL,
  weightLO int NULL,
  CONSTRAINT PK_courseLObj2LO_id PRIMARY KEY CLUSTERED (courseLObj2LOId)
)
ON [PRIMARY]
GO


CREATE TABLE CMS_DB.dbo.courseStudentOutcome (
  Stsrc char(1) NOT NULL,
  UserIn varchar(100) NOT NULL,
  DateIn datetime NOT NULL,
  UserUp varchar(100) NULL,
  DateUp datetime NULL,
  statusStudentOutcomeId uniqueidentifier NOT NULL,
  statusStudentOutcomePM bit NOT NULL,
  statusStudentOutcomeNameIN varchar(max) NOT NULL,
  statusStudentOutcomeNameEN varchar(max) NOT NULL,
  CRSE_CODE varchar(50) NOT NULL,
  CONSTRAINT PK_courseStudentOutcome_CurriculumMappingStudentOutcomeID PRIMARY KEY CLUSTERED (statusStudentOutcomeId)
)
ON [PRIMARY]
TEXTIMAGE_ON [PRIMARY]
GO

CREATE INDEX IDX_new_courseStudentOutcome_CRSE_CODE
  ON CMS_DB.dbo.courseStudentOutcome (CRSE_CODE)
  ON [PRIMARY]
GO


