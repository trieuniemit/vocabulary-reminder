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
        $voca = "<C><F><I><N><Q>@abase /ə'beis/<br />*  ngoại động từ<br />- làm hạ phẩm giá, làm mất thể diện, làm nhục<br />=to abase one-self+ tự hạ mình</Q></N></I></F></C>";

        $voca = str_replace(array(
                '<C><F><I><N><Q>',
                '</Q></N></I></F></C>'
            ), 
            array('', ''), 
            $voca
        );

        $vocaInfo = explode('<br />', $voca);

        $vocaInfo[0] = preg_replace('/@.* \//', '', $vocaInfo[0]);
        $vocaInfo[1] = preg_replace('/\*[ ]{1,}/', '', $vocaInfo[1]);
        $vocaInfo[2] = preg_replace('/-[ ]{1,}/', '', $vocaInfo[2]);

        foreach($vocaInfo as $v) {

        }

        print_r($vocaInfo);

    }
}
