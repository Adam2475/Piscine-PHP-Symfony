<?php

namespace E03\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/e03", name="colors")
     */

    public function indexAction()
    {
        $num_shades = $this->getParameter("e03.number_of_colors");
        $colors = ['black', 'red', 'green', 'blue'];
        $shades = [];

        foreach ($colors as $color)
        {
            $shades[$color] = $this->generateShades($color, $num_shades);
        }

        return $this->render('E03Bundle:Default:index.html.twig', [
            'colors' => $colors,
            'shades' => $shades,
            'rows' => $num_shades
        ]);
    }

    function generateShades($color, $steps)
    {
        $shades = [];

        for ($i = 0; $i < $steps; $i++)
        {
            $intensity = intval(($i + 1) * (255 / $steps));
            switch ($color)
            {
                case 'black':
                    $rgb = "rgb($intensity, $intensity, $intensity)";
                    break;
                case 'red':
                    $rgb = "rgb($intensity, 0, 0)";
                    break;
                case 'green':
                    $rgb = "rgb(0, $intensity, 0)";
                    break;
                case 'blue':
                    $rgb = "rgb(0, 0, $intensity)";
                    break;
                default:
                    $rgb = "rgb(255,255,255)";
            }
            $shades[] = $rgb; 
        }
        return $shades;
    }
}
