<?php

namespace FileSistemVSRF;

/**
 * Class FilesClass
 * @package FileSistem
 */
class FilesClass
{
    /**
     * @var bool The flag, if true file generated unique name, if false the file is overwritten False
     */
    public $bMode = true;

    /**
     * Create a new FilesClass Instance
     */
    public function __construct()
    {
    }

    /**
     * @param bool $mode The flag, if true file generated unique name, if false the file is overwritten False
     */
    public function setModeSave($mode = true){
        $this->bMode = $mode;
    }

    /**
     * Method saves the file to the original resolution in the specified directory
     *
     * @var array $aFile information about a file
     * @var string $sLocal the name and path of the file on which it will be saved
     * @var bool $bCheckPutContent File recording flag. Return value
     *
     * @param string $dir The directory where the file is saved
     * @param string $file Reference to file to save
     *
     * @return bool
     */
    public function save($dir,$file){
        try{
            if(file_exists($dir) === false){
               $bCheck = mkdir($dir,0777);
                if($bCheck === false){
                    throw new \Exception('Could not create directory: '.$dir);
                }
            }
            $content = file_get_contents($file);
            if($content === false){
                throw new \Exception('Data File not received: '.$file);
            }
            $aFile =  pathinfo($file);
            if($this->bMode === true){
                $sLocal = $dir.'/'.$filename = substr(md5(microtime() . rand(0, 9999)), 0, 20);
                $sLocal .= '.'.$aFile['extension'];
            }else{
                $sLocal = $dir.'/'.$aFile['basename'];
            }
            $bCheckPutContent = file_put_contents($sLocal,$content);
            if($bCheckPutContent === false){
                throw new \Exception('File is not recorded');
            }else{
                return true;
            }
        }catch(\Exception $error){
            return "Exception: ".$error->getMessage();
        }
    }
}
