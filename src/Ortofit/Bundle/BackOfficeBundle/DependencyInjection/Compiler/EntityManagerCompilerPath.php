<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class EntityManagerCompilerPath
 *
 * @package Ortofit\Bundle\BackOfficeBundle\DependencyInjection\Compiler
 */
class EntityManagerCompilerPath implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ortofit_back_office.entity_manager_olm')) {
            return;
        }

        $definition = $container->getDefinition('ortofit_back_office.entity_manager_olm');

        $taggedServices = $container->findTaggedServiceIds('ortofit_back_office.entity_manager_olm');

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addManager',
                array(new Reference($id))
            );
        }
    }
}