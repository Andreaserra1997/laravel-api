<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name'          => 'Front-End',
                'description'   => 'Il front end developer è un programmatore specializzato nello sviluppo della parte front end di siti e applicazioni web. Attraverso linguaggi come CSS, HTML e JavaScript, lo sviluppatore front end implementa il design di una pagina web e codifica tutti gli elementi che l\'utente vede e con cui interagisce.'
            ],
            [
                'name'          => 'Back-End',
                'description'   => 'Il backend è la parte lato server dello sviluppo di un sito web. A volte questo significa che il sito web o l\'app creata funziona solo sul lato server, come un database interno che lavora in background o un file server che registra le risorse per una società.'
            ],
            [
                'name'          => 'Full Stack Developer',
                'description'   => 'Il full stack developer è un programmatore che conosce tutti gli aspetti della programmazione, sia frontend che backend. Significa sapersi muovere agilmente tra i diversi aspetti di un’applicazione, conoscendo le tecnologie principali della programmazione frontend (HTML, CSS e JavaScript) e almeno un linguaggio back end (PHP, Java o Python), riuscendo a gestire le chiamate lato server e lato client, e le integrazioni con il database.'
            ]
            ];

        foreach($types as $type) {
            Type::create($type);
        }
    }
}
