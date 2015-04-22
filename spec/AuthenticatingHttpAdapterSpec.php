<?php

namespace spec\Indigo\HttpAdapter;

use Indigo\HttpAdapter\Authentication;
use Ivory\HttpAdapter\PsrHttpAdapterInterface;
use Ivory\HttpAdapter\Message\InternalRequestInterface;
use Ivory\HttpAdapter\Message\ResponseInterface;
use PhpSpec\ObjectBehavior;

class AuthenticatingHttpAdapterSpec extends ObjectBehavior
{
    function let(PsrHttpAdapterInterface $httpAdapter, Authentication $authentication)
    {
        $this->beConstructedWith($httpAdapter, $authentication);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\HttpAdapter\AuthenticatingHttpAdapter');
    }

    function it_sends_an_internal_request(
        InternalRequestInterface $request,
        InternalRequestInterface $authenticatedRequest,
        ResponseInterface $response,
        PsrHttpAdapterInterface $httpAdapter,
        Authentication $authentication
    ) {
        $authentication->authenticate($request)->willReturn($authenticatedRequest);
        $httpAdapter->sendRequest($authenticatedRequest)->willReturn($response);

        $this->sendRequest($request)->shouldReturn($response);
    }

    function it_sends_internal_requests(
        InternalRequestInterface $request1,
        InternalRequestInterface $request2,
        InternalRequestInterface $authenticatedRequest1,
        InternalRequestInterface $authenticatedRequest2,
        ResponseInterface $response1,
        ResponseInterface $response2,
        PsrHttpAdapterInterface $httpAdapter,
        Authentication $authentication
    ) {
        $authentication->authenticate($request1)->willReturn($authenticatedRequest1);
        $authentication->authenticate($request2)->willReturn($authenticatedRequest2);
        $httpAdapter->sendRequests([$authenticatedRequest1, $authenticatedRequest2])->willReturn([$response1, $response2]);

        $this->sendRequests([$request1, $request2])->shouldReturn([$response1, $response2]);
    }
}
