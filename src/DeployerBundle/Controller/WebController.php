<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeployerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Web controller handles all web stuff.
 *
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class WebController extends Controller
{
    /**
     * Display the homepage.
     *
     * @Template()
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('DeployerBundle:Queue');

        return array(
            'firstQueue' => $repo->findFirst(),
        );
    }

    /**
     * Display the items in the queue.
     *
     * @Template()
     */
    public function queueAction()
    {
        $repo = $this->getDoctrine()->getRepository('DeployerBundle:Queue');

        return array(
            'queue' => $repo->getSortedQueue(),
        );
    }
}
