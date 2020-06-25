<?php 
function Export_Database($host,$user,$pass,$name,  $tables=false, $backupName=false, $isClient, $structureOnly) {
    $mysqli = new mysqli($host,$user,$pass,$name); 
    $mysqli->select_db($name); 
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables    = $mysqli->query('SHOW TABLES'); 
    while($row = $queryTables->fetch_row()) $target_tables[] = $row[0]; 

    if($tables !== false) $target_tables = array_intersect( $target_tables, $tables); 

    $structure = '';
    $data = '';
    $constraint_structure = '';
    foreach ($target_tables as $table) {

        $result         = $mysqli->query('SELECT * FROM '.$table);  
        $fields_amount  = $result->field_count;  
        $rows_num       = $mysqli->affected_rows;     
        $res            = $mysqli->query('SHOW CREATE TABLE '.$table); 
        $tableMLine     = $res->fetch_row();
        
        $begin = stripos($tableMLine[1],"CONSTRAINT");
        if ($begin) {
            $end = stripos($tableMLine[1],"ENGINE",$begin)-1;

            $constraints[$table] =substr($tableMLine[1], $begin-2,$end-$begin);
            
            $tableMLine[1] = str_replace (",\n".$constraints[$table], "", $tableMLine[1]);
            
            $constraints[$table] = "\t ADD ".str_replace("ADD \n", "ADD ", str_replace(",", ",\n\t ADD ", $constraints[$table]));
        }

        $structure .= "DROP TABLE IF EXISTS `$table`;\n".$tableMLine[1].";\n\n\n";

        if (!in_array($table, $structureOnly)) {
            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
                while($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 ) $data .= "\nINSERT INTO ".$table." VALUES";
                            
                    $data .= "\n(";

                    for($j=0; $j<$fields_amount; $j++) { 
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );

                        $data .= isset($row[$j]) ? '"'.$row[$j].'"' : '""';

                        if ($j<($fields_amount-1))  $data.= ',';
                    }
                    $data .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) $data .= ";";
                    else $data .= ",";

                    $st_counter++;
                }
            } 

            $data .="\n\n";
        }
    }
    
    if (isset($constraints)) {
        foreach($constraints as $table => $value) {
            $constraint_structure .="\n\nALTER TABLE `".$table."`\n".$value.";";
        }
        $constraint_structure .= "\nCOMMIT;";
    }
    
    //$backupName = $backupName ? $backupName : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
    $backupName = $backupName ? $backupName : $name;
    if ($isClient) {
        header('structure-Type: application/octet-stream');   
        header("structure-Transfer-Encoding: Binary");
        header("structure-disposition: attachment; filename=\"".$backupName."\"");
        echo($structure);
        exit();//test
    }
    else {
        $dir="resource/db/Backup";
        $backup_path=$dir.'/'.$backupName.'Structure.sql';
        if(!file_exists($dir)){ 
            $creation=mkdir($dir,0777,true);
            if($creation){ //On met le fichier dans le dossier Backup_Structure
                file_put_contents($backup_path,$structure);
            }
        } 
        else {
            if(file_exists($backup_path)) unlink($backup_path);
            file_put_contents($backup_path,$structure);//On met le fichier dans le dossier Backup_Structure
        }

        $dir="resource/db/Backup";
        $backup_path=$dir.'/'.$backupName.'Data.sql';
        if(!file_exists($dir)){ 
            $creation=mkdir($dir,0777,true);
            if($creation){ //On met le fichier dans le dossier Backup_Data
                if($data!=''){
                    file_put_contents($backup_path,$data);
                }
            }
        }
        else {
            if(file_exists($backup_path)) unlink($backup_path);
            if($data!=''){
                file_put_contents($backup_path,$data);//On met le fichier dans le dossier Backup_Data
            }
        }

        $dir="resource/db/Backup";
        $backup_path=$dir.'/'.$backupName.'Constraints.sql';
        if(!file_exists($dir)){ 
            $creation=mkdir($dir,0777,true);
            if($creation){ //On met le fichier dans le dossier Backup_Constraints
                if($constraint_structure!=''){
                    file_put_contents($backup_path,$constraint_structure);
                }
            }
        }
        else {
            if(file_exists($backup_path)) unlink($backup_path);
            if($constraint_structure!=''){
                file_put_contents($backup_path,$constraint_structure);//On met le fichier dans le dossier Backup_Constraints
            }
        }
    }
}

