<?php
include_once('settings.php');
class base extends settings
{
    /* connectionString, connectionUser, and connectionPass exist in settings.php */
    var $data = array();
    var $db = null;
    var $errors = array();
    var $tableName = null;
    var $keyField = null;
    var $searchFields = array();
        
    function __construct() 
    {
        $this->connectToDB();
    }
    
    function connectToDB() 
    {
        $success = true;
        
        $this->db = new PDO($this->connectionString, $this->connectionUser, $this->connectionPass);
        
        if (!$this->db)
        {
            $this->errors[] = 'Unable to connect to database';
            $success = false;
        }
        
        return $success;
    }
        
    function set($setData) 
    {
        $this->data = $this->sanitize($setData);
    }
    
    function sanitize($sanitizeData) 
    {        
        return $sanitizeData;
    }
    
    function validate()
    {
        // validate $this->data
        
        return false;
    }
    
    function load($loadId)
    {
        $success = false;
        
        $stmt = $this->db->prepare("SELECT * FROM " . $this->tableName . " WHERE " . $this->keyField . " = ?");
        $stmt->execute(array($loadId));

        if ($stmt->rowCount() == 1)
        {
            $success = true;
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $this->data = $row;
                break;
            }
           
        }
        
        return $success;
    }
    
    function save()
    {
        $success = true;
        
        if (isset($this->data[$this->keyField]) && !empty($this->data[$this->keyField])) 
        {
            // update
            $updateSQL = "UPDATE " . $this->tableName . " SET ";
            
            $count = 0;
            foreach ($this->data as $columnName => $columnValue) 
            {
                $updateSQL .= ($count++ > 0 ? "," : "") . $columnName . " = ?";                
            }
            
            $updateSQL .= " WHERE " . $this->keyField . " = ?";
            
            $updateValues = array_values($this->data);
            $updateValues[] = $this->data[$this->keyField];
            
            
            $stmt = $this->db->prepare($updateSQL);
            if (!$stmt->execute($updateValues)) 
            {
                $success = false;
                $this->errors[] = $stmt->errorInfo();
            }
        } 
        else 
        {
            // insert
            $ID = $this->guidv4();
            $this->data[$this->keyField] = $ID;
            $insertSQL = "INSERT INTO " . $this->tableName . " SET ";
            
            $count = 0;
            foreach ($this->data as $columnName => $columnValue) 
            {
                $insertSQL .= ($count++ > 0 ? "," : "") . $columnName . " = ?";                
            }
                        
            $insertValues = array_values($this->data);
            $stmt = $this->db->prepare($insertSQL);
            if (!$stmt->execute($insertValues)) 
            {
                $success = false;
                $this->errors[] = $stmt->errorInfo();
            }
        }
                
        return $success;
    }

    function getList($search = null)
    {
        $loadQuery = "SELECT * FROM " . $this->tableName;
        $parameterList = array();
        if ( !is_null($search) && !empty($search))
        {
            $loadQuery .= " WHERE ";

            $loopCount = 0;
            foreach ($searchFields as $value)
            {
                $loadQuery .= ($loopCount++ > 0 ? " OR " : "") . "$value LIKE ?";
                $parameterList[] = '%' . $search . '%';
            }
            
        }
        $stmt = $this->db->prepare($loadQuery);
        $stmt->execute($parameterList);

        if ($stmt->rowCount() < 1)
        {
            $this->errors[] = 'No records to display';       
        }
        
        return $stmt;
    }

    function deleteRecord($ID)
    {
        $success = true;

        $deleteQuery = "DELETE FROM " . $this->tableName;
        $deleteQuery .= " WHERE " . $this->keyField . " = ?";
        $stmt = $this->db->prepare($deleteQuery);
        if (!$stmt->execute(array($ID)) ) 
        {
            $success = false;
            $this->errors[] = $stmt->errorInfo();
        }
                
        return $success;
    }

    public function moveUpload($tmpfilename, $destination, $filename)
    {
        move_uploaded_file($tmpfilename, $destination . $filename);
        return dirname($_SERVER["PHP_SELF"]) . "/" . $destination . $filename;
    }

    public function guidv4() 
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,
        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    function checkLogin()
    {
        if( !$_SESSION['loggedIn'])
        {
            header("location:user_login.php");
            exit;
        }
    }

    static function curlGET($url)
    {
        $curSession = curl_init();

        $result = null;
        if($curSession)
        {
            curl_setopt($curSession, CURLOPT_URL, $url);
            curl_setopt($curSession, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curSession, CURLOPT_FOLLOWLOCATION, true);

            $result = curl_exec($curSession);

            curl_close($curSession);
        }
        return $result;
    }


}



?>
