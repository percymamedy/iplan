<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Iplan\Entity\AccountStatus;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test that the registration works when correcty input is given.
     *
     * @return void
     */
    public function testRegistrationWithCorrectInputsRegistrationOK()
    {
        $this->post('register', [
            'first_name'            => 'Ashni',
            'last_name'             => 'Sukhoo',
            'email'                 => 'ashni@email.com',
            'password'              => 'secret',
            'password_confirmation' => 'secret',
        ]);
        
        $this->assertRedirectedTo('/')
             ->seeInDatabase('users', [
                 'first_name'        => 'Ashni',
                 'last_name'         => 'Sukhoo',
                 'email'             => 'ashni@email.com',
                 'account_status_id' => AccountStatus::whereStatus('unconfirmed')->firstOrFail()->id,
             ]);
    }
}