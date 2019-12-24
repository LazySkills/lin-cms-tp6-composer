<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-12-24  */

namespace LinCmsTp6\command;


use think\console\Command;
use think\console\Input;
use think\console\Output;

class Init extends Command
{
    protected $type = "lincms";

    protected $output;

    protected function configure()
    {
        parent::configure();
        $this->setName('lincms:init')
            ->setDescription('init database file');
    }


    protected function execute(Input $input, Output $output)
    {
        $this->output = $output;
        $this->xCopy(__DIR__."/../database/",root_path().'/database/',1);
        $output->writeln('<info>' . $this->type . ': created successfully.</info>');
    }

    /**
     * @param $source
     * @param $destination
     * @param int $child 是否寻找子目录1寻找，0不寻找
     * @return int
     */
    public function xCopy($source, $destination, $child = 1){//用法：

        if(!is_dir($source)){
            $this->output->writeln('<error>' . $this->type . ':' . $source . ' dir already exists!</error>');
            return false;
        }
        if(!is_dir($destination)){
            mkdir($destination,0777,true);
        }
        $handle=dir($source);
        while($entry=$handle->read()) {
            if(($entry!=".")&&($entry!="..")){
                if(is_dir($source."/".$entry)){
                    if($child)
                        $this->xCopy($source."/".$entry,$destination."/".$entry,$child);
                }
                else{
                    copy($source."/".$entry,$destination."/".$entry);
                }
            }
        }
    }
}