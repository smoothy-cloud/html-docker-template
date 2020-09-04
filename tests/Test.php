<?php

namespace Tests;

use SmoothyCloud\ApplicationTemplateValidator\Testing\Browser\Browser;
use SmoothyCloud\ApplicationTemplateValidator\Testing\TemplateTest;

class Test extends TemplateTest
{
    /** @test */
    public function the_syntax_of_the_template_is_correct()
    {
        $this->validateTemplate();
    }

    /** @test */
    public function the_image_files_can_be_parsed()
    {
        $imageFiles = $this->parseImageFiles([]);
        $this->assertParsedImageFilesMatchFolderContents($imageFiles, __DIR__ . "/concerns/result");
    }

    /** @test */
    public function the_application_works_correctly_when_deployed()
    {
        $this->deployApplication([
            'html_application' => __DIR__ . "/concerns/application",
        ]);

        $this->assertApplicationWorksCorrectly();
    }

    private function assertApplicationWorksCorrectly(): void
    {
        $browser = new Browser('http://localhost:10000');

        $browser->visit('/');
        $this->assertTrue($browser->pathIs('/'));
        $this->assertTrue($browser->see("You are viewing the home page."));

        $browser->visit('/index.html');
        $this->assertTrue($browser->pathIs('/'));
        $this->assertTrue($browser->see("You are viewing the home page."));

        $browser->visit('/hello');
        $this->assertTrue($browser->pathIs('/hello'));
        $this->assertTrue($browser->see("You are viewing the hello page."));

        $browser->visit('/hello.html');
        $this->assertTrue($browser->pathIs('/hello'));
        $this->assertTrue($browser->see("You are viewing the hello page."));

        $browser->visit('/hello/team');
        $this->assertTrue($browser->pathIs('/hello/team'));
        $this->assertTrue($browser->see("You are viewing the team page."));

        $browser->visit('/hello/team.html');
        $this->assertTrue($browser->pathIs('/hello/team'));
        $this->assertTrue($browser->see("You are viewing the team page."));

        $browser->visit('/baz');
        $this->assertTrue($browser->pathIs('/baz'));
        $this->assertTrue($browser->see("Woops, page not found!"));
    }
}
