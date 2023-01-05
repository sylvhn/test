<?php

//Diberikan potongan kode di bawah ini:

class SecretBox {

    public int $number;
    
    public function __construct($number)
    {
        $this->number = $number;
    }

    public function check($x)
    {
        if ($x == $this->number)
            return 'pas';
        elseif($x < $this->number)
            return 'kurang';
        else
            return 'lebih';
    }
}


class Person {

    // OTHERS CODE IF NECESSARY

    public function guess($a, $z)
    {
        // Menebak angka dengan metode ngasal, tergantung hoki
        $number = rand($a,$z);

        return $number;
    }

    public function acceptResponse($number, $response)
    {
        if($response == 'kurang'){
            return $number++;
        }else{
            return $number--;
        }
    }

    // OTHERS CODE IF NECESSARY
}


// Test Script
$secretNumber = rand(1, 100);
$box = new SecretBox($secretNumber);
$bayu = new Person();
echo "Secret Number: ".$secretNumber."<br><br>";

$finish = false;
$i = 1;

$a = 1;
$z= 100;
while($finish == false) {
    $guess = $bayu->guess($a, $z);
    $response = $box->check($guess);

    if($response === 'kurang'){
        $a = $bayu->acceptResponse($guess, 'kurang');
    }
    if($response === 'lebih'){
        $z = $bayu->acceptResponse($guess, 'lebih');
    }

    echo $a.'-'.$z.'<br>';

    $finish = ($response === 'pas');
    
    echo "Tebakan ". ($i+1).": ".$guess;
    echo "<br>";
    echo "Response: ".$response;
    echo "<br><br>";
}

// Silakan perbaiki kode di atas agar Person bisa menebak dengan lebih jitu, dengan ketentuan:

// * Class SecretBox tidak boleh diubah
// * Class Person boleh diubah
// * Test script boleh diubah
// * Semakin sedikit jumlah tebakan semakin baik

#### Bonus
// Manfaatkan Strategy Pattern sehingga class Person bisa gonta-ganti metode untuk menebak angka saat runtime. Beberapa strategy yang bisa diterapkan: tebak 100% random, tebak iteratif naik/turun satu angka, dan tebak ambil nilai tengah.