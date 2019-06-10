<?php

class ImageManager
{
        private $_uploadFile = 'assets/images/uploads/';


        public function addImage($image)
        {
                $extension = pathinfo($image['name'])['extension'];
                $date = date("smhYmd");
                $imageName = $date.$image["name"];
                $file = $this->_uploadFile;
                                                
                move_uploaded_file($image['tmp_name'], $file.$imageName);
                        
                
                $this->cloneImage($extension, $imageName, 100, 's');//create a Small copy
                $this->cloneImage($extension, $imageName, 500, 'm');//create a Medium copy
                $this->cloneImage($extension, $imageName, 700, 'l');//create a Large copy

                return $imageName;
        }
                
        public function deleteImage($imageName)
        {
                $file = $this->_uploadFile;
                unlink($file.$imageName);
                unlink($file .'s'. $imageName);
                unlink($file .'m'. $imageName);
                unlink($file .'l'. $imageName);
               
        }
        private function cloneImage($extension, $imageName, $width, $prefixe)
        {
                $file = $this->_uploadFile;
                if ($extension == "png")
                {
                        $source = imagecreatefrompng($file.$imageName); 
                        $width_source = imagesx($source);
                        $height_source = imagesy($source);
                        $destination = imagecreatetruecolor($width, $width * $height_source / $width_source); 

                        $width_destination = imagesx($destination);
                        $height_destination = imagesy($destination);

                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $width_destination, $height_destination, $width_source, $height_source);

                        imagepng($destination, $file.$prefixe.$imageName);
                        imageDestroy($destination);
                        
                }

                else
                {
                        $source = imagecreatefromjpeg($file.$imageName); 
                        $width_source = imagesx($source);
                        $height_source = imagesy($source);
                        $destination = imagecreatetruecolor($width, $width * $height_source / $width_source); 

                        
                        $width_destination = imagesx($destination);
                        $height_destination = imagesy($destination);

                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $width_destination, $height_destination, $width_source, $height_source);

                        imagejpeg($destination, $file.$prefixe.$imageName);
                        imageDestroy($destination);
                }
        }
}

                