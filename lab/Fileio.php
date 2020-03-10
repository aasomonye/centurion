<?php
namespace WekiWork;

class Fileio
{
    // manage file upload locally
    private $files = [];
    private $asRefrence = false;
    private $waiting = [];

    // check from
    // @param : Mixed $data
    public function from($data) : Fileio
    {
        if (is_object($data))
        {
            $this->files = &$data;
            $this->asRefrence = true;
        }
        else
        {
            $this->files = $data;
        }

        return $this;
    }

    // listen for upload
    public function upload() : Fileio
    {
        $names = func_get_args();
        
        if (count($names) > 0)
        {
            $data = $this->files;

            if (count($data) == 0)
            {
                $data = $_FILES;
            }

            array_walk($names, function($key) use ($data)
            {
                if (is_object($data))
                {
                    $this->waiting[$key] = $data->{$key};
                }
                else
                {
                    if (isset($data[$key]))
                    {
                        $this->waiting[$key] = $data[$key];
                    }
                }
            }); 
        }

        return $this;
    }

    // single upload mechanisim
    public function singleUpload(string $filename, array $file) : Fileio
    {
        // add file to waiting list
        $this->waiting[$filename] = $file;

        // return
        return $this;
    }

    // move to destination folder
    public function to($destination, $callback=null) : array
    {
        $uploads = [];

        if (count($this->waiting) > 0)
        {
            foreach ($this->waiting as $key => $data)
            {
                if (is_array($data))
                {
                    if (isset($data['name']) && !is_array($data['name']))
                    {
                        $name = $data['name'];

                        // check if directory exists
                        if (is_dir($destination))
                        {
                            // get extension
                            $extension = $this->getExtension($name);

                            // hash filename
                            $filename = sha1($name).'.'.$extension;

                            if (move_uploaded_file($data['tmp_name'], $destination . '/'. $filename))
                            {
                                $uploads[$key]['code'] = 200;
                                $uploads[$key]['status'] = 'Success';
                                $uploads[$key]['size'] = $data['size'];

                                if (is_callable($callback) && $callback !== null)
                                {
                                    call_user_func_array($callback, [$key, str_replace('//', '/', $destination . '/'. $filename), $filename]);
                                }
                            }
                        }
                        else
                        {
                            $uploads[$key]['status'] = 'Destination folder doesn\'t exists.';
                            $uploads[$key]['code'] = 0;
                        }
                    }
                    elseif (isset($data['name']) && is_array($data['name']))
                    {
                        // check if directory exists
                        if (is_dir($destination))
                        {
                            foreach ($data['name'] as $index => $name)
                            {
                                // get extension
                                $extension = $this->getExtension($name);

                                // hash filename
                                $filename = sha1($name).'.'.$extension;
                                if (move_uploaded_file($data['tmp_name'][$index], $destination . '/'. $filename))
                                {
                                    $uploads[$key]['code'] = 200;
                                    $uploads[$key]['status'] = 'Success';
                                    $uploads[$key]['size'] = $data['size'][$index];

                                    if (is_callable($callback) && $callback !== null)
                                    {
                                        call_user_func_array($callback, [$key, str_replace('//', '/', $destination . '/'. $filename), $filename]);
                                    }
                                }
                            }
                        }
                        else
                        {
                            $uploads[$key]['status'] = 'Destination folder doesn\'t exists.';
                            $uploads[$key]['code'] = 0;
                        }
                    }
                }
            }
        }

        return $uploads;
    }
    // -end file upload locally

    // get file extenstion
    public function getExtension(string $filename) : string
    {
        $extension = strrpos($filename, '.');
        $extension = substr($filename, $extension+1);
        return $extension;
    }
}