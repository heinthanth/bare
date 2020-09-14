<?php

namespace heinthanth\bare\Routing;

use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use heinthanth\bare\Routing\Exception\InvalidCallbackException;
use heinthanth\bare\Routing\Exception\CallbackNotExistsException;

class CallbackHandler
{
    /**
     * Handle callback based on value ( callable or string ).
     * 
     * @param string|callback $callback Callback to be executed.
     * @param array $variable variables from to be passed.
     */
    public static function handleCallback($callback, array $variables)
    {
        // check for invokable class
        if (is_callable($callback)) {
            $invokable = new ReflectionFunction($callback);
            $invokable_parameter = $invokable->getNumberOfParameters();
            if ($invokable_parameter === 1) {
                return $invokable->invokeArgs([$variables]);
            } else if ($invokable_parameter === 0) {
                return $invokable->invoke();
            } else {
                throw new InvalidCallbackException();
            }
        } else if (class_exists($callback)) {
            $refclass = new ReflectionClass($callback);
            $class_constructor = $refclass->getConstructor();
            $class_constructor_param = $class_constructor ? $class_constructor->getNumberOfParameters() : 0;
            // if class has parameter, inject variable to constructor.
            if ($class_constructor_param === 1) {
                $obj = $refclass->newInstanceArgs([$variables]);
                try {
                    $invokable = $refclass->getMethod('__invoke');
                    $invokable_parameter = $invokable->getNumberOfParameters();
                    if ($invokable_parameter === 1) {
                        return $invokable->invokeArgs($obj, [$variables]);
                    } else if ($invokable_parameter === 0) {
                        return $invokable->invoke($obj);
                    } else {
                        throw new InvalidCallbackException();
                    }
                } catch (ReflectionException $e) {
                    throw new CallbackNotExistsException();
                }
            } else if ($class_constructor_param === 0) {
                $obj = $refclass->newInstanceArgs();
                try {
                    $invokable = $refclass->getMethod('__invoke');
                    $invokable_parameter = $invokable->getNumberOfParameters();
                    if ($invokable_parameter === 1) {
                        return $invokable->invokeArgs($obj, [$variables]);
                    } else if ($invokable_parameter === 0) {
                        return $invokable->invoke($obj);
                    } else {
                        throw new InvalidCallbackException();
                    }
                } catch (ReflectionException $e) {
                    throw new CallbackNotExistsException();
                }
            } else {
                throw new InvalidCallbackException();
            }
        } else  if (is_string($callback)) {
            $cb = explode("@", $callback, 2);
            if (count($cb) !== 2) throw new InvalidCallbackException();

            list($class, $method) = $cb;
            $class = class_exists($class) ? $class : "App\\Controller\\$class";

            if (!class_exists($class)) throw new InvalidCallbackException();

            $refclass = new ReflectionClass($class);
            $class_constructor = $refclass->getConstructor();
            $class_constructor_param = $class_constructor ? $class_constructor->getNumberOfParameters() : 0;
            // if class has parameter, inject variable to constructor.
            if ($class_constructor_param === 1) {
                $obj = $refclass->newInstanceArgs([$variables]);
                try {
                    $invokable = $refclass->getMethod($method);
                    $invokable_parameter = $invokable->getNumberOfParameters();
                    if ($invokable_parameter === 1) {
                        return $invokable->invokeArgs($obj, [$variables]);
                    } else if ($invokable_parameter === 0) {
                        return $invokable->invoke($obj);
                    } else {
                        throw new InvalidCallbackException();
                    }
                } catch (ReflectionException $e) {
                    throw new CallbackNotExistsException();
                }
            } else if ($class_constructor_param === 0) {
                $obj = $refclass->newInstanceArgs();
                try {
                    $invokable = $refclass->getMethod($method);
                    $invokable_parameter = $invokable->getNumberOfParameters();

                    if ($invokable_parameter === 1) {
                        return $invokable->invokeArgs($obj, [$variables]);
                    } else if ($invokable_parameter === 0) {
                        return $invokable->invoke($obj);
                    } else {
                        throw new InvalidCallbackException();
                    }
                } catch (ReflectionException $e) {
                    throw new CallbackNotExistsException();
                }
            } else {
                throw new InvalidCallbackException();
            }
        }
        // if something else
        throw new InvalidCallbackException();
    }
}
