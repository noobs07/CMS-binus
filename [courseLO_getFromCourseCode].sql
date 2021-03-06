USE [CMS_DB_02102020]
GO
/****** Object:  StoredProcedure [dbo].[courseLO_getFromCourseCode]    Script Date: 10/12/2020 3:51:17 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[courseLO_getFromCourseCode]
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
