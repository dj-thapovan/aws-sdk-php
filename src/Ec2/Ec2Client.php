<?php
namespace Aws\Ec2;

use Aws\AwsClient;

/**
 * Client used to interact with Amazon EC2.
 */
class Ec2Client extends AwsClient
{
    public function __construct(array $args)
    {
        $args['with_resolved'] = function (array $args) {
            $this->getHandlerList()->append(
                'init:ec2.copy_snapshot',
                CopySnapshotMiddleware::wrap(
                    $this,
                    $args['endpoint_provider']
                )
            );
        };

        parent::__construct($args);
    }
}
