<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CSVImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CSV:Import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = [];

        $this->getUsersProductsFromCsvFiles($users);

        $this->createUsersProducts($users);

        $this->sendResultEmailToUsers($users);
    }

    private function getUsersProductsFromCsvFiles(&$users)
    {
        $products = [];
        foreach (\App\User::get() as $user) {
            if(count($user->media)) {
                foreach ($user->media as $media) {
                    $csvArray = $this->csvToArray($media->getPath());
                    $products = array_merge($products, $csvArray);
                    $media->delete();
                }
                $users[$user->email] = $products;
            }
        }
    }

    private function createUsersProducts(&$users) 
    {
        $success = 0;
        $failures = 0;
        foreach ($users as $email => $products) {
            foreach ($products as $product_params) {
                $product = new \App\Product();

                $product_params_is_valid = $product->validate($product_params);
                
                if ($product_params_is_valid) {
                    $product->create($product_params);
                    $success++;
                } else {
                    $failures++;
                }
            }
            $results['success'] = $success;
            $results['failures'] = $failures;
            $results['total'] = $success + $failures;
            $users[$email] = $results;
        }
    }

    private function sendResultEmailToUsers($users) {
        foreach ($users as $email => $result) {
            $user = \App\User::whereEmail($email)->first();
            if ($user)
                \Mail::send('emails.send', ['result' => $result, 'user' => $user], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Dev Squad: Your scheduled import');
                });
        }
    }

    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false){
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false){
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
