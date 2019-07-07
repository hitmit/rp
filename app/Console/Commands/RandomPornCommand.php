<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mtownsend\XmlToArray\XmlToArray;
use File;

class RandomPornCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'random:porn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a json file random pron data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $porn_xml = file_get_contents(public_path('porn/porn.xml'));

        $xml_to_array = new XmlToArray();

        // Convert XML to array.
        $porn_array = $xml_to_array->convert($porn_xml); 
        $this->info("Importing Clients...");
        $porns = [];
        foreach ($porn_array['video'] as $key => $porn) {
            $porns[] = [
                'id' => $porn['id'],
                'title' => $porn['title'],
                'embed' => $porn['embed'],
            ];
        }

        $destinationPath=public_path()."/porn/random/";
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath,0777,true);
        }
        File::put($destinationPath . 'random.json', json_encode($porns));
    }
}
