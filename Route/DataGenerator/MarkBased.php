<?php

namespace Bootlace\Route\DataGenerator;

class MarkBased extends AbstractRegexBased
{
    protected function getApproxChunkSize()
    {
        return 30;
    }

    protected function processChunk($regexToRoutesMap)
    {
        $routeMap = [];
        $regexes = [];
        $markName = 'a';
        foreach ($regexToRoutesMap as $regex => $route) {
            $regexes[] = $regex . '(*MARK:' . $markName . ')';
            $routeMap[$markName] = [$route->handler, $route->variables];

            ++$markName;
        }

        $regex = '~^(?|' . implode('|', $regexes) . ')$~';
        return ['regex' => $regex, 'routeMap' => $routeMap];
    }
}

