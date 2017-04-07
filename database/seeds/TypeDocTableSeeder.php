<?php

use Illuminate\Database\Seeder;

class TypeDocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_docs = [
            [
                'name' => 'Venezolano',
                'initial' => 'V-'
            ],[
                'name' => 'Juridico',
                'initial' => 'J-'
            ],[
                'name' => 'Extranjero',
                'initial' => 'E-'
            ],[
                'name' => 'Gubernamental',
                'initial' => 'V-'
            ],
        ];
        DB::table('type_docs')->insert($type_docs);
    }
}
