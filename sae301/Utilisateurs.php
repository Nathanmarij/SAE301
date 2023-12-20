<?php

class user{
    public $nom;
    public $prenom;
    public $mail;
    public $mdp;

    public function __construct($n, $p, $m, $mdp) {
        $this->nom = $n;
        $this->prenom = $p;
        $this->mail = $m;
        $this->mdp = $d;
    }

    public function ajouterUtilisateur() {
        $m = $_POST["nom"];
        $p = $_POST["prenom"]; 
        $m = $_POST["mail"];
        $d = $_POST["mdp"];
    }
}

?>