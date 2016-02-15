<?php

namespace SVHexaTest\UploaderVSRF\Test;

use SVHexaTest\UploaderVSRF\uploaderClass as Uploader;

class ExampleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * check the boot loader on the expected value true
     */
    public function testUploaderTrue()
    {
        $testArray = [
          'https://www.wpclipart.com/page_frames/full_page_signs/Bold_signs/warning_sign_bold_T.png',
          'https://upload.wikimedia.org/wikipedia/commons/8/82/Facebook_icon.jpg',
          'http://33.media.tumblr.com/e853f5cb103e6290a4342442be239b68/tumblr_mmocik4ZSB1qk2fijo1_400.gif'
        ];
        $class = new Uploader();

        foreach ($testArray as $value) {
            $this->assertTrue($class->upload($value));
        }
    }

    /**
     * check the boot loader on the expected value false
     */
    public function testUploaderFalse()
    {
        $testArray = [
            'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSBecac1gmK9WXh0sylHu7rjItba-zFYmEuzu3Vczy-cnVbvw2C'
        ];
        $this->setExpectedException('Exception');
        $class = new Uploader();
        foreach ($testArray as $value) {
            $class->upload($value);
        }

    }

}
