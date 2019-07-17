<?php

namespace App\Http\Controllers;

use DB;
use View;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{


    // -- on successful connection with DB present Welcome view
    public function checkDbConnection() {
        try {
            DB::connection()->getPdo();
            $dbName = DB::connection()->getDatabaseName();
            $dbCnnResult = 'DB Connection Successful';
            return View::make("welcome")->with('dbCnnResult', $dbCnnResult);
        } catch (Exception $e) {
            $dbCnnResult = 'Could not connect to the database. Please check your configuration.';
            //die("Could not connect to the database. Please check your configuration. error:" . $e );
            View::make("welcome")->with('dbName', $dbCnnResult);
        }
    }

    // -- call on click of `Backup Database` button
    public function download()
    {
        // -- use env file for DB related values
        $username = env('DB_USERNAME', 'forge');
        $password = env('DB_PASSWORD', '');

        // -- back will bo stored in file named
        $backFileName = 'all_db_backup.sql';

        // -- command that generates the back up file
        $command = 'mysqldump -u '.$username.' -p'.$password.' --all-databases > '.$backFileName;

        // -- command execution
        exec ($command, $output, $return);

        // -- check result to display appropriate result
        $resultStr = '';
        if (!$return) {
            $resultStr = "Backup file generated successfully. Please check public directory for file ".$backFileName;
        }
        return View::make("welcome")->with('resultStr', $resultStr);
    }

}
