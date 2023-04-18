<?php

namespace App\Controller;

use App\Entity\VirtualMachine;
use App\Form\VirtualMachineType;
use App\Repository\VirtualMachineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VirtualMachineController extends AbstractController
{
    #[Route('/virtual-machine/add', name: 'app_virtual_machineq', methods: ["POST"])]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $vm = new VirtualMachine();
        $form = $this->createForm(VirtualMachineType::class, $vm);
        $form->handleRequest($request);
        $form->submit(array_merge($request->request->all()));

        if ($form->isSubmitted() && $form->isValid()) {
            $vm = $form->getData();
            $em->persist($vm);
            $em->flush();

            return new Response('Saved new virtual machine with name '.$vm->getName());            
        }

        return new Response('Form invalid.');
    }

    #[Route('/virtual-machine/getById/{id}', name: 'app_virtual_machine', methods: ["GET"])]
    public function getById(ManagerRegistry $doctrine, int $id): Response
    {
        $test = $doctrine->getRepository(VirtualMachine::class)->find($id);

        // return new Response('Saved new virtual machine with id '.$vm->getId());
        return new Response('Saved new virtual machine with id '.$test->getId());
    }
}
