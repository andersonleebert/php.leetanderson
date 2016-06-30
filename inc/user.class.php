<?php
require_once('base.class.php');


class user extends base
{
    var $tableName = 'users';
    var $keyField = 'user_id';
    var $reportResultsPerPage = 1; 

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

        if ( empty($validateData['user_username']) )
        {
            $this->errors[] = 'Username is required';
            $success = false;
        }

        if ( empty($validateData['user_password']) )
        {
            $this->errors[] = 'Password is required';
            $success = false;
        }
        else
        {
            if( strlen($validateData['user_password']) > 12 )
            {
                $this->errors[] = 'Too long of a password';
                $success = false;
            }
        }
        if ($validateData['user_image_size'] > 5000000) {
            $this->errors[] = 'Too large of a file';
            $success = false;
        }


        return $success;
    }

    function loginUser()
    {
        $success = false;
        
        $stmt = $this->db->prepare("SELECT * FROM " . $this->tableName . " WHERE user_username = ?");
        $stmt->execute( array($this->data['user_username']) );

        // still needs to check the password
        if ($stmt->rowCount() == 1)
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //if (password_verify($this->data['user_password'], $row['user_password']))
            if(hash("md5", $this->data['user_password']) == $row['user_password'])
            {
                $this->data = $row;
                $success = true;
            }
        }
        
        return $success;
    }

    function getAllPermissions()
    {
        $stmt = $this->db->query("SELECT * FROM user_permission");
        return $stmt;
    }
    

    function loadAllUsers($search = null)
    {
        $loadQuery = "SELECT * FROM " . $this->tableName;
        $parameterList = array();
        if ( !is_null($search) && !empty($search))
        {
            $loadQuery .= " WHERE user_username LIKE ?";
            $parameterList[] = '%' . $search . '%';
        }
        $stmt = $this->db->prepare($loadQuery);
        $stmt->execute($parameterList);

        if ($stmt->rowCount() < 1)
        {
            $this->errors[] = 'No users to display';       
        }
        
        return $stmt;
    }


    function getReportData($reportFilters) 
    {
        $listSQL = "SELECT * FROM " . $this->tableName;
        $parameterList = array();
        $stmt = null;
        
        if (!empty($reportFilters) && is_array($reportFilters))
        {
            $filterPassed = false;
            
            $listSQL .= " WHERE ";
            
            if (isset($reportFilters['username_filter']) && !empty($reportFilters['username_filter'])) 
            {
                $listSQL .= "user_username LIKE ?";                                
                $parameterList[] = '%' . $reportFilters['username_filter'] . '%';
                $filterPassed = true;
            }

            if (isset($reportFilters['user_permission_id_filter']) && !empty($reportFilters['user_permission_id_filter'])) 
            {
                $listSQL .= ($filterPassed ? " AND " : "") . "user_permission_id LIKE ?";                                
                $parameterList[] = '%' . $reportFilters['user_permission_id_filter'] . '%';
                $filterPassed = true;
            }                        
            
            if (isset($reportFilters['page']) && !empty($reportFilters['page'])) 
            {
                $listSQL .= " LIMIT " . ($this->reportResultsPerPage * ($reportFilters['page'] - 1)) . "," . $this->reportResultsPerPage;
            }            
            
            if ($filterPassed)
            {
                $stmt = $this->db->prepare($listSQL);
                $stmt->execute($parameterList);            
            }
        }
              
        return $stmt;
    }

    public function downloadReport($reportFilters)
    {
        $reportData = $this->getReportData($reportFilters);
        
        if (isset($reportData))
        {
            $timestamp = date("YmdHis");
            
            header("Content-Type: text/csv");
            header('Content-Disposition: attachment; filename="' . $timestamp . '_user_report.csv"');
            while($row = $reportData->fetch(PDO::FETCH_ASSOC)) 
            {
                echo implode(",", $row) . "\r\n";
            }
        }        
    }
}

?>
