/*
    Author      : MZA
    Description : Get Base Course by Course ID
    Date        : Jan 2021
*/

CREATE procEDURE dbo.CMS_GET_BaseCourseByCourseID
   @CRSE_ID VARCHAR(20)
AS
BEGIN
  SET NOCOUNT ON;
  
  SELECT  TOP 1 INSTITUTION, ACAD_CAREER, CRSE_ID, CRSE_CODE, CRSE_TTL_LONG_I, COURSE_TITLE_LONG, N_SKST, N_SKSP
	FROM    ORACLE.dbo.PS_N_COURSE_CODE WITH(NOLOCK)
	WHERE   CRSE_ID = @CRSE_ID OR CRSE_CODE = @CRSE_ID;

END 
GO


/*
    Author      : MZA
    Description : Get Course Learning Object
    Date        : Jan 2021
*/

CREATE procEDURE dbo.CMS_GET_CourseLObj
    @in_statusSOId VARCHAR(36) = NULL,
    @in_CRSE_CODE VARCHAR(20) = NULL
AS
BEGIN
  SET NOCOUNT ON;

  DECLARE @sql NVARCHAR(MAX),
          @check TINYINT;

  SET @check = 0;
  
  SET @sql = N'SELECT id, id as courseLObjId, code, descIN, descEN, teachAndLearnStrategyName, assessmentPlan, weight, isXX FROM courseLObj ';
	
  IF(@in_statusSOId IS NOT NULL OR LEN(@in_statusSOId) = 36)
  BEGIN
      SET @sql   = @sql + ' WHERE statusSOId = CAST(@statusStudentOutcomeId as uniqueidentifier) ';
      SET @check = 1;  
  END;

  IF(@in_CRSE_CODE IS NOT NULL)
  BEGIN
      IF(@check = 1)
      BEGIN
          SET @sql = @sql + ' AND CRSE_CODE =  @CRSE_CODE '; 
      END
      ELSE
      BEGIN
          SET @sql = @sql + ' WHERE CRSE_CODE =  @CRSE_CODE ';
      END;
  END;
  
  SET @sql = @sql + ' ORDER BY code ASC';
  EXEC sp_executesql @sql, N'@statusStudentOutcomeId uniqueidentifier, @CRSE_CODE VARCHAR(50)', @statusStudentOutcomeId = @in_statusSOId, @CRSE_CODE = @in_CRSE_CODE ;

END 
GO


/*
    Author      : MZA
    Description : Get Course Learning Object to Learning Outcomes
    Date        : Jan 2021
*/

CREATE procEDURE dbo.CMS_GET_CourseLObj2LO
    @CRSE_CODE VARCHAR(20) = NULL
AS
BEGIN
  SET NOCOUNT ON;

  SELECT  lo.courseLObj2LOId, lobj.id as courseLObjID, lobj.code, lobj.descIN, lobj.descEN, lobj.teachAndLearnStrategyName, lobj.assessmentPlan, lobj.weight, lobj.isXX,
          lo.courseOutlineLearningOutcomeID, lo.weightLO, ol.courseOutlineLearningOutcome, ol.priority
  FROM    courseLObj as lobj WITH(NOLOCK)
	JOIN    courseLObj2LO as lo WITH(NOLOCK) ON lobj.id = lo.courseLObjID
	JOIN    courseOutlineLearningOutcome ol WITH(NOLOCK) ON lo.courseOutlineLearningOutcomeID = ol.courseOutlineLearningOutcomeID
	WHERE   lobj.CRSE_CODE = @CRSE_CODE
	ORDER BY  lobj.code ASC, ol.priority ASC, ol.courseOutlineLearningOutcomeID ASC;

END 
GO


/*
    Author      : MZA
    Description : Insert Data to courseStudentOutcome table
    Date        : Jan 2021
*/

CREATE PROCEDURE dbo.CMS_UPD_StudentLearningOutcome
  @sql NVARCHAR(MAX) = NULL
AS 
BEGIN
    SET NOCOUNT ON; 

    BEGIN TRANSACTION [Trans_update_SLO]

    BEGIN TRY
  
        EXEC sp_executesql @sql;
         
        COMMIT TRANSACTION [Trans_update_SLO];
        SELECT 1 as status;
    END TRY
  
    BEGIN CATCH
        ROLLBACK TRANSACTION [Trans_update_SLO];
        SELECT 0 as status;
    END CATCH  
END
GO


/*
    Author      : MZA
    Description : Insert Data to courseStudentOutcome table
    Date        : Jan 2021
*/

CREATE PROCEDURE dbo.CMS_INS_CourseStudentOutcome
  @insert_main NVARCHAR(MAX) = NULL,
  @insert_detail NVARCHAR(MAX) = NULL
AS 
BEGIN
    SET NOCOUNT ON; 

    BEGIN TRANSACTION [Trans_insert_CSO]

    BEGIN TRY
  
        EXEC sp_executesql @insert_main;
        EXEC sp_executesql @insert_detail;
         
        COMMIT TRANSACTION [Trans_insert_CSO];
        SELECT  1 as status, 
                'Data berhasil disimpan' as msg,
                null AS ErrorNumber,  
                null AS ErrorSeverity,  
                null AS ErrorState,  
                null AS ErrorProcedure,  
                null AS ErrorLine;
    END TRY
  
    BEGIN CATCH
        ROLLBACK TRANSACTION [Trans_insert_CSO];
        SELECT  0 AS status, 
                ERROR_MESSAGE() AS msg,
                ERROR_NUMBER() AS ErrorNumber,  
                ERROR_SEVERITY() AS ErrorSeverity,  
                ERROR_STATE() AS ErrorState,  
                ERROR_PROCEDURE() AS ErrorProcedure,  
                ERROR_LINE() AS ErrorLine;
    END CATCH  
END
GO


/*
    Author      : MZA
    Description : Insert Data to courseLObj2LO table
    Date        : Nov 2020
*/

CREATE PROCEDURE dbo.CMS_INS_CourseLObj2LO
  @COURSE_ID VARCHAR(6),
  @COURSE_CODE VARCHAR(50),
  @courseLObjID VARCHAR(36),
  @user_id  VARCHAR(6)
AS 
BEGIN
  SET NOCOUNT ON; 

    BEGIN TRANSACTION [Trans_insert_CLObj2LO]

    BEGIN TRY
  
        /*INSERT INTO courseLObj2LO (courseLObj2LOId, stsrc, userIn, DateIn, CSRE_ID, CRSE_CODE, courseLObjID, courseOutlineLearningOutcomeID, courseOutlineID) 
        SELECT  NEWID(), 'I', @user_id, GETDATE(), @COURSE_ID, @COURSE_CODE, CAST(@courseLObjID as UNIQUEIDENTIFIER), lo.courseOutlineLearningOutcomeID, lo.courseOutlineID
        FROM    CMS_DB.dbo.courseOutlineLearningOutcome lo
        WHERE   lo.courseOutlineLearningOutcomeID IN (select CAST(cc.CRSE_ID as int) from ORACLE.dbo.PS_N_COURSE_CODE cc where cc.CRSE_CODE = @COURSE_CODE) 
                -- lo.courseOutlineID IN (select CAST(cc.CRSE_ID as int) from ORACLE.dbo.PS_N_COURSE_CODE cc where cc.CRSE_CODE = @COURSE_CODE) 
                AND lo.stsrc NOT IN ('D')
        ORDER BY lo.priority ASC;*/

        INSERT INTO courseLObj2LO (courseLObj2LOId, stsrc, userIn, DateIn, CRSE_ID, CRSE_CODE, courseLObjID, courseOutlineLearningOutcomeID, courseOutlineID) 
        SELECT  NEWID(), 'I', @user_id, GETDATE(), @COURSE_ID, @COURSE_CODE, CAST(@courseLObjID as UNIQUEIDENTIFIER), lo.courseOutlineLearningOutcomeID, lo.courseOutlineID
        FROM    CMS_DB.dbo.courseOutlineLearningOutcome lo
        JOIN    CMS_DB.dbo.courseOutline o ON lo.courseOutlineID = o.courseOutlineID
        WHERE   o.CRSE_ID = @COURSE_ID      
                AND lo.stsrc NOT IN ('D')
        ORDER BY lo.priority ASC;

         
        COMMIT TRANSACTION [Trans_insert_CLObj2LO];
        SELECT  1 as status, 
                'Data berhasil disimpan' as msg,
                null AS ErrorNumber,  
                null AS ErrorSeverity,  
                null AS ErrorState,  
                null AS ErrorProcedure,  
                null AS ErrorLine;
    END TRY
  
    BEGIN CATCH
        ROLLBACK TRANSACTION [Trans_insert_CLObj2LO];
        SELECT  0 AS status, 
                ERROR_MESSAGE() AS msg,
                ERROR_NUMBER() AS ErrorNumber,  
                ERROR_SEVERITY() AS ErrorSeverity,  
                ERROR_STATE() AS ErrorState,  
                ERROR_PROCEDURE() AS ErrorProcedure,  
                ERROR_LINE() AS ErrorLine;
    END CATCH  
END
GO


/*
    Author      : MZA
    Description : Get Base Course by Course ID
    Date        : Nov 2020
    Last Update : 3 Feb 2021
*/

CREATE procEDURE dbo.CMS_GET_CourseStudentOutcomeByCourseCode
   @CRSE_CODE VARCHAR(20)
AS
BEGIN
  SET NOCOUNT ON;
  
  SELECT  -- statusStudentOutcomeId, statusStudentOutcomePM, statusStudentOutcomeNameIN, statusStudentOutcomeNameEN
          statusSOId, statusSONameIN, statusSONameEN, descIN, descEN, code
	FROM    courseStudentOutcome WITH(NOLOCK)
  WHERE   CRSE_CODE = @CRSE_CODE;

END 
GO


/*
    Author      : MZA
    Description : Get Course LO from Base Course Code
    Date        : Nov 2020
*/

CREATE PROCEDURE dbo.CMS_GET_CourseLOByCourseCode
  @COURSE_CODE VARCHAR(18)
AS 
BEGIN
    SET NOCOUNT ON; 

    SELECT  lo.courseOutlineLearningOutcomeID, lo.courseOutlineLearningOutcome, lo.courseOutlineID, lo.priority, lo.KeywordID
    FROM    CMS_DB.dbo.courseOutlineLearningOutcome lo  WITH(NOLOCK)
    WHERE   lo.courseOutlineID IN (select CAST(cc.CRSE_ID as int) from ORACLE.dbo.PS_N_COURSE_CODE cc where cc.CRSE_CODE = @COURSE_CODE) 
            AND lo.stsrc NOT IN ('D')
    ORDER BY lo.priority ASC;
END
GO