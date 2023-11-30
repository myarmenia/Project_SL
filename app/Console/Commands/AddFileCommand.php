<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Files in DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $publicPath = public_path('tmpfiles');
        $files = scandir($publicPath);
        $files = array_diff($files, ['.', '..']);

        foreach ($files as $key => $file) {
            //convert file doc to docx 
            // $convertedPath = 

            

            dd($file);
        }  
        
        dd($files);
        return Command::SUCCESS;
    }
}
