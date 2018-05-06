<?php

class Thumb{
    private $thumbWidth;//缩略图的宽
    private $thumbHeight;//缩略图的高
    private $thumbPath;//缩略图的保存路径

    private $sourcePath;//原图的路径
    private $sourceWidth;//原图的宽度
    private $sourceHeight;//原图的高度
    private $sourceType;//原图的类型


    //初始化
    public function __construct($sourcePath,$thumbpath,$thumbWidth=200,$thumbHeight=200)
    {
        //设置原图像的路径
        $this->sourcePath=$sourcePath;
        //设置缩略图的宽度高度
        $this->thumbWidth=$thumbWidth;
        $this->thumbHeight=$thumbHeight;
       $this->thumbPath=$this->getThubmPpath($thumbpath);
      list($this->sourceWidth,$this->sourceHeight,$this->sourceType)=getimagesize($sourcePath);
    }

    //获取缩略图的保存路径
    public function getThubmPpath($thumbpath){
        $ext=$this->getExt();
        $filename = basename($this->sourcePath,'.'.$ext).'_thumb'.'.'.$ext;
        $filePath=$thumbpath.'/'.$filename;
        return $filePath;
    }

    //获取原图的格式
    public function getExt(){
      $ext=pathinfo($this->sourcePath,PATHINFO_EXTENSION );
     return $ext;
    }

    //检测原图类型
    public function getType(){
        $arr=[
            1=>'git',
            2=>'jpeg',
            3=>'png',
            15=>'wbmp'
        ];

        if(!in_array($this->sourceType,array_keys($arr))){
            return false;
        }
        return $arr[$this->sourceType];
    }

    public function createThumb(){
        if(!$type=$this->getType()){
            return false;
        }
        $method='imagecreatefrom'.$type;
        //拷贝原图像
        $thumbimage=$method($this->sourcePath);


    }
}