<?php
namespace App\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    class PuppeteerCommand extends Command
    {
        protected static $defaultName = 'app:puppeteer';

        protected function configure()
        {
            $this
                ->setDescription('Exécute le script Puppeteer.')
                ->setHelp("Cette commande vous permet d\'exécuter le script Puppeteer.");
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            shell_exec('node puppeteer/index.js "https://smart-tribune-sandbox.ovh/subdomain/hackathon-laplateforme-2023/faq-success.html"', $output);
            return Command::SUCCESS;
        }
    }
?>