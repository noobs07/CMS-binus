CREATE TABLE CMS_DB.dbo.courseLObj (
  Stsrc char(1) NOT NULL,
  UserIn varchar(100) NOT NULL,
  DateIn datetime NOT NULL,
  UserUp varchar(100) NULL,
  DateUp datetime NULL,
  id uniqueidentifier NOT NULL,
  code varchar(20) NOT NULL,
  descIN varchar(max) NOT NULL,
  descEN varchar(max) NOT NULL,
  teachAndLearnStrategyName varchar(max) NULL,
  assessmentPlan varchar(max) NULL,
  weight int NOT NULL CONSTRAINT DF_courseLObj_weight DEFAULT (0),
  isXX tinyint NOT NULL CONSTRAINT DF_courseLObj_isXX DEFAULT (0),
  courseSOId uniqueidentifier NULL,
  statusSOId uniqueidentifier NULL,
  CRSE_CODE varchar(50) NULL,
  CONSTRAINT PK_new_courseLObj_statusStudentOutcomeId PRIMARY KEY CLUSTERED (id)
)
ON [PRIMARY]
TEXTIMAGE_ON [PRIMARY]
GO

CREATE INDEX IDX_courseLObj_courseSOId
  ON CMS_DB.dbo.courseLObj (courseSOId)
  ON [PRIMARY]
GO

CREATE INDEX IDX_courseLObj_CRSE_CODE
  ON CMS_DB.dbo.courseLObj (CRSE_CODE)
  ON [PRIMARY]
GO

CREATE INDEX IDX_courseLObj_statusSOId
  ON CMS_DB.dbo.courseLObj (statusSOId)
  ON [PRIMARY]
GO

CREATE INDEX IDX_new_courseLObj_statusStudentOutcomeId
  ON CMS_DB.dbo.courseLObj (code)
  ON [PRIMARY]
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

CREATE INDEX IDX_courseLObj2LO_courseLObjID
  ON CMS_DB.dbo.courseLObj2LO (courseLObjID)
  ON [PRIMARY]
GO

CREATE INDEX IDX_courseLObj2LO_courseOutlineID
  ON CMS_DB.dbo.courseLObj2LO (courseOutlineID)
  ON [PRIMARY]
GO

CREATE INDEX IDX_courseLObj2LO_courseOutlineLearningOutcomeID
  ON CMS_DB.dbo.courseLObj2LO (courseOutlineLearningOutcomeID)
  ON [PRIMARY]
GO

CREATE INDEX IDX_courseLObj2LO_CRSE_CODE
  ON CMS_DB.dbo.courseLObj2LO (CRSE_CODE)
  ON [PRIMARY]
GO


CREATE TABLE CMS_DB.dbo.courseOutlineLearningOutcome (
  stsrc char(10) NOT NULL,
  userIn varchar(50) NOT NULL,
  dateIn datetime NOT NULL,
  userUp varchar(50) NULL,
  dateUp datetime NULL,
  courseOutlineLearningOutcomeID int NOT NULL,
  courseOutlineLearningOutcome varchar(max) NULL,
  courseOutlineID int NOT NULL,
  courseCatalogLearningOutcomeID int NULL,
  OldLOId int NULL,
  priority char(2) NULL,
  KeywordID char(3) NULL,
  CONSTRAINT PK__courseOu__D8E15D717A9854DD PRIMARY KEY CLUSTERED (courseOutlineLearningOutcomeID)
)
ON [PRIMARY]
TEXTIMAGE_ON [PRIMARY]
GO

CREATE INDEX IDX_courseOutlineLearningOutcome_courseCatalogLearningOutcomeID
  ON CMS_DB.dbo.courseOutlineLearningOutcome (courseCatalogLearningOutcomeID)
  ON [PRIMARY]
GO

CREATE INDEX IDX_courseOutlineLearningOutcome_courseOutlineID
  ON CMS_DB.dbo.courseOutlineLearningOutcome (courseOutlineID)
  ON [PRIMARY]
GO

EXEC sys.sp_addextendedproperty N'MS_Description'
                               ,'MZA, 2020 :'
                               ,'SCHEMA'
                               ,N'dbo'
                               ,'TABLE'
                               ,N'courseOutlineLearningOutcome'
GO


CREATE TABLE CMS_DB.dbo.courseStudentOutcome (
  Stsrc char(1) NOT NULL,
  UserIn varchar(100) NOT NULL,
  DateIn datetime NOT NULL DEFAULT (getdate()),
  UserUp varchar(100) NULL,
  DateUp datetime NULL,
  id uniqueidentifier NOT NULL,
  statusSOId uniqueidentifier NOT NULL,
  statusSONameIN varchar(max) NOT NULL,
  statusSONameEN varchar(max) NOT NULL,
  CRSE_CODE varchar(50) NOT NULL,
  descIN varchar(max) NULL,
  descEN varchar(max) NULL,
  code varchar(50) NULL,
  CONSTRAINT PK_courseStudentOutcome PRIMARY KEY CLUSTERED (id)
)
ON [PRIMARY]
TEXTIMAGE_ON [PRIMARY]
GO

CREATE INDEX IDX_courseStudentOutcome_code
  ON CMS_DB.dbo.courseStudentOutcome (code)
  ON [PRIMARY]
GO

CREATE INDEX IDX_courseStudentOutcome_statusSOId
  ON CMS_DB.dbo.courseStudentOutcome (statusSOId)
  ON [PRIMARY]
GO

CREATE INDEX IDX_new_courseStudentOutcome_CRSE_CODE
  ON CMS_DB.dbo.courseStudentOutcome (CRSE_CODE)
  ON [PRIMARY]
GO