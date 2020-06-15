<?php
namespace vendor\SqlImport;

use PDO;
use PDOException;
use Exception;
use Error;

/**
 * PDO class to import sql from a .sql file
 * adapted from https://github.com/dcblogdev/sql-import/
 * add database creation if needed with specific classification
 */
class Import
{
    private $db;
    private $filename;
    private $username;
    private $password;
    private $database;
    private $characterSet;
    private $classification;
    private $host;
    private $forceDropTables;

    /**
      * instanciate
      * @param $filename string name of the file to import
      * @param $username string database username
      * @param $password string database password
      * @param $database string database name
      * @param $characterSet string database character set to apply if database doesn't exist
      * @param $classification string database classification to apply if database doesn't exist
      * @param $host string address host localhost or ip address
      * @param $dropTables boolean When set to true delete the database tables
      * @param $forceDropTables boolean [optional] When set to true foreign key checks will be disabled during deletion
    */
    public function __construct($filename, $username, $password, $database, $characterSet, $classification, $host, $dropTables, $forceDropTables = false)
    {
        //set the varibles to properties
        $this->filename = $filename;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->characterSet = $characterSet;
        $this->classification = $classification;
        $this->host = $host;
        $this->forceDropTables = $forceDropTables;

        //connect to the datase
        $this->connect();

        //if dropTables is true then delete the tables
        if ($dropTables == true) {
            $this->dropTables();
        }

        //open file and import the sql
        $this->openfile();
    }

    /**
     * Connect to the database and create it if needed
    */
    private function connect() {
        try {
            $this->db = new PDO("mysql:host=$this->host", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->db->query("CREATE DATABASE IF NOT EXISTS $this->database CHARACTER SET $this->characterSet COLLATE $this->classification");
            $this->db->query("use $this->database");
        } catch(PDOException $e) {
            echo "Cannot connect: ".$e->getMessage()."\n";
        }
    }

    /**
     * run queries
     * @param string $query the query to perform
    */
    private function query($query)
    {
        try {
            return $this->db->query($query);
        } catch(Error $e) {
            echo "Error with query: ".$e->getMessage()."\n";
        }
    }

    /**
     * Select all tables, loop through and delete/drop them.
    */
    private function dropTables()
    {
        //get list of tables
        $tables = $this->query('SHOW TABLES');

        if ($tables != null) {
            //loop through tables
            foreach ($tables->fetchAll(PDO::FETCH_COLUMN) as $table) {
                if ($this->forceDropTables === true) {
                    //delete table with foreign key checks disabled
                    $this->query('SET FOREIGN_KEY_CHECKS=0; DROP TABLE `' . $table . '`; SET FOREIGN_KEY_CHECKS=1;');
                } else {
                    //delete table
                    $this->query('DROP TABLE `' . $table . '`');
                }
            }
        }
    }

    /**
     * Open $filename, loop through and import the commands
    */
    private function openfile()
    {
        try {

            //if file cannot be found throw errror
            if (!file_exists($this->filename)) {
                throw new Exception("Error: File not found.\n");
            }

            // Read in entire file
            $fp = fopen($this->filename, 'r');

            // Temporary variable, used to store current query
            $templine = '';

            // Loop through each line
            while (($line = fgets($fp)) !== false) {

            	// Skip it if it's a comment
            	if (substr($line, 0, 2) == '--' || $line == '') {
            		continue;
                }

            	// Add this line to the current segment
            	$templine .= $line;

            	// If it has a semicolon at the end, it's the end of the query
            	if (substr(trim($line), -1, 1) == ';') {
                    $this->query($templine);

            		// Reset temp variable to empty
            		$templine = '';
            	}
            }

            //close the file
            fclose($fp);

        } catch(Exception $e) {
            echo "Error importing: ".$e->getMessage()."\n";
        }
    }
}