<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illumniate\Support\Facades\Mail;
use App\Mail\UserWelcome;
use App\User;

class UserMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:mail {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar Email a un usario';

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
        $user = User::find($this->argument('id'));

        if($user){
         Mail::to($user->email)->send(new UserWelcome($user));
        }else{
          echo 'El usuario no existe';
        }
    }
}
