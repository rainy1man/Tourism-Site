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

class ResetPasswordSMS implements ShouldQueue
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
     *
     * @return void
     */
    public function handle()
    {
        $apiKey = "bpAbwYvx7HwribeByy4xK_UIa1YinpwP5MlMsD8pIUY=";
        $client = new Client($apiKey);
        $patternValues = [
            "verification-code" => $this->code,
        ];

        try
        {
            $message = $client->sendPattern(
                "strjlwg20i2py4k",          // pattern code
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
