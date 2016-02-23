<?php
use Zingular\Forms\TestScenario;

ini_set('display_errors',1);
error_reporting(E_ALL);

/**
 * @param $varData
 */
function print_rf($varData)
{
    echo '<pre>';
    print_r($varData);
    echo '</pre>';
}

/**
 * Class ComponentTester
 */
class ComponentTester
{
    /**
     * @var string
     */
    protected $componentNsPrefixes;

    /**
     * @param bool $preload
     */
    public function __construct($preload = false)
    {
        // parse composer.json
        $composerJson = json_decode(file_get_contents('composer.json'));
        $this->componentNsPrefixes = $composerJson->autoload->{'psr-4'};

        // include the vendor auto loader
        include_once('vendor/autoload.php');

        // preload all classes, to make sure performance timers measure cleanly
        if($preload)
        {
            $this->preloadAll();
        }

        // fire up test scenario
        new TestScenario();
    }

    /**
     *
     */
    protected function preloadAll()
    {

        $dir_iterator = new RecursiveDirectoryIterator("src/");
        $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);


        foreach ($iterator as $file)
        {
            if(pathinfo($file,PATHINFO_EXTENSION) == 'php')
            {
                //var_dump(opcache_compile_file($file));
                //var_dump(opcache_is_script_cached($file));
                include_once($file);
            }

        }


    }
}

// start the component tester
new ComponentTester($preload = true);