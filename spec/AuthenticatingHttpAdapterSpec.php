<?php

namespace spec\Indigo\HttpAdapter;

use PhpSpec\ObjectBehavior;

class AuthenticatingHttpAdapterSpec extends ObjectBehavior
{
    /**
     * @param Ivory\HttpAdapter\PsrHttpAdapterInterface $httpAdapter
     * @param Indigo\HttpAdapter\Authentication $authentication
     */
    function let($httpAdapter, $authentication)
    {
        $this->beConstructedWith($httpAdapter, $authentication);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\HttpAdapter\AuthenticatingHttpAdapter');
    }

    /**
     * @param Ivory\HttpAdapter\Message\InternalRequestInterface $request
     * @param Ivory\HttpAdapter\Message\InternalRequestInterface $authenticatedRequest
     * @param Ivory\HttpAdapter\Message\ResponseInterface        $response
     * @param Ivory\HttpAdapter\PsrHttpAdapterInterface          $httpAdapter
     * @param Indigo\HttpAdapter\Authentication                  $authentication
     */
    function it_sends_an_internal_request(
        $request,
        $authenticatedRequest,
        $response,
        $httpAdapter,
        $authentication
    ) {
        $authentication->authenticate($request)->willReturn($authenticatedRequest);
        $httpAdapter->sendRequest($authenticatedRequest)->willReturn($response);

        $this->sendRequest($request)->shouldReturn($response);
    }

    /**
     * @param Ivory\HttpAdapter\Message\InternalRequestInterface $request1
     * @param Ivory\HttpAdapter\Message\InternalRequestInterface $request2
     * @param Ivory\HttpAdapter\Message\InternalRequestInterface $authenticatedRequest1
     * @param Ivory\HttpAdapter\Message\InternalRequestInterface $authenticatedRequest2
     * @param Ivory\HttpAdapter\Message\ResponseInterface        $response1
     * @param Ivory\HttpAdapter\Message\ResponseInterface        $response2
     * @param Ivory\HttpAdapter\PsrHttpAdapterInterface          $httpAdapter
     * @param Indigo\HttpAdapter\Authentication                  $authentication
     */
    function it_sends_internal_requests(
        $request1,
        $request2,
        $authenticatedRequest1,
        $authenticatedRequest2,
        $response1,
        $response2,
        $httpAdapter,
        $authentication
    ) {
        $authentication->authenticate($request1)->willReturn($authenticatedRequest1);
        $authentication->authenticate($request2)->willReturn($authenticatedRequest2);
        $httpAdapter->sendRequests([$authenticatedRequest1, $authenticatedRequest2])->willReturn([$response1, $response2]);

        $this->sendRequests([$request1, $request2])->shouldReturn([$response1, $response2]);
    }
}
