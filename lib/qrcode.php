<?php

class qrcode
{
    protected $image;
    protected $width;           //验证码宽度
    protected $height;         //验证码高度
    protected $length;       //验证码长度
    protected $type;           //1为数字类型验证码 2为字母类型验证码  3为数字加字母组合类型验证码

    public function __construct($width = 200, $height = 50)
    {

        $this->width = $width;
        $this->height = $height;
        $image = imagecreatetruecolor($width, $height);
        $this->image = $image;
    }

    //获得验证码
    public function createCode($type = 1, $length = 4)
    {


        $this->type = $type;
        $this->length = $length;
        $str = $this->createStr(); //获得验证码字符串
        $backgroundcolor = imagecolorallocate($this->image, 255, 255, 255);//生成背景色
        imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $backgroundcolor);//填充背景色
        $fontfile = __DIR__ . '/font/consolaz.ttf';
        $fontsize = mt_rand(18, 24);
        $fontWidth = imagefontwidth($fontsize);
        $fontHeight = imagefontheight($fontsize);
        for ($i = 0; $i < $length; $i++) {
            $angle = mt_rand(-15, 15);
            $whiteColor = $this->getRandColor();
            $text = substr($str, $i, 1);
            $x = $fontWidth + (($this->width) / $length) * $i + 10;
            $y = $fontHeight + ($this->height) / 2;

            imagettftext($this->image, $fontsize, $angle, $x, $y, $whiteColor, $fontfile, $text);
        }
        header('content-Type:image/png');
        imagepng($this->image);
        imagedestroy($this->image);
    }

    //生成随机字符串
    public function createStr()
    {
        $type = $this->type;
        if ($type == 1) {
            $min = pow(10, $this->length - 1);
            $max = pow(10, $this->length) - 1;
            $str = mt_rand($min, $max);
            return $str;
        }
        if ($type == 2) {
            $string = implode('', array_merge(range('a', 'z'), range('A', 'Z')));
            $string = str_shuffle($string);
            $str = substr($string, 0, $this->length);
        }
        if ($type == 3) {
            $string = implode('', array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9)));
            $string = str_shuffle($string);
            $str = substr($string, 0, $this->length);
        }
        return $str;
    }

    //获得随机颜色
    public function getRandColor()
    {
        $color = imagecolorallocate($this->image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        return $color;
    }

    public function thumb($width=200,$height=200){
        $fileName=__DIR__.'/images/1.jpg';

        $fileInfo=getimagesize($fileName);
        if(!isset($fileInfo['mime'])) return false;
        $imagetype=explode('/',$fileInfo['mime']);
        if($imagetype[1]=='jpg'){
            $src_image=imagecreatefromjpeg($fileName);
        }
        if($imagetype[1]=='png'){
            $src_image=imagecreatefrompng($fileName);
        }
        if($imagetype[1]=='gif'){
            $src_image=imagecreatefromgif($fileName);
        }
        //获取原始画布资源的长，宽
        list($src_w,$src_h)=$fileInfo;

        //创建目标画布的长，高
        $dst_image=imagecreatetruecolor($width,$height);
//        imagecopyresampled($dst_image,)
        var_dump($fileInfo);exit;
    }
}