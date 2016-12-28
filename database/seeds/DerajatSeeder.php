<?php

use Illuminate\Database\Seeder;
use App\Derajat;

class DerajatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataDerajat = [
        	['rendah' => 100, 'sedang' => 600, 'tinggi' => 1000, 'derajat_id' => 1],
        	['rendah' => 250, 'sedang' => 1375, 'tinggi' => 2500, 'derajat_id' => 2],
        	['rendah' => 10, 'sedang' => 15, 'tinggi' => 25, 'derajat_id' => 3],
        	['rendah' => 10, 'sedang' => 15, 'tinggi' => 25, 'derajat_id' => 4],
        	['rendah' => 20, 'sedang' => 30, 'tinggi' => 40, 'derajat_id' => 5],
        	['rendah' => 5.5, 'sedang' => 6.25, 'tinggi' => 7.0, 'derajat_id' => 6],
        ];

        foreach ($dataDerajat as $derajat) {
        	$d = new Derajat;
        	$d->rendah = $derajat['rendah'];
        	$d->sedang = $derajat['sedang'];
        	$d->tinggi = $derajat['tinggi'];
        	$d->variable_id = $derajat['derajat_id'];
        	$d->save();
        }
    }
}
