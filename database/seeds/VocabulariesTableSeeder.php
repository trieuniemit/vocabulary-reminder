<?php

use Illuminate\Database\Seeder;

class VocabulariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = resource_path('json/edict.json');
        $vocas = json_decode(file_get_contents($path));
        foreach($vocas as $vc) {
            try{
                $v = DB::table('vocabularies')->insertGetId([
                    'word' => $vc->word,
                    'user_id' => 1,
                    'spelling' => $vc->spelling
                ]);

                $mean = DB::table('means')->insert([
                    'vocabulary_id' => $v,
                    'mean' => $vc->mean,
                    'type' => $vc->type
                ]);
            }  catch (Exception $e) {
                
            }

        }
    }


    public function exportJsonFromDb()
    {
        $data = DB::table('tbl_edict')->inRandomOrder()->limit(10000)->get();
        $exportData = [];
        foreach($data as $vc) {
            $voca = str_replace(array(
                    '<C><F><I><N><Q>',
                    '</Q></N></I></F></C>'
                ), 
                array('', ''), 
                $vc->detail
            );

            $vocaInfo = explode('<br />', $voca);

            if(count($vocaInfo) >= 3) {
                $exportData[] = [
                    'word' => $vc->word,
                    'spelling' => str_replace('/','', preg_replace('/@.* \//', '', $vocaInfo[0])),
                    'type' => preg_replace('/\*[ ]{1,}/', '', $vocaInfo[1]),
                    'mean' => preg_replace('/-[ ]{1,}/', '', $vocaInfo[2])
                ];
            }
        }

        $path = resource_path('json/edict.json');
        $fp = fopen($path, 'w');
        fwrite($fp, json_encode($exportData, JSON_PRETTY_PRINT));
        fclose($fp);

    }
}
