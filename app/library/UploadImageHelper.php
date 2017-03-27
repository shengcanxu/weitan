<?php


class UploadImageHelper {
    protected $imagine;
    protected $library;
    public $results = [];


    public function __construct()
    {
        if (!$this->imagine) {
        }
    }

    private function checkIsImage($image)
    {
        if (substr($image->getMimeType(), 0, 5) == 'image') {
            return true;
        } else {
            return false;
        }
    }

    public function upload($image)
    {
        $isImage = $this->checkIsImage($image);
        if ($image && $isImage) {
            $filename = md5($image->getClientOriginalName() . strtotime('now')) . '.' . $image->getClientOriginalExtension();
            $path = Config::get('uploadimage.path');

            $uploaded = $image->move($path, $filename);
            if ($uploaded) {
                $this->createDimensions($image,$filename);
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    protected function createDimensions($image,$filename)
    {
        Image::make($image)->resize(100,100)->save(Config::get('uploadimage.path') . '100-100/' . $filename);
        $a = 2;
    }

    private function resize($filesource, $suffix, $width, $height, $crop)
    {
        if (!$height) $height = $width;
        $suffix = trim($suffix);
        $path = $this->results['path'] . ($this->suffix == false ? '/'.trim($suffix,'/') : '');
        $name = $this->results['basename'] . ($this->suffix == true ? '_'.trim($suffix,'/') : '') . '.' . $this->results['original_extension'];
        $pathname = $path . '/' . $name;
        //print_r($width.' '.$height.' '.$crop);
        try
        {
            $isPathOk = $this->checkPathIsOk($this->results['path'],($this->suffix == false ? $suffix : ''));
            if ($isPathOk)
            {
                $size = new \Imagine\Image\Box($width, $height);
                $mode = $crop ? \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND : \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                $newfile = $this->imagine->open($filesource)->thumbnail($size, $mode)->save($pathname,['quality'=>$this->quality]);
                list($nwidth, $nheight) = getimagesize($pathname);
                $filesize = filesize($pathname);
                $this->results['dimensions'][$suffix] = [
                    'path' => $path,
                    'dir' => str_replace(public_path().'/', '', $path),
                    'filename' => $name,
                    'filepath' => $pathname,
                    'filedir' => str_replace(public_path().'/', '', $pathname),
                    'width' => $nwidth,
                    'height' => $nheight,
                    'filesize' => $filesize,
                ];
            }
        }
        catch (\Exception $e)
        {
        }
    }

}
