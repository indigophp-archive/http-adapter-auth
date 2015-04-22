<?php

/*
 * This file is part of the Indigo HttpAdapter Auth package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\HttpAdapter;

use Ivory\HttpAdapter\PsrHttpAdapterDecorator;
use Ivory\HttpAdapter\PsrHttpAdapterInterface;
use Ivory\HttpAdapter\Message\InternalRequestInterface;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class AuthenticatingHttpAdapter extends PsrHttpAdapterDecorator
{
    /**
     * @var Authentication
     */
    protected $authentication;

    /**
     * @param PsrHttpAdapterInterface $httpAdapter
     * @param Authentication          $authentication
     */
    public function __construct(PsrHttpAdapterInterface $httpAdapter, Authentication $authentication)
    {
        $this->authentication = $authentication;

        parent::__construct($httpAdapter);
    }

    /**
     * {@inheritdoc}
     */
    protected function doSendInternalRequest(InternalRequestInterface $internalRequest)
    {
        $internalRequest = $this->authentication->authenticate($internalRequest);

        return parent::doSendInternalRequest($internalRequest);
    }

    /**
     * {@inheritdoc}
     */
    protected function doSendInternalRequests(array $internalRequests)
    {
        foreach ($internalRequests as &$internalRequest) {
            $internalRequest = $this->authentication->authenticate($internalRequest);
        }

        return parent::doSendInternalRequests($internalRequests);
    }
}
