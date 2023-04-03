<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * MainController
 * 
 * Maincontroller handles all the routing throughout the app.
 */
class MainController extends AbstractController {

  /**
   * todoRepository
   *
   *  @var object $todoRepository
   *    Initialising object of todoRepository
   */
  private $todoRepository;  
  /**
   * em
   *
   *  @var object $em
   *    Initialising object of EntityManagerInterface.
   */
  private $em;  
  /**
   * __construct
   *
   *  @param  object $todoRepository
   *    Initialising object of todoRepository
   *  @param  object $em
   *    Initialising object of EntityManagerInterface.
   *  @return void
   */
  public function __construct(TodoRepository $todoRepository, EntityManagerInterface $em) {
    $this->todoRepository = $todoRepository;
    $this->em = $em;
  }

  #[Route('', name: 'index')]  
  /**
   * index
   *
   * index() function renders the home page on vising the website.
   * 
   *  @return Response
   *    Renders the home page
   */
  public function index(): Response {
    $errors = [];
    return $this->render('main/home.html.twig', [
      'errors' => $errors,]);
  }

  #[Route('/home', name: 'home')]  
  /**
   * home
   *
   * This route renders the home page.
   * 
   *  @return Response
   *    Renders the homepage.
   */
  public function home(): Response {
    $errors = [];
    return $this->render('main/home.html.twig', [
      'errors' => $errors,]);
  }

  #[Route('/items', name: 'items')]  
  /**
   * items
   *
   * This route renders the todo list page.
   * 
   *  @return Response
   *    Renders the items page.
   */
  public function items(): Response {
    // Fetching data from gthe Todo Entity.
    $todos = $this->todoRepository->findAll();
    // Rendering back the todolist page.
    return $this->render('main/itemlist.html.twig', [
      'todos' => $todos
    ]);
  }

  #[Route('/additem', name: 'additem')]  
  /**
   * additem
   *
   * addItem() function is used to add new todo item to the list.
   * 
   *  @param  object $request
   *    Initialising an object of HttpRequest.
   * 
   *  @return Response
   *    Renders the home page if error occurs else redirect to items route. 
   */
  public function addItem(ValidatorInterface $validator, Request $request): Response {
    $todo = new Todo();
    // Getting the item name.
    $item = $request->get('item');
    $errors = [];
    
    // Validate item field 
    $violations = $validator->validate($item, [
        new NotBlank(),
    ]);
    if (count($violations) > 0) {
        $errors['item'] = $violations[0]->getMessage();
    }
    if (count($errors) > 0) {
      // Render the form with errors
      return $this->render('main/home.html.twig', [
          'errors' => $errors,
          'item' => $item,
      ]);
    }
    // Setting and persisting the todo item onto the Db.
    $todo->setItemname($item);
    $this->em->persist($todo);
    $this->em->flush();
    // Redirecting to items route.
    return $this->redirectToRoute('items');
  }

  #[Route('/deleteitem/{id}', name: 'deleteitem')]  
  /**
   * deleteItem
   * 
   *deleteItem() function is used to remove todo items from the list.
   *  @param  int $id
   *    Getting the item id as a parameter.
   * 
   *  @return Response
   *    Renders back to items route.
   */
  public function deleteItem(int $id): Response {
    // Fetching all the details from Todo entity based on passed id.
    $itemsrep = $this->em->getRepository(Todo::class)->findOneBy(['id' => $id]);
    // If item exists on the DB do the following.
    if ($itemsrep) {
      // Removing from DB.
      $this->em->remove($itemsrep);
      $this->em->flush();
    }
    // Redirect back to items route.
    return $this->redirectToRoute('items');
  }

  #[Route('/edititem/{id}', name: 'edititem')]  
  /**
   * editItem
   *
   * editItem() function is used to edit todo items.
   *  @param  int $id
   *    Taking item id as a parameter.
   * 
   *  @return Response
   *    Renders back to update page.
   */
  public function editItem(int $id): Response {
    // Fetching all the details from Todo entity based on passed id.
    $itemsrep = $this->em->getRepository(Todo::class)->findOneBy(['id' => $id]);
    return $this->render('main/update.html.twig', [
      'itemdet' => $itemsrep
    ]);
  }

  #[Route('/updateitem/{id}', name: 'updateitem')]  
  /**
   * updateItem
   *
   *  @param  int $id
   *    Taking item id as a parameter.
   *  @param  object $request
   *    Initialising an object of HttpRequest.
   * 
   *  @return Response
   *    Rendering back to the items route.
   */
  public function updateItem(int $id, Request $request): Response {
    $updatedname = $request->get('item');
    $itemsrep = $this->em->getRepository(Todo::class)->findOneBy(['id' => $id]);
    if ($itemsrep) {
      $itemsrep->setItemname($updatedname);
      $this->em->persist($itemsrep);
      $this->em->flush();
    }
    return $this->redirectToRoute('items');
  }

}
