<?php

/*
 * This file is part of the Indigo HttpAdapter Auth package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\HttpAdapter\Authentication;

use Assert\Assertion;
use Indigo\HttpAdapter\Authentication;
use Psr\Http\Message\RequestInterface;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Matching implements Authentication
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @var callable
     */
    private $matcher;

    /**
     * @param Authentication $authentication
     * @param mixed          $matcher
     */
    public function __construct(Authentication $authentication, callable $matcher = null)
    {
        if (is_null($matcher)) {
            $matcher = function() {
                return true;
            };
        }

        $this->authentication = $authentication;
        $this->matcher = $matcher;
    }

    /**
     * Returns the authentication
     *
     * @return string
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * Sets the authentication
     *
     * @param Authentication $authentication
     */
    public function setAuthentication(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * Returns the matcher
     *
     * @return callable
     */
    public function getMatcher()
    {
        return $this->matcher;
    }

    /**
     * Sets the matcher
     *
     * @param callable $matcher
     */
    public function setMatcher(callable $matcher)
    {
        $this->matcher = $matcher;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request)
    {
        if (!call_user_func($this->matcher, $request)) {
            return $request;
        }

        return $this->authentication->authenticate($request);
    }

    /**
     * Creates a matching authentication for an URL
     *
     * @param Authentication $authentication
     * @param string         $url
     *
     * @return self
     */
    public function createUrlMatcher(Authentication $authentication, $url)
    {
        Assertion::string($url);

        $matcher = function($request) use ($url) {
            return preg_match($url, (string) $request->getUri());
        };

        return new static($authentication, $matcher);
    }
}
