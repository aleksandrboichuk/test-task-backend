<?php

namespace App\Console\Commands;

use App\Services\MyEventHandler;
use danog\MadelineProto\EventHandler\Message\GroupMessage;
use danog\MadelineProto\EventHandler\Message\PrivateMessage;
use danog\MadelineProto\Logger;
use danog\MadelineProto\Settings;
use Illuminate\Console\Command;
use LibDNS\Messages\Message;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

//        $MadelineProto = new \danog\MadelineProto\API('session.madeline');
//
//        $MadelineProto->start();
//
//        $me = $MadelineProto->getSelf();
//
//        $MadelineProto->logger($me);
//
//        $MadelineProto->messages->sendMessage(peer: '@aleksandrboihuk', message: "BANG GANG MOTHERFUCKER!");

        MyEventHandler::startAndLoop('session.madeline');

//        $MadelineProto->echo('OK, done!');
    }
}
