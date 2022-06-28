<?php
    class UtilePerssistance{
        public static function clean_input($input){
            $input=trim($input);
            $input=stripslashes($input);
            return htmlspecialchars($input);
        }
    }
?>