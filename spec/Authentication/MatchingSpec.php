<?php

namespace spec\Indigo\HttpAdapter\Authentication;

use PhpSpec\ObjectBehavior;

class MatchingSpec extends ObjectBehavior
{
    private $matcher;

    /**
     * @param Indigo\HttpAdapter\Authentication $authentication
     */
    function let($authentication)
    {
        $this->matcher = function($request) { return true; };

        $this->beConstructedWith($authentication, $this->matcher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\HttpAdapter\Authentication\Matching');
    }

    /**
     * @param Indigo\HttpAdapter\Authentication $authentication
     */
    function it_has_an_authentication($authentication)
    {
        $this->getAuthentication()->shouldReturn($authentication);
    }

    /**
     * @param Indigo\HttpAdapter\Authentication $anotherAuthentication
     */
    function it_accepts_an_authentication($anotherAuthentication)
    {
        $this->setAuthentication($anotherAuthentication);

        $this->getAuthentication()->shouldReturn($anotherAuthentication);
    }

    function it_has_a_matcher()
    {
        $this->getMatcher()->shouldReturn($this->matcher);
    }

    function it_accepts_a_matcher()
    {
        $matcher = function($request) { return false; };

        $this->setMatcher($matcher);

        $this->getMatcher()->shouldReturn($matcher);
    }

    /**
     * @param Indigo\HttpAdapter\Authentication $authentication
     * @param Psr\Http\Message\RequestInterface $request
     * @param Psr\Http\Message\RequestInterface $newRequest
     */
    function it_authenticates_a_request($authentication, $request, $newRequest)
    {
        $authentication->authenticate($request)->willReturn($newRequest);

        $this->authenticate($request)->shouldReturn($newRequest);
    }

    /**
     * @param Indigo\HttpAdapter\Authentication   $authentication
     * @param Psr\Http\Message\RequestInterface $request
     */
    function it_does_not_authenticate_a_request($authentication, $request)
    {
        $matcher = function($request) { return false; };

        $this->setMatcher($matcher);

        $authentication->authenticate($request)->shouldNotBeCalled();

        $this->authenticate($request)->shouldReturn($request);
    }

    /**
     * @param Indigo\HttpAdapter\Authentication $authentication
     */
    function it_creates_a_matcher_from_url($authentication)
    {
        $this->createUrlMatcher($authentication, 'url')->shouldHaveType('Indigo\HttpAdapter\Authentication\Matching');
    }
}
