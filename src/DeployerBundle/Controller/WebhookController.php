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

use DeployerBundle\Entity\Queue;
use Seld\JsonLint\JsonParser;
use Seld\JsonLint\ParsingException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Webhook controller handles all webhooks.
 *
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class WebhookController extends Controller
{
    public function gitlabAction()
    {
        $payload = $this->getRequest()->getContent();

        try {
            $parser = new JsonParser();
            $props = $parser->parse($payload);
        } catch (ParsingException $e) {
            return new Response('Invalid gitlab payload: ' . $e->getMessage(), 500);
        }

        $project = explode(':', $props->repository->url)[1];
        $branch = explode('/', $props->ref)[2];
        $this->createQueue($project, $branch, $payload);

        return new Response('success');
    }

    protected function createQueue($project, $branch, $payload)
    {
        $queue = new Queue();
        $queue->setProject($project);
        $queue->setBranch($branch);
        $queue->setPayload($payload);
        $queue->setCreatedAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($queue);
        $em->flush();
    }
}
