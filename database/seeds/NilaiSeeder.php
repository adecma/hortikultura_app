<?php

use Illuminate\Database\Seeder;
use App\Hortikultura;
use App\Variable;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $var1 = Variable::findOrFail(1);
        $var1->hortikulturas()->attach([
        	1 => ['nilai' => 900], 
        	2 => ['nilai' => 200], 
        	3 => ['nilai' => 600],
        	4 => ['nilai' => 1200],
        	5 => ['nilai' => 500], 
        	6 => ['nilai' => 800], 
        	7 => ['nilai' => 1200], 
        	8 => ['nilai' => 1500], 
        	9 => ['nilai' => 1500], 
        	10 => ['nilai' => 2000]
        ]);

        $var2 = Variable::findOrFail(2);
        $var2->hortikulturas()->attach([
        	1 => ['nilai' => 475], 
        	2 => ['nilai' => 475], 
        	3 => ['nilai' => 475],
        	4 => ['nilai' => 325],
        	5 => ['nilai' => 900], 
        	6 => ['nilai' => 450], 
        	7 => ['nilai' => 450], 
        	8 => ['nilai' => 450], 
        	9 => ['nilai' => 1750], 
        	10 => ['nilai' => 575]
        ]);

        $var3 = Variable::findOrFail(3);
        $var3->hortikulturas()->attach([
        	1 => ['nilai' => 23], 
        	2 => ['nilai' => 17], 
        	3 => ['nilai' => 18],
        	4 => ['nilai' => 17],
        	5 => ['nilai' => 24], 
        	6 => ['nilai' => 26], 
        	7 => ['nilai' => 22], 
        	8 => ['nilai' => 21], 
        	9 => ['nilai' => 22], 
        	10 => ['nilai' => 19]
        ]);

        $var4 = Variable::findOrFail(4);
        $var4->hortikulturas()->attach([
        	1 => ['nilai' => 16], 
        	2 => ['nilai' => 16], 
        	3 => ['nilai' => 15],
        	4 => ['nilai' => 14],
        	5 => ['nilai' => 15], 
        	6 => ['nilai' => 16], 
        	7 => ['nilai' => 14], 
        	8 => ['nilai' => 15], 
        	9 => ['nilai' => 15], 
        	10 => ['nilai' => 17]
        ]);

        $var5 = Variable::findOrFail(5);
        $var5->hortikulturas()->attach([
        	1 => ['nilai' => 34], 
        	2 => ['nilai' => 33], 
        	3 => ['nilai' => 40],
        	4 => ['nilai' => 32],
        	5 => ['nilai' => 30], 
        	6 => ['nilai' => 30], 
        	7 => ['nilai' => 31], 
        	8 => ['nilai' => 20], 
        	9 => ['nilai' => 30], 
        	10 => ['nilai' => 40]
        ]);

        $var6 = Variable::findOrFail(6);
        $var6->hortikulturas()->attach([
        	1 => ['nilai' => 5.8], 
        	2 => ['nilai' => 5.8], 
        	3 => ['nilai' => 5.5],
        	4 => ['nilai' => 5.7],
        	5 => ['nilai' => 6], 
        	6 => ['nilai' => 5.8], 
        	7 => ['nilai' => 6], 
        	8 => ['nilai' => 5.9], 
        	9 => ['nilai' => 5.5], 
        	10 => ['nilai' => 7]
        ]);
    }
}
