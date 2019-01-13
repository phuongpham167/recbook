<?php

namespace App\Jobs;

use App\Frontend;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class PublishWeb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $web;
    public $tries = 2;
    public function __construct(Frontend $web)
    {
        $this->web  =   $web;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $id =   $this->web->id;
        $files  =   Storage::disk('public_path')->allFiles("/frontend_web/$id/projects/template");
        $domain =   explode('.', $this->web->domain);
        $folder =   '';
        for($i=count($domain)-1;$i>-1;$i--){
            $folder.=$domain[$i].'/';
        }
        foreach($files as $item){
            $content    =   Storage::disk('public_path')->get($item);
            Storage::disk('ftp')->put($folder.str_replace("frontend_web/$id/projects/template",'',$item), $content);
        }
    }
}
