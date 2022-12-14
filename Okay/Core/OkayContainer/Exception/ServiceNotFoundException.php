<?php

namespace Okay\Core\OkayContainer\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * The ServiceNotFoundException is thrown when the container is asked to provide
 * a service that has not been defined.
 */
class ServiceNotFoundException extends \Exception implements NotFoundExceptionInterface {}
