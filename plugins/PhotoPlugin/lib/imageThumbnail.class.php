<?php

class imageThumbnail {

    public $ancho;
    public $alto;

    public function __construct($ancho=100, $alto=100) {
        $this->ancho = $ancho;
        $this->alto = $alto;
    }

    private function createFrom($src) {
        $valores = explode(".", $src);
        $extension = $valores[count($valores) - 1];
        switch ($extension) {
            case 'jpg':
                $tmp = imagecreatefromjpeg($src);
                break;
            case 'gif':
                $tmp = imagecreatefromgif($src);
                break;
            case 'png':
                $tmp = imagecreatefrompng($src);
                break;
        }
        return $tmp;
    }

    public function generate($src, $dest='') {
        list($ancho, $alto) = getimagesize($src);
        if (($menor = min($this->ancho / $ancho, $this->alto / $alto)) < 1) {
            $tmp = self::createFrom($src);
            $n_ancho = floor($menor * $ancho);
            $n_alto = floor($menor * $alto);
            $img = imagecreatetruecolor($n_ancho, $n_alto);
            imagecopyresized($img, $tmp, 0, 0, 0, 0, $n_ancho, $n_alto, $ancho, $alto);
            imagedestroy($tmp);
        } else {
            $img = self::createFrom($src);
        }
        if ($dest) {
            imagejpeg($img, $dest, 80);
            imagedestroy($img);
        } else {
            return $img;
        }
    }

    public function recorta($src, $coords=null, $dest='') {
        list($ancho, $alto) = getimagesize($src);
        $n_ancho = ($coords != null) ? $coords['x2'] - $coords['x1'] : $ancho;
        $n_alto = ($coords != null) ? $coords['y2'] - $coords['y1'] : $alto;
        $img = imagecreatetruecolor($this->ancho, $this->alto);
        $tmp = self::createFrom($src);
        $dst_x = 0;
        $dst_y = 0;
        $src_x = $coords['x1'];
        $src_y = $coords['y1'];
        $dst_w = $this->ancho;
        $dst_h = $this->alto;
        $src_w = $n_ancho;
        $src_h = $n_alto;
        imagecopyresampled($img, $tmp, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
        imagedestroy($tmp);
        if ($dest) {
            imagejpeg($img, $dest, 80);
            imagedestroy($img);
        } else {
            return $img;
        }
    }

}

?>
