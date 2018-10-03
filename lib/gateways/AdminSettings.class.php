<?php

class AdminSettings {
    
    private $rosterLoaded;

    public function __construct($settings=array()) {
        if($settings["roster_loaded"] == "0") {
            $this->rosterLoaded = false;
        }
        else {
            $this->rosterLoaded = true;
        }
    }

    public function getRosterLoaded() { return $this->rosterLoaded; }

}


?>