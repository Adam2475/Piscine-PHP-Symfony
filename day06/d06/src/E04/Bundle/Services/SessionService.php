<?php

namespace E04\Bundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionService
{
    public function getSecondsSinceLastRequest(Request $request, $user)
    {
       $session = $request->getSession();

        if (!$session->has('last_request_time')) {
            $session->set('last_request_time', time());
            return 0;
        }

        return time() - $session->get('last_request_time');
    }

    public function getAnonymousName(Request $request, $lastRequest, $user)
    {
        $session = $request->getSession();
        $animals = ['dog', 'cat', 'bear', 'wolf', 'sheep'];
        $anonName = null;

        if (!$user)
        {
            if (!$session->has('anonymous_name'))
            {
                $animal = $animals[array_rand($animals)];
                $anonName = 'Anonymous ' . $animal;
                $session->set('anonymous_name', $anonName);
                $session->set('last_request_time', time());
            }
            else 
            {
                $lastRequest = $session->get('last_request_time');
                $now = time();

                if (($now - $lastRequest) > 60)
                {
                    // Session expired for anonymous user — reset
                    $session->remove('anonymous_name');
                    $session->remove('last_request_time');
                    $animal = $animals[array_rand($animals)];
                    $anonName = 'Anonymous ' . $animal;
                    $session->set('anonymous_name', $anonName);
                    $session->set('last_request_time', $now);
                }
                else
                {
                    // Update last request time
                    $session->set('last_request_time', $now);
                    // Return the existing anonymous name from session
                    $anonName = $session->get('anonymous_name');
                }
            }
        }
        else
        {
            $anonymousName = null;
        }

        return $anonName;
    }
}

?>