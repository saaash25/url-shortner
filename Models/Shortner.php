<?php

require 'Connection.php';

class Shortner {

    var $SQL, $R_Id, $Url_Count, $L_Url, $UserDetails,$URLS;

    function doUrlShorten() {
        GLOBAL $con;
        $this->SQL = "INSERT INTO url ( " . implode(', ', array_keys($this->URL_DataArray)) . ") VALUES (" . "'" . implode("','", array_values($this->URL_DataArray)) . "'" . ")";
        $result = mysqli_query($con, $this->SQL);
        return $this->R_Id = mysqli_insert_id($con);
    }

    function getUrlCount() {
        GLOBAL $con;
        $this->SQL = "SELECT COUNT(URL_Id) AS URLCOUNT FROM url WHERE 1";
        $result = mysqli_query($con, $this->SQL);
        $row = mysqli_fetch_object($result);
        mysqli_free_result($result);
        return $this->UrlCount = $row->URLCOUNT;
    }

    function getLongUrl($URL_ShortCode) {
        GLOBAL $con;
        $this->SQL = "SELECT URL_LongUrl FROM url WHERE 1 AND URL_ShortCode='" . $URL_ShortCode . "'";
        $result = mysqli_query($con, $this->SQL);
        $row = mysqli_fetch_object($result);
        mysqli_free_result($result);
        return $this->L_Url = $row->URL_LongUrl;
    }

    function adminAuthenticate($username, $password) {
        GLOBAL $con;
        $this->SQL = "SELECT US_Id,US_Username FROM users WHERE 1 AND US_Username='" . trim($username) . "' AND US_Password='" . trim(md5($password)) . "'";
        $result = mysqli_query($con, $this->SQL);
        $row = mysqli_fetch_object($result);
        mysqli_free_result($result);
        return $this->UserDetails = $row;
    }

    function urlListing($Limit="") {
        GLOBAL $con;
        $this->SQL = "SELECT *  FROM url WHERE 1 ".$Limit;
        $result = mysqli_query($con, $this->SQL);
        if ($result->num_rows) {
            while ($row[] = mysqli_fetch_object($result));
            mysqli_free_result($result);
            $this->URLS=array_filter($row);
        } else {
            $this->URLS=[];
        }
         return $this->URLS;
    }

}

?>