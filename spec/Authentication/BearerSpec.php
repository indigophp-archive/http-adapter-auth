<?php

namespace spec\Indigo\HttpAdapter\Authentication;

use PhpSpec\ObjectBehavior;

class BearerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('token');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\HttpAdapter\Authentication\Bearer');
    }

    function it_has_a_token()
    {
        $this->getToken()->shouldReturn('token');
    }

    function it_accepts_a_token()
    {
        $this->setToken('another_token');

        $this->getToken()->shouldReturn('another_token');
    }

    /**
     * @param Psr\Http\Message\RequestInterface $request
     * @param Psr\Http\Message\RequestInterface $newRequest
     */
    function it_authenticates_a_request($request, $newRequest)
    {
        $request->withHeader('Authorization', 'Bearer token')->willReturn($newRequest);

        $this->authenticate($request)->shouldReturn($newRequest);
    }
}
