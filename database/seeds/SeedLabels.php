<?php

use Illuminate\Database\Seeder;

class SeedLabels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('labels')->truncate();
        DB::unprepared(file_get_contents(app_path()."/../database/seeds/labels.sql"));


        /*
        // https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20161013T110602Z.5f55bba57bd745ac.b70978811cb21bcfe5b3af6ee8c5d8e0747fb087&text=Hello&lang=NL
        $yandex_api_key = "trnsl.1.1.20161013T110602Z.5f55bba57bd745ac.b70978811cb21bcfe5b3af6ee8c5d8e0747fb087";

        $labels = DB::table('labels')->where('lang', 'EN')->get();
        $langs_available = ['nl', 'fr', 'de'];

        foreach($labels as $label) {

            foreach($langs_available as $l) {

                DB::table('labels')->where('lang', $l)->where('key', $label->key)->delete();

                $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=" .  $yandex_api_key . "&text=" . $label->msg_txt . "&lang=" . strtoupper($l);
                //$translation = file_get_contents( $yandex_api_url . "?key=" . $yandex_api_key. "&text=" . urlencode($label->msg_txt) . "&lang=" . strtoupper($l));
                $translation = file_get_contents( $uri );
                $json = json_decode($translation);

                DB::table('labels')->insert(
                    [
                        'key'=>$label->key,
                        'lang'=>strtoupper($l),
                        'msg_txt'=>$json->text[0],
                    ]
                );

            }


        }

        // https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20161013T110602Z.5f55bba57bd745ac.b70978811cb21bcfe5b3af6ee8c5d8e0747fb087&text=Hello&lang=NL
        */

    }
}
