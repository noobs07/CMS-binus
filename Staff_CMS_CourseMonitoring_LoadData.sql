-- =============================================  
-- Author:        Adit  
-- Create date: 28/10/2014  
-- Description:   load course monitoring  
  
-- Author:        Harris  
-- Alter date: 19/03/2015  
-- Description:   perbaikan untuk centangan finalize  
  
-- Modified by : Hengky  
-- Date : 11 Feb 2017  
-- Description : optimize query oracle  
  
-- Staff_CMS_CourseMonitoring_LoadData 'OS1','371','1422'  
-- =============================================  
CREATE PROCEDURE dbo.Staff_CMS_CourseMonitoring_LoadData   
      @ACAD_CAREER VARCHAR(4),  
      @ATTR_VALUE VARCHAR(30),  
   @strm  varchar(4)  
AS  
BEGIN  
  
--DECLARE  
--@ACAD_CAREER VARCHAR(4),  
--@ATTR_VALUE VARCHAR(10),  
--@Page int ,    
--@MaxPage int,   
--@strm  varchar(4)  
--SELECT  
--@ACAD_CAREER = 'RS1',  
--@ATTR_VALUE = '51',  
--@Page = 1,    
--@MaxPage = 10,   
--@strm = '1410'  
        
      -- SET NOCOUNT ON added to prevent extra result sets from  
      -- interfering with SELECT statements.  
      SET NOCOUNT ON;  
  
       DECLARE @COURSEMONITORINGTEMP TABLE (  
            CRSE_ID VARCHAR(8),      
            DESCR VARCHAR(200),  
            KDMTK VARCHAR(30),  
            SKST VARCHAR(10),  
            SKSP VARCHAR(10)    
      )  
  
      DECLARE @Query VARCHAR(MAX) =   
      '  
      SELECT *  
      FROM OPENQUERY(ORACLE238,''SELECT  
            distinct b.crse_id, b.course_title_long as descr,   
   CASE WHEN LENGTH(  
   c.SUBJECT||TRIM(c.CATALOG_NBR))=8 THEN    
   c.SUBJECT||TRIM(c.CATALOG_NBR) ELSE c.SUBJECT||SUBSTR(''''0000''''||TRIM(c.CATALOG_NBR),   
   -(5-LENGTH(c.SUBJECT)), 5-LENGTH(c.SUBJECT)) END AS Kode_MK,   
            COALESCE(D.N_SKST,''''-'''') as SKST,   
            COALESCE(D.N_SKSP,''''-'''') as SKSP  
            FROM PS_CRSE_CATALOG B   
            JOIN ps_crse_offer c  
                  on b.crse_id = c.crse_ID  
                  and c.course_approved = ''''A''''  
                  /* and b.acad_career = c.acad_career*/  
                  AND B.EFFDT = C.EFFDT  
                  AND B.EFF_STATUS = ''''A''''  
                  AND B.EFFDT = (SELECT MAX(EFFDT) FROM PS_CRSE_CATALOG  
                  WHERE B.CRSE_ID = CRSE_ID AND EFFDT <= SYSDATE)             JOIN PS_N_CRSE_DTL A ON c.INSTITUTION = A.INSTITUTION AND c.CRSE_ID = A.CRSE_ID AND c.EFFDT = A.EFFDT AND c.CRSE_OFFER_NBR = A.CRSE_OFFER_NBR              JOIN PS_N_COURSE_CODE 
D                   ON c.CRSE_ID = D.CRSE_ID  
            WHERE c.ACAD_CAREER = ''''' + @ACAD_CAREER + '''''  
            AND A.N_CRSE_ATTR_SFS = ''''' + @ATTR_VALUE + '''''  
   '')'  
     
    INSERT INTO @COURSEMONITORINGTEMP  
    EXEC sp_sqlexec @Query  
  
   --SELECT distinct RowNum = IDENTITY(INT, 1, 1), *  
   --INTO #RESULT  
   --FROM #COURSEMONITORINGTEMP  
        
   DECLARE @coursEOutlineID TABLE  
   (  
       courseOutlineID INT,   
       STRM VARCHAR(6),  
       ACAD_CAREER VARCHAR(6),   
       CRSE_ID VARCHAR(6)  
   )  
  
   INSERT INTO @courseOutlineID   
   SELECT z.courseOUtlineID, z.STRM, z.ACAD_CAREER, z.CRSE_ID  
   FROm LMS_CONTENT..courseOutline z WITH(NOLOCK)  
   LEFT JOIN @COURSEMONITORINGTEMP x  
   on z.crse_id = x.crse_id  
   WHERE z.acad_career = @ACAD_CAREER  
          and z.strm = @strm  
          AND z.stsrc <> 'D'  
  
   --SELECT * FROM @coursEOutlineID  
  
      SELECT distinct a.*, b.courseOutlineID, CASE WHEN   
       c.courseOutlineID IS NULL  
       THEN 0  
       ELSE 1  
       END   
       AS isFinal  
      FROM @COURSEMONITORINGTEMP a  
      LEFT JOIN courseOutline b WITH(NOLOCK)  
      on a.crse_id = b.crse_id  
          and b.acad_career = @ACAD_CAREER  
          and b.strm = @strm  
          AND b.stsrc <> 'D'  
   LEFT JOIN @courseOutlineID C  
   /*on b.courseOutlineID = c.courseOutlineID*/  
   ON B.CRSE_ID = C.CRSE_ID  
       AND b.ACAD_CAREER = C.ACAD_CAREER  
       AND b.STRM = C.STRM  
  
      --SELECT     
      --    TOP (@Page * @Maxpage) *,  
      --    (SELECT COUNT (CRSE_ID) FROM #RESULT) as Total    
      --FROM #RESULT    
      --WHERE    
      --    RowNum between (((@Page - 1) * @MaxPage) + 1) AND (@Page * @Maxpage)    
  
--DROP TABLE #RESULT  
END  