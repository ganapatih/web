<?php

class ApiTest extends TestCase {

    /**
     * @test
     */
    function it_able_to_get_token()
    {
        $response = $this->call('GET', 'api/token');

        $this->assertResponseOk();

        $content = $response->getContent();

        $this->assertJson($content);

        $this->assertArrayHasKey('_token', json_decode($content, true));

        $token = json_decode($content, true);
        return $token['_token'];
    }

    /**
     * @test
     * @depends it_able_to_get_token
     */
    function it_able_to_register($token)
    {
        $response = $this->call('POST', 'api/korban', ['_token' => $token]);

        $this->assertResponseOk();

        $content = $response->getContent();

        $this->assertJson($content);

        $this->assertArrayHasKey('success', json_decode($content, true));
    }

    /**
     * @test
     * @depends it_able_to_get_token
     */
    function it_able_to_post_korban($token)
    {
        // $response = $this->call('POST', 'api/korban', ['_token' => $token]);
        $response = $this->call('POST', 'api/korban', ['_token' => $token]);

        $this->assertResponseOk();

        $content = $response->getContent();

        $this->assertJson($content);

        $this->assertArrayHasKey('success', json_decode($content, true));
    }

    /**
     * @test
     * @depends it_able_to_get_token
     */
    function it_able_to_post_relawan($token)
    {
        $response = $this->call('POST', 'api/relawan', ['_token' => $token]);

        $this->assertResponseOk();

        $content = $response->getContent();

        $this->assertJson($content);

        $this->assertArrayHasKey('success', json_decode($content, true));
    }
}
