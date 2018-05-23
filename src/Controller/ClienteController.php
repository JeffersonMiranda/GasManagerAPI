<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\Contato;
use App\Entity\Endereco;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClienteController extends Controller
{
    /**
     * @Route("/cliente/", name="cliente_show_all", methods={"get"})
    */

    public function showAll(){
        $clientes = $this->getDoctrine()->getRepository(Cliente::class)->findAll();

        return $this->json($clientes);
    }

    /**
     * @Route("/cliente/{id}", name="cliente_show", requirements={"page"="\d+"},methods={"get"})
    */
    public function show($id){     

        if($id){    
          $cliente = new Cliente();        
          $cliente = $this->getDoctrine()->getRepository(Cliente::class)->find($id); 
          if($cliente){
            return $this->json($cliente); 
          }
          else{
            throw $this->createNotFoundException('No product found for id '.$id);
            }           
        } 
        else{
            return new Response("O id não inserido !"); 
        }             
}

    /**
     * @Route("/cliente/",name="cliente_save", methods={"post"})
     */    
    public function save(Request $request, ValidatorInterface $validator){             

        $clienteRequest = json_decode($request->getContent());
        
        $novoCliente = new Cliente();
        $novoEndereco = new Endereco();
        $novoContato = new Contato();
        
        $novoCliente->setNome($clienteRequest->nome);

        $novoEndereco->setRua($clienteRequest->endereco->rua);
        $novoEndereco->setComplemento($clienteRequest->endereco->complemento);
        $novoEndereco->setCep($clienteRequest->endereco->complemento);
        
        $novoCliente->setEndereco($novoEndereco);

        $novoContato->setTelefone($clienteRequest->contato->telefone);
        $novoContato->setCelular($clienteRequest->contato->celular);
        $novoContato->setEmail($clienteRequest->contato->email);

        $novoCliente->setContato($novoContato);
        
        $errors = $validator->validate($novoCliente);

        if(count($errors)>0){
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }       

        $entityManager =  $this->getDoctrine()->getManager();
        $entityManager->persist($novoCliente);
        $entityManager->flush();

        return new Response($this->json($novoCliente));
    }

    /**
     * @Route("/cliente", name="cliente_update",methods={"put"})
     */
    public function update(Request $request, ValidatorInterface $validator){

        $clienteRequest = json_decode($request->getContent()); 

        $entityManager = $this->getDoctrine();
        $cliente = $entityManager->getRepository(Cliente::class)->find($clienteRequest->id);
        
        $cliente->setNome($clienteRequest->nome);
        $cliente->GetEndereco()->setRua($clienteRequest->endereco->rua);
        $cliente->GetEndereco()->setComplemento($clienteRequest->endereco->complemento);
        $cliente->GetEndereco()->setCep($clienteRequest->endereco->cep);
        $cliente->GetContato()->setCelular($clienteRequest->contato->celular);
        $cliente->GetContato()->setTelefone($clienteRequest->contato->telefone);
        $cliente->GetContato()->setEmail($clienteRequest->contato->email);

        $errors = $validator->validate($cliente);

        if(count($errors)>0){
            return new Response((string)$errors);
        }
        else{
            $entityManager->getManager()->flush();
        }

        return new Response($this->json($cliente));
    }

    /**
     *@Route("/cliente",name="cliente_remove",methods={"delete"}) 
     */
    public function delete(Request $request){
        $clienteId = $request->request->get('id');

        $entityManager = $this->getDoctrine();
        $cliente = $entityManager->getRepository(Cliente::class)->find($clienteId);

        $entityManager->getManager()->remove($cliente);
        $entityManager->getManager()->flush();

        return new Response("Cliente removido com sucesso !");
    }
    /**
     * @Route("/cliente/byStreet/{street_name}", name="cliente_show_by_street",methods={"get"}) 
    */  
    public function showByStreet($street_name){

        $entityManager = $this->getDoctrine()->getRepository(Cliente::class); 
        $clientes = $entityManager->findByStreet($street_name);
    
        return $this->json($clientes);
    }

    /**
     * @Route("/cliente/byName/{name}", name="cliente_show_by_name",methods={"get"})
    */

    public function showByName($name){

        $entityManager = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $entityManager->findByName($name);

        return $this->json($clientes);

       
    }

}
