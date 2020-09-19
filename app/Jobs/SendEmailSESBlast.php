<?php

namespace App\Jobs;

use App\Traits\Email\EmailSesTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailSESBlast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, EmailSesTrait;
    protected $type, $params, $request, $users;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $params, $request, $users)
    {
        $this->type     = $type;
        $this->params   = $params;
        $this->request  = $request;
        $this->users    = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            #loop user by role/group
            foreach ( $this->users as $user )
            {
                // conver to array
                $this->params['Destination']['ToAddresses'] = explode(',',$user->email);
                $this->doSendEmailSES( $this->params, $this->request );
            }
        }
        catch (\Exception $exception)
        {

        }
    }
}
