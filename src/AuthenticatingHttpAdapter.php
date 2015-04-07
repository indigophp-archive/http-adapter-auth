<?php

/*
 * This file is part of the Indigo HttpAdapter package.
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
    protected function sendInternalRequest(InternalRequestInterface $internalRequest)
    {
        $internalRequest = $this->authentication->authenticate($internalRequest);

        return parent::sendInternalRequest($internalRequest);
    }

    /**
     * {@inheritdoc}
     */
    protected function sendInternalRequests(array $internalRequests, $success, $error)
    {
        foreach ($internalRequests as &$internalRequest) {
            $internalRequest = $this->authentication->authenticate($internalRequest);
        }

        return parent::sendInternalRequests($internalRequests, $success, $error);
    }
}
