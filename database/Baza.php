<?php

class Baza
{

    private  $host="localhost";
    private  $user="root";
    private  $password="";
    private  $database="hotel_db";

    private static ?mysqli $conn=null;

    private function __construct(){
        self::$conn = new mysqli($this->host,$this->user,$this->password,$this->database);
        if(self::$conn->connect_errno){
            echo "Neuspela konekcija na bazu!";
            exit();
        }
    }

    public static function getConnection(){
        if(self::$conn==null){
           new Baza();
        }
        return self::$conn;
    }

}