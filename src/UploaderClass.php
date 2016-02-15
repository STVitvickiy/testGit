<?php

namespace Uploader;

/**
 * Class uploaderClass
 * @package Uploader
 */
class uploaderClass extends \FileSistem\FilesClass
{
    /**
     * @var array Acceptable formats for the default boot
     */
    protected $aImgFormat = ['jpg', 'png', 'gif'];

    /**
     * @var string Saving directory files by default
     */
    protected $sDirSaveImg = 'upload';

    /**
     * @var int The allowable size of the default file
     */
    protected $iImgSize = 5000000;

    /**
     * Create a new Uploader Instance
     */
    public function __construct()
    {
    }

    /**
     * This method gives the list of the possible formats
     *
     * array format [
     *                  type1,
     *                  type2,
     *                  type3
     *              ]
     *
     * @param array $aFormat
     */
    public function setFormatUpload($aFormat){
     $this->aImgFormat = $aFormat;
    }

    /**
     * This method specifies the name of the directory in which the files will be saved
     *
     * @param string $sDir
     */
    public function setDirNameUpload($sDir){
        $this->sDirSaveImg = $sDir;
    }

    /**
     * This method gives the maximum file size for download
     *
     * @param int $iMax
     */
    public function setMaxImgSize($iMax){
        $this->iImgSize = $iMax;
    }

    public function setModeSave($mode = true){
        $this->bMode = $mode;
    }

    /**
     * This method allows you to upload a picture from a remote server
     *
     * @var array $aHeaders headers sent by the server in response to a HTTP request
     * @var array $aFile information about a file
     * @var string $sExtension extension file
     * @var $iSize size file
     * @var bool $bUploadCheck The result of the recording of the file server. The returned variable
     *
     * @param string $sLinkToFile
     * @return string
     */
    public function upload($sLinkToFile)
    {
        try{
            $aHeaders = @get_headers($sLinkToFile);
            if($aHeaders === false){
                throw new \Exception('The file could not be retrieved');
            }
            if(preg_match("|200|", $aHeaders[0]) == false){
                throw new \Exception('The file could not be retrieved');
            }

            $aFile =  pathinfo($sLinkToFile);
            if(!isset($aFile['extension'])){
                throw new \Exception('Unable to get format');
            }
            $sExtension = $aFile['extension'];
            preg_match("/[0-9]+/", $aHeaders[4],$aFileSize);


            if(!in_array($sExtension,$this->aImgFormat)){
                throw new \Exception('An invalid format');
            }

            if(!isset($aFileSize[0]) && $sExtension != 'gif'){
                throw new \Exception('Unable to get the file size');
            }

            if($sExtension == 'gif'){
                $iSize =  strlen(file_get_contents($sLinkToFile));
            }else{
                $iSize = $aFileSize[0];
            }

            if($iSize > $this->iImgSize){
                throw new \Exception('The file is too large. The allowable size '.$this->iImgSize.' byte');
            }
            $bUploadCheck = $this->save($this->sDirSaveImg,$sLinkToFile);
            return  $bUploadCheck;
        }catch(\Exception $error){
            return "Exception: ".$error->getMessage();
        }
    }


}
