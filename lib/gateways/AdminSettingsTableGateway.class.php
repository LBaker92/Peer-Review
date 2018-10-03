<?php

include_once '../lib/db/DBQueryRunner.class.php';
include_once 'AdminSettings.class.php';

class AdminSettingsTableGateway {

    private static $baseSql = "SELECT * FROM admin_shared_settings";
    private static $delimiter = '", "';

    public function getAllSettings() {
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        $settings= $statement->fetch(PDO::FETCH_ASSOC);
        
        if (empty($settings)) {
            return;
        }

        return new AdminSettings($settings);
    }

    // POSSIBLY DELETE THIS
    public function getRosterLoaded() {
        $sql = "SELECT roster_loaded FROM admin_shared_settings";
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        $setting = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($setting)) {
            return;
        }

        if ($setting["roster_loaded"] == "0") {
            return false;
        }
        else {
            return true;
        }
    }

}

?>