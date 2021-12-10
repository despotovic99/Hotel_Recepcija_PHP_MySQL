<?php

class Prijava
{
    public static function login(mysqli $conn,$username,$password){
        return $conn->query("SELECT username FROM Korisnici WHERE username='$username' AND password='$password'");
    }

}