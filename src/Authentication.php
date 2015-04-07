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

use Psr\Http\Message\RequestInterface;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Authentication
{
    /**
     * Authenticates a request
     *
     * @param RequestInterface $request
     *
     * @return RequestInterface
     */
    public function authenticate(RequestInterface $request);
}
