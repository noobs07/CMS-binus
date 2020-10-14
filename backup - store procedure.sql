CREATE PROCEDURE dbo.courseLObj2LO_Create
  @COURSE_CODE VARCHAR(18),
  @courseLObjUUID uniqueidentifier,
  @user_id  VARCHAR(6)
AS 
BEGIN
  SET NOCOUNT ON; 

    INSERT INTO courseLObj2LO (stsrc, userIn, CRSE_CODE, courseLObjID, courseOutlineLearningOutcomeID, courseOutlineID) 
    SELECT  'I', @user_id, @COURSE_CODE, (SELECT courseLObjID FROM courseLObj WHERE id = @courseLObjUUID), lo.courseOutlineLearningOutcomeID, lo.courseOutlineID
    FROM    CMS_DB.dbo.courseOutlineLearningOutcome lo
    WHERE   lo.courseOutlineID IN (select CAST(cc.CRSE_ID as int) from ORACLE.dbo.PS_N_COURSE_CODE cc where cc.CRSE_CODE = @COURSE_CODE) 
            AND lo.stsrc NOT IN ('D')
    ORDER BY lo.priority ASC;
END
GO

CREATE PROCEDURE dbo.courseLO_getFromCourseCode
  @COURSE_CODE VARCHAR(18)
AS 
BEGIN
    SET NOCOUNT ON; 

    SELECT  lo.courseOutlineLearningOutcomeID, lo.courseOutlineLearningOutcome, lo.courseOutlineID, lo.priority, lo.KeywordID
    FROM    CMS_DB.dbo.courseOutlineLearningOutcome lo
    WHERE   lo.courseOutlineID IN (select CAST(cc.CRSE_ID as int) from ORACLE.dbo.PS_N_COURSE_CODE cc where cc.CRSE_CODE = @COURSE_CODE) 
            AND lo.stsrc NOT IN ('D')
    ORDER BY lo.priority ASC;
END
GO