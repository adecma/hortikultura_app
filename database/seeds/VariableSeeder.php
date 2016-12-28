<?php

use Illuminate\Database\Seeder;
use App\Variable;

class VariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataVariable = [
        	['name' => 'Ketinggian Tanah'],
        	['name' => 'Curah Hujan'],
        	['name' => 'Suhu Udara'],
        	['name' => 'KTK Tanah'],
        	['name' => 'Kejenuhan Basa'],
        	['name' => 'pH'],
        ];

        foreach ($dataVariable as $variable) {
        	$v = new Variable;
        	$v->name = $variable['name'];
        	$v->save();
        }
    }
}
