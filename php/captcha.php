<?php
    function generate_field($width=150, $height=100){
        $img = imagecreate($width, $height);

        $bg = imagecolorallocate($img, 255, 255, 255);
        $textcolor = imagecolorallocate($img, 0, 0, 0);
        $noise = [
                    imagecolorallocate($img, 200, 200, 200),
                    imagecolorallocate($img, 0, 200, 200),
                    imagecolorallocate($img, 200, 200, 0),
                    imagecolorallocate($img, 200, 0, 200),
                ];

        imagefill($img, 0, 0, $bg);

        $text = random_string(5);
        
        //String -> Img
        imagettftext($img, $height/4, random_int(-18, 18), 20, $height/2, $textcolor, "font/arial.ttf",$text);
        
        //Noises the img
        for($x=0; $x<$width*$height/2; $x++) imagesetpixel($img, random_int(0, $width), random_int(0, $height), $noise[random_int(0, count($noise)-1)]);

        //Capturing img
        ob_start();
        imagepng($img);
        $obContents = ob_get_contents();
        ob_end_clean();
        imagedestroy($img);
        
        echo "<label for='captcha'>Captcha</label><br>";
        echo '<img src="data:image/png;base64,' . base64_encode($obContents) . '" /><br>';
        echo "<input type='text' placeholder='Captcha' name='captcha' required>";
        return $text;
    }

    function random_string($length){
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomString;
    }
?>