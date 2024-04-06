<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

Route::get('/', function () {
    $stringType = "María" . " " . 9;
    $numberType = 30;
    $booleanType = false;
    $datos = [
        "nombre" => "Juan",
        "edad" => 25
    ];

    $personas = array (
        array (
            "Nombre" => "Juan",
            "Edad" => 25
        ),
        array (
            "Nombre" => "María",
            "Edad" => 30
        )
    );

    /*  print_r($datos);
     
     echo ($stringType); */

    //dd($personas,$stringType, $numberType, $datos, $booleanType);

    $nota = 75;
    if ($nota >= 90) {
        $mensaje1 = "Excelente.";
    } elseif ($nota >= 70) {
        $mensaje1 = "Aprobado.";
    } else {
        $mensaje1 = "Reprobado.";
    }

    $clima = "soleado";
    $mensaje2 = ($clima == "soleado") ? "Hace buen tiempo." : "El clima no es ideal.";
    foreach ($personas as $persona) {
        echo "Nombre: " . $persona["Nombre"] . ", Edad: " . $persona["Edad"] . "<br>";
    }

    // dd($mensaje1, $mensaje2);
    $numero = 123.98;
    $numeroString = (string) $numero;
    $stringInt = intval($numero);
    $stringFloat = floatval($numero);
    $numberRound = round($numero);
    $numberFloor = floor($numero);
    $numberCeil = ceil($numero);

    //dd($numero, $numeroString, $stringInt, $stringFloat, $numberRound, $numberFloor, $numberCeil);

    $numeros = [3, 1, 4, 2];
    sort($numeros);

    $arrayAsociativo = [
        "Pedro" => 41,
        "Juan" => 25,
        "María" => 10
    ];

    arsort($arrayAsociativo);
    ksort($arrayAsociativo);
    $personas = [
        ["nombre" => "Juan", "edad" => 25],
        ["nombre" => "Pedro", "edad" => 45],
        ["nombre" => "María", "edad" => 10]
    ];

    $nueva_persona = [
        "nombre" => "Ana",
        "edad" => 28
    ];
    array_push($personas, $nueva_persona);

    usort($personas, function ($a, $b) {
        return $b["edad"] - $a["edad"];
    });

    $primerElemento = array_shift($personas);


    define("CONSTANTE_EJEMPLO", 3.5);
    $fechaActual = date('d-m-Y');


    // dd($numeros, $arrayAsociativo, $personas, $primerElemento, CONSTANTE_EJEMPLO, $fechaActual);

    class Sumador {
        private $numero1;
        private $numero2;
        private static $contador = 0;
        public function __construct($num1, $num2)
        {
            $this->numero1 = $num1;
            $this->numero2 = $num2;
            self::$contador++;
        }
        public function obtenerSuma()
        {
            return $this->numero1 + $this->numero2;
        }
        public static function obtenerContador()
        {
            return self::$contador;
        }
    }

    $sumador1 = new Sumador(5, 3);
    $sumador2 = new Sumador(10, 7);
    $resultado1 = $sumador1->obtenerSuma();
    $resultado2 = $sumador2->obtenerSuma();
    /*  echo "La suma es: $resultado1<br>";
     echo "La suma es: $resultado2<br>";
     $contadorTotal = Sumador::obtenerContador();
     echo "Se han creado $contadorTotal instancias de la clase Sumador.";
     dd('fin'); */

    $date = Carbon::now()->locale('es_VE');
    /* 
        echo $date->locale();            // fr_FR
        echo "<br>";
        echo $date->diffForHumans();     // il y a 0 seconde
        echo "<br>";
        echo $date->monthName;           // mars
        echo "<br>";
        echo $date->isoFormat('LLLL'); 
        dd('Carbon'); */
    $character = Str::charAt('Maria', 0);
    $number = Number::format(100000.65, locale: 'es_VE');
    dd($number, $character);
    //return view('welcome');
});

