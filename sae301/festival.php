<?php

class festival {
 public $nom;
 public $date;
 public $artiste = array();
 public $nbplace;
 public $lieu;


public function __construct($n, $d, $p, $l) {
    $this->nom = $n;
    $this->date = $d;
    $this->nbplace = $p;
    $this->lieu = $l;
    
}

public function ajouterArtiste($a) {
$this->artiste[] = $a;
}

public function ajouterDonnées($n, $d, $a, $p, $l) {
    $n = $_POST['nom'];
    $d = $_POST['date'];
    $a = $_POST['artiste'];
    $p = $_POST['nbplace'];
    $l = $_POST['lieu'];
}

public function liaisonBDD() {
    
}
}
?>