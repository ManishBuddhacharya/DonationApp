<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class MailTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testEmail()
    {
        $this->visit('email/verify')
             ->seeEmailWasSent()
             ->seeEmailSubject('Hello World')
             ->seeEmailTo('foo@bar.com')
             ->seeEmailEquals('Click here to buy this jewelry.')
             ->seeEmailContains('Click here');
    }
}
