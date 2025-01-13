<?php

class mobil{
    private $warna;
    private $merek;
    private $harga;
    public function __construct(){
        $this->warna = "biru";
        $this->merek = "bmw";
        $this->harga = "duaratusjuta";
    }

    public function gantiWarna($warnaBaru){
        $this->warna = $warnaBaru;
    }

    public function lihatWarna(){
        echo "warna mobilnya: " .$this->warna;
    }
}

// membuat objek
$a = new mobil();
$a->lihatWarna();

echo"<br>";
//mengubah atribut warna objek
$a->gantiWarna("orange");
$a->lihatWarna();
?>