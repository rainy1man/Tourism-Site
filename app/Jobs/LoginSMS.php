<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use IPPanel\Client;
use IPPanel\Errors\Error;
use IPPanel\Errors\HttpException;
use IPPanel\Errors\ResponseCodes;

class LoginSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $code;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $code
     */
    public function __construct($user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiKey = "2pPQM-k2mocoDS92Wbpeep6O23VwXXZfUsHwQQJR_xg=";
        $client = new Client($apiKey);
        $patternValues = [
            "verification-code" => $this->code,
        ];

        try
        {
            $message = $client->sendPattern(
                "7wix4qahvb6u3fy",          // pattern code
                "+983000505",               // originator
                $this->user->phone_number,  // recipient
                $patternValues              // pattern values
            );
        }
        catch (Error $e)
        {
            var_dump($e->unwrap());
            echo $e->getCode();

            if ($e->code() == ResponseCodes::ErrUnprocessableEntity)
            {
                echo "Unprocessable entity";
            }
        }
        catch (HttpException $e)
        {
            var_dump($e->getMessage());
            echo $e->getCode();
        }
    }
}
