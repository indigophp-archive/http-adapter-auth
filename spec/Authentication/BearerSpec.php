<?php

namespace spec\Indigo\HttpAdapter\Authentication;

use Psr\Http\Message\RequestInterface;
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

    function it_does_not_accept_non_string_token()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetToken(null);
    }

    function it_authenticates_a_request(RequestInterface $request, RequestInterface $newRequest)
    {
        $request->withHeader('Authorization', 'Bearer token')->willReturn($newRequest);

        $this->authenticate($request)->shouldReturn($newRequest);
    }
}
