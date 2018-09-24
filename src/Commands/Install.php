<?php

namespace RefinedDigital\SocialMedia\Commands;

use Illuminate\Console\Command;
use Validator;
use Artisan;
use DB;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refinedCMS:install-social-media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the social media module';

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
        $this->migrate();
        $this->info('Social Media has been successfully installed');
    }


    protected function migrate()
    {
        $this->output->writeln('<info>Migrating the database</info>');
        Artisan::call('migrate', [
            '--path' => 'vendor/refineddigital/cms-social-media/src/Database/Migrations',
            '--force' => 1,
        ]);
    }

}
