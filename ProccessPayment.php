<?php

$SECRETKEY = 'MY SECRET KEY';
$DOMAIN = 'domain.com';
$FILELOCATION = '/location/of/file';

if ($_GET["payment"] !== $SECRETKEY) {
  header("Location: $DOMAIN");
}else{
  if ($_GET["payment"] == $SECRETKEY) {
    if (get_option($_SERVER["REMOTE_ADDR"]) == 1) {
        header("Location: $DOMAIN");
    }else{
        update_option($_SERVER["REMOTE_ADDR"], true);
        header("Content-Type: application/zip");
        header("Content-Length: " . filesize($FILELOCATION));
        readfile($FILELOCATION);
        exit;
    }
  }
}

function update_option($name, $value)
{
    if(file_exists("../blocked.csv"))
    {
        $file = fopen("../blocked.csv","r");

        $exists = false;
        $csv = "";

        while(!feof($file))
        {
            $data_array = fgetcsv($file);

            if($data_array[0] == $name)
            {
                $exists = true;
            }
            else
            {
                $csv = $csv . $data_array[0] . "," . $data_array[1] . "\n";
            }
        }

        fclose($file);

        $csv = substr($csv, 0, -2);

        if($exists)
        {
            $csv = $csv . $name . "," . $value . "\n";
            file_put_contents("../blocked.csv", $csv);
        }
        else
        {
            $csv = file_get_contents("../blocked.csv") . $name . "," . $value . "\n";
            file_put_contents("../blocked.csv", $csv); 
        }
    }
    else
    {
        $csv = $name . "," . $value . "\n";
        file_put_contents("../blocked.csv", $csv);
    }
}

function get_option($name)
{
    $file = fopen("../blocked.csv","r");

    while(!feof($file))
    {
        $data_array = fgetcsv($file);

        if($data_array[0] == $name)
        {
            fclose($file);
            return $data_array[1];
        }
        
    }

    fclose($file);
    return null;
}

function delete_option($name)
{
    if(file_exists("../blocked.csv"))
    {
        $file = fopen("../blocked.csv","r");
        $csv = "";

        while(!feof($file))
        {
            $data_array = fgetcsv($file);

            if($data_array[0] == $name)
            {}
            else
            {
                $csv = $csv . $data_array[0] . "," . $data_array[1] . "\n";
            }
        }

        fclose($file);

        $csv = substr($csv, 0, -2);

        file_put_contents("../blocked.csv", $csv);
    }
}
?>
