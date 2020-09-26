<?php

class ClassLoader
{
    protected $dirs;

    /**
     * 自身をオートロードスタックに登録
     */
    public function register()
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * オートロード対象のディレクトリを登録
     *
     * @param string $dir
     */
    public function registerDir($dir)
    {
        $this->dirs[] = $dir;
    }

    /**
     * クラスを読み込む
     *
     * @param string $class
     */
    public function loadClass($class)
    {
        foreach ($this->dirs as $dir) {
            // var_dump($this->dirs);
            $file = $dir . '/' . $class . '.php';
            // var_dump($file);
            print_r($file. PHP_EOL);
            if (is_readable($file)) {
                require $file;

                return;
            }
        }
    }
}
