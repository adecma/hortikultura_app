<?php

use Illuminate\Database\Seeder;
use App\Hortikultura;

class HortikulturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataHortikultura = [
        	['name' => 'Bawang Merah'],
        	['name' => 'Bawang Putih'],
        	['name' => 'Kacang Panjang'],
        	['name' => 'Wortel'],
        	['name' => 'Cabe Merah'],
        	['name' => 'Mentimun'],
        	['name' => 'Terong'],
        	['name' => 'Tomat Sayur'],
        	['name' => 'Pare'],
        	['name' => 'Kubis'],
        ];

        foreach ($dataHortikultura as $tanaman) {
        	$t = new Hortikultura;
        	$t->name = $tanaman['name'];
        	$t->save();
        }
    }
}
