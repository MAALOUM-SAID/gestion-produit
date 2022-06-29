<?php
class Connection{
    static function connectToDB($dbname){
        $dsn="mysql:host=localhost;port=3306;dbname=$dbname";
        $user="root";
        $passwd="SAID";
        $options=[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        ];
        return new PDO($dsn,$user,$passwd,$options);
    }
}
?>