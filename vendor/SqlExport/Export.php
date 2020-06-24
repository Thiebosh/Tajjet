<?php 
function Export_Database($host,$user,$pass,$name,  $tables=false, $backupName=false, $isclient) {
    $mysqli = new mysqli($host,$user,$pass,$name); 
    $mysqli->select_db($name); 
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables    = $mysqli->query('SHOW TABLES'); 
    while($row = $queryTables->fetch_row()) $target_tables[] = $row[0]; 

    if($tables !== false) $target_tables = array_intersect( $target_tables, $tables); 

    foreach($target_tables as $table) {
        $result         =   $mysqli->query('SELECT * FROM '.$table);  
        $fields_amount  =   $result->field_count;  
        $rows_num=$mysqli->affected_rows;     
        $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
        $TableMLine     =   $res->fetch_row();
        $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";
        
        
        $debut = stripos($TableMLine[1],"CONSTRAINT");
        if($debut){
            $fin = stripos($TableMLine[1],"ENGINE",$debut)-1;

            $constraints[$table] =substr($TableMLine[1], $debut-2,$fin-$debut);
            
            $TableMLine[1] = str_replace (",\n".$constraints[$table], "", $TableMLine[1]);
            
            $constraints[$table]="ADD\t".$constraints[$table];
            $TableMLine[1] = "DROP TABLE IF EXISTS `$table`;\n".$TableMLine[1];
        }

        for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
            while($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                if ($st_counter%100 == 0 || $st_counter == 0 ) $content .= "\nINSERT INTO ".$table." VALUES";
                        
                $content .= "\n(";

                for($j=0; $j<$fields_amount; $j++) { 
                    $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );

                    $content .= isset($row[$j]) ? '"'.$row[$j].'"' : '""';

                    if ($j<($fields_amount-1))  $content.= ',';
                }
                $content .=")";
                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) $content .= ";";
                else $content .= ",";
                $st_counter=$st_counter+1;
            }
        } $content .="\n\n\n";
    }
    
    
    foreach($constraints as $table => $value) $TableMLine[1]=$TableMLine[1]."\nALTER TABLE `".$table."`\n".$value.";";
    $TableMLine[1]=$TableMLine[1]."\nCOMMIT;";
    
    //$backupName = $backupName ? $backupName : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
    $backupName = $backupName ? $backupName : $name.".sql";
    if ($isclient) {
        header('Content-Type: application/octet-stream');   
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$backupName."\"");
        echo($content);
    }
    else {
        $dir="resource/db/Backup";
        $backup_path=$dir.'/'.$backupName;
        if(!file_exists($dir)){ 
            $creation=mkdir($dir,0777,true);
            if($creation){ //On met le fichier dans le dossier Backup
                file_put_contents($backup_path,$content);
            }
        }
        else {
            if(file_exists($backup_path)) {
                unlink($backup_path);
            }
            file_put_contents($backup_path,$content);//On met le fichier dans le dossier Backup
        }
    }
}

