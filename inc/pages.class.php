<?php
require_once('base.class.php');

class pages extends base 
{
    var $tableName = 'pages';
    var $keyField = 'pages_id';
    var $searchableFields = array('pages_meta', 'pages_title', 'pages_url_key', 'pages_h1');

    function loadByURLKey($url_key)
    {
        $holdingKeyField = $this->keyField;

        $this->keyField = 'pages_url_key';
        $loadSuccess = $this->load($url_key);

        $this->keyField = $holdingKeyField;

        return $loadSuccess;
    }

    function sanitize($sanitizeData) 
    {
        foreach ($sanitizeData as $key => $value)
        {
            $sanitizeData[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        if ( !empty($sanitizeData['pages_content']) )
        {
            $sanitizeData['pages_content'] = strip_tags( $sanitizeData['pages_content'] , "<br><a><b><i><u><h2><h3>" );
        }

        return $sanitizeData;
    }
    
    function validate()
    {
        $success = true;
        $validateData = $this->data;

        if ( empty($validateData['pages_title']) )
        {
            $this->errors[] = 'Please enter a page title';
            $success = false;
        }
        else
        {
            if( strlen($validateData['pages_title']) > 100 )
            {
                $this->errors[] = 'Please enter a page title with 100 characters or fewer';
                $success = false;
            }
        }

        if ( !empty($validateData['pages_meta']) && strlen($validateData['pages_meta']) > 200 )
        {
            $this->errors[] = 'Please enter meta data that is 200 characters or fewer';
            $success = false;
        }

        if ( empty($validateData['pages_h1']) )
        {
            $this->errors[] = 'Please enter a page header';
            $success = false;
        }
        else
        {
            if( strlen($validateData['pages_h1']) > 200 )
            {
                $this->errors[] = 'Please enter a page header that is 200 characters or fewer';
                $success = false;
            }
        }

        if ($validateData['pages_image_size'] > 5000000) {
            $this->errors[] = 'Too large of a file';
            $success = false;
        }


        if ( empty($validateData['pages_content']) )
        {
            $this->errors[] = 'Please enter page content';
            $success = false;
        }

        if ( !empty($validateData['pages_url_key']) && strlen($validateData['pages_url_key']) > 200 )
        {
            $this->errors[] = 'Please enter a URL key that is 200 characters or fewer';
            $success = false;
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
            foreach ($this->searchableFields as $value)
            {
                $loadQuery .= ($loopCount++ > 0 ? " OR " : "") . "$value LIKE ?";
                $parameterList[] = '%' . $search . '%';
            }
            
        }
        $loadQuery .= " ORDER BY pages_menu_order ASC ";
        $stmt = $this->db->prepare($loadQuery);
        $stmt->execute($parameterList);

        if ($stmt->rowCount() < 1)
        {
            $this->errors[] = 'No records to display';       
        }
        
        return $stmt;
    }
}
?>
