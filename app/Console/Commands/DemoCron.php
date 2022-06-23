<?php

   

namespace App\Console\Commands;

   

use Illuminate\Console\Command;

   

class DemoCron extends Command

{

    /**

     * Название и подпись команды.

     *

     * @var string

     */

    protected $signature = 'demo:cron';

    

    /**

     * Описание консольной команды.

     *

     * @var string

     */

    protected $description = 'Command description';

    

    /**

     * Создание новой команды.

     *

     * @return void

     */

    public function __construct()

    {

        parent::__construct();

    }

    

    /**

     * Исполнение консольной команды.

     *

     * @return mixed

     */

    public function handle()

    {

        \Log::info("Cron is working fine!");

    }

}