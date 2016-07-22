<?php
require_once('base.class.php');

class newsArticle extends base 
{
    var $tableName = 'news_articles';
    var $keyField = 'article_id';
    var $searchableFields = array('article_content', 'article_title', 'article_author');
    var $reportResultsPerPage = 1; 

    function __construct($resultsPerPage = 1) 
    {
        $this->connectToDB();
        $this->reportResultsPerPage = $resultsPerPage;
    }

    function exportData($filename) 
    {
        $file = fopen($filename, "w");

        $newsList = $this->loadAllArticles();

        $headerExported = false;

        while ($row = $newsList->fetch(PDO::FETCH_ASSOC))
        {
            if (!$headerExported)
            {
                fputcsv($file, array_keys($row));
                $headerExported = true;
            }
            $row['article_content'] = str_replace("\r\n", "", $row['article_content']);
            fputcsv($file, $row);
        }

        fclose($file);
    }

    function importData($filename) 
    {
        $file = fopen($filename, "r");

        $headerImported = false;

        while (!feof($file))
        {
            if (!$headerImported)
            {
                $headerArray = fgetcsv($file);
                $headerImported = true;
            }
            else
            {
                $dataArray = fgetcsv($file);

                $rowArray = array();
                for ($i=0; $i < count($headerArray); $i++)
                { 
                    $rowArray[$headerArray[$i]] = $dataArray[$i];
                }

                $this->set($rowArray);
                $this->save();
            }
            
        }

        fclose($file);
    }

    function getReportData($reportFilters) 
    {
        $listSQL = "SELECT * FROM " . $this->tableName;
        $parameterList = array();
        $stmt = null;
        
        if (!empty($reportFilters) && is_array($reportFilters))
        {
            $filterPassed = false;
            
            if (isset($reportFilters['article_author_filter']) && !empty($reportFilters['article_author_filter'])) 
            {
                $listSQL .= " WHERE article_author LIKE ?";                               
                $parameterList[] = '%' . $reportFilters['article_author_filter'] . '%';
                $filterPassed = true;
            }            

            if (
                (isset($reportFilters['article_start_date_filter']) && !empty($reportFilters['article_start_date_filter'])) && 
                (isset($reportFilters['article_end_date_filter']) && !empty($reportFilters['article_end_date_filter'])) 
            )
            {
                $listSQL .= ($filterPassed ? " AND " : " WHERE ") . 
                    "article_date BETWEEN ? AND ?";                                
                $parameterList[] = $reportFilters['article_start_date_filter'];
                $parameterList[] = $reportFilters['article_end_date_filter'];
                $filterPassed = true;
            }         

            $listSQL .= " ORDER BY article_date DESC";
        
            if (isset($reportFilters['page']) && !empty($reportFilters['page'])) 
            {
                $listSQL .= " LIMIT " . ($this->reportResultsPerPage * ($reportFilters['page'] - 1)) . "," . $this->reportResultsPerPage;
                $filterPassed = true;
            }
            
            if ($filterPassed)
            {
                $stmt = $this->db->prepare($listSQL);
                $stmt->execute($parameterList);            
            }
        }
              
        return $stmt;
    }
    
    function sanitize($sanitizeData) 
    {
        foreach ($sanitizeData as $key => $value)
        {
            $sanitizeData[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        return $sanitizeData;
    }
    
    function validate()
    {
        $success = true;
        $validateData = $this->data;
        if ( !empty($validateData['article_id']) )
        {
            if (!preg_match("/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i", $validateData['article_id']))
            {
                $this->errors[] = 'Not a valid article id';
                $success = false;
            }
        }

        if ( empty($validateData['article_title']) )
        {
            $this->errors[] = 'Please enter an article title';
            $success = false;
        }
        else
        {
            if( strlen($validateData['article_title']) > 150 )
            {
                $this->errors[] = 'Please enter an article title with 150 characters or fewer';
                $success = false;
            }
        }

        if ( empty($validateData['article_date']) )
        {
            $this->errors[] = 'Please enter an article date';
            $success = false;
        }
        else
        {
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $validateData['article_date']))
            {
                try
                {
                    new DateTime($validateData['article_date']);
                }
                catch (Exception $e) {
                    $this->errors[] = 'Please enter a valid datetime';
                    $success = false;
                }
            }
            else
            {
                $this->errors[] = 'Please enter a valid datetime';
                $success = false;
            }
            
        }

        if ( empty($validateData['article_author']) )
        {
            $this->errors[] = 'Please enter an article author';
            $success = false;
        }
        else
        {
            if( strlen($validateData['article_author']) > 50 )
            {
                $this->errors[] = 'Please enter an article author with 50 characters or fewer';
                $success = false;
            }
        }

        if ( empty($validateData['article_content']) )
        {
            $this->errors[] = 'Please enter article content';
            $success = false;
        }
        else
        {
            if( strlen($validateData['article_content']) > 30000 )
            {
                $this->errors[] = 'Please enter article content that is 30,000 characters or fewer';
                $success = false;
            }
        }


        return $success;
    }

    public function downloadReport($reportFilters)
    {
        $reportData = $this->getReportData($reportFilters);
        
        if (isset($reportData))
        {
            $timestamp = date("YmdHis");
            
            header("Content-Type: text/csv");
            header('Content-Disposition: attachment; filename="' . $timestamp . '_news_articles.csv"');
            while($row = $reportData->fetch(PDO::FETCH_ASSOC)) 
            {
                echo implode(",", $row) . "\r\n";
            }
        }        
    }
    

    function loadAllArticles($search = null)
    {
        $loadQuery = "SELECT * FROM " . $this->tableName;
        $parameterList = array();
        if ( !is_null($search) && !empty($search))
        {
            $loadQuery .= " WHERE article_title LIKE ? OR article_author LIKE ?";
            $parameterList[] = '%' . $search . '%';
            $parameterList[] = '%' . $search . '%';
        }
        $loadQuery .= " ORDER BY article_date DESC";

        $stmt = $this->db->prepare($loadQuery);
        $stmt->execute($parameterList);

        if ($stmt->rowCount() < 1)
        {
            $this->errors[] = 'No articles to display';       
        }
        
        return $stmt;
    }
}
