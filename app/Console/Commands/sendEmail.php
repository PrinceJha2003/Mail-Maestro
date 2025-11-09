<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\email_system_model;
use App\Mail\email_system;
use Carbon\Carbon;


class sendEmail extends Command
{
    /** php artisan schedule:work Command for run*/
    /** php artisan send:email Command for testing*/
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

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


        // Get the current time
        $currentDateTime = Carbon::now()->format('Y-m-d H:i');

        // Retrieve rows where status = 1 and execution_time is within the range
        $emailDataRows = email_system_model::where('status', 1)
            ->where('execution_time', $currentDateTime . ":00")
            ->where('recurring_end', '!=', 0)
            ->get();

        // dd($emailDataRows);
        // Check if there are any rows to process
        if ($emailDataRows->isEmpty()) {
            return "No emails to send at this time.";
        }


        // Loop through each row and send emails
        foreach ($emailDataRows as $emailData) {
            $email_from = $emailData->mail_from;
            $allEmail = explode(',',$emailData->mail_to);
            foreach ($allEmail as $email) {
                $mailToString = $email;
                $ccToString = $emailData->cc;
                $bccToString = $emailData->bcc;

                $ccToArray = array_filter(explode(',', $ccToString));
                $bccToArray = array_filter(explode(',', $bccToString));

                Mail::to($mailToString)
                    ->cc($ccToArray)
                    ->bcc($bccToArray)
                    ->send(new email_system($emailData,$email_from));

                $newDate = Carbon::parse($emailData->execution_time)->addDays($emailData->recurring_days);

                email_system_model::where('id', $emailData->id)->update([
                    'execution_time' => $newDate,
                ]);

                if ($emailData->repetition == 0) {
                    email_system_model::where('id', $emailData->id)->update([
                        'recurring_end' => $emailData->recurring_end - 1,
                    ]);
                }
            }
        }

        return "Emails sent successfully!";
    }
}
