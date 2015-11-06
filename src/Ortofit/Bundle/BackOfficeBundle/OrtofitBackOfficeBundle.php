<?php

namespace Ortofit\Bundle\BackOfficeBundle;

use Ortofit\Bundle\BackOfficeBundle\DependencyInjection\Compiler\EntityManagerCompilerPath;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OrtofitBackOfficeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new EntityManagerCompilerPath());
    }
}
