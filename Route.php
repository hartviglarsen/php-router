<?php

final class Route {
    public function __construct(
        public string $pattern,
        public string $callback,
        public string $method) { }
}
