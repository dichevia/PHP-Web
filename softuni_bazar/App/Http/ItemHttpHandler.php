<?php

namespace App\Http;

use App\Data\ItemDTO;
use App\Data\EditItemDTO;
use App\Service\Items\ItemServiceInterface;
use App\Service\Categories\CategoryServiceInterface;
use App\Service\Users\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class ItemHttpHandler extends HttpHandlerAbstract
{

    /**
     * @var \App\Service\Items\ItemServiceInterface
     */
    private $itemService;
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    public function __construct(
        TemplateInterface $template,
        DataBinderInterface $dataBinder,
        ItemServiceInterface $itemService,
        UserServiceInterface $userService,
        CategoryServiceInterface $categoryService)
    {
        parent::__construct($template, $dataBinder);
        $this->itemService = $itemService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
    }


    public function add(array $formData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        if (isset($formData['add'])) {
            $this->handleInsertProcess($formData);
        } else {
            $categories = $this->categoryService->getAll();
            $this->render("items/add", $categories);
        }
    }

    private function handleInsertProcess($formData)
    {
        try {
            $currentUser = $this->userService->currentUser();
            $category = $this->categoryService->getOneById($formData['category_id']);
            /** @var ItemDTO $item */
            $item = $this->dataBinder->bind($formData, ItemDTO::class);
            $item->setCategory($category);
            $item->setUser($currentUser);
            $this->itemService->add($item);
            $this->redirect("my_items.php");
        } catch (\Exception $ex) {
            $categories = $this->categoryService->getAll();
            $this->render('items/add', $categories, [$ex->getMessage()]);
        }
    }

    public function allItemsByUser()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }
        try {
            $items = $this->itemService->getAllByAuthor();
            $this->render("items/my_items", $items);
        }catch (\Exception $ex){
            $items = $this->itemService->getAllByAuthor();
            $this->render("items/my_items", $items,
                [$ex->getMessage()]);
        }
    }

    public function allItems()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        try {
            $items = $this->itemService->getAll();
            $this->render("items/all_items", $items);
        }catch (\Exception $ex){
            $items = $this->itemService->getAll();
            $this->render("items/all_items", $items,
                [$ex->getMessage()]);
        }
    }

    public function view($getData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        $item = $this->itemService->getOneById($getData['id']);
        $this->render("items/view_item", $item);
    }

    public function delete($getData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        $currentUser = $this->userService->currentUser();
        $currentItem = $this->itemService->getOneById($getData['id']);

        if ($currentUser->getId() === $currentItem->getUser()->getId()) {
            $this->itemService->delete($getData['id']);
            $this->redirect("my_items.php");
        } else {
            $myItems = $this->itemService->getAllByAuthor();
            $this->render('items/all_items', $myItems, ['Cannot delete this item!']);
        }
    }

    public function edit($formData = [], $getData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData, $getData);
        } else {
            $item = $this->itemService->getOneById($getData['id']);
            $categories = $this->categoryService->getAll();

            $editItemDTO = new EditItemDTO();
            $editItemDTO->setItem($item);
            $editItemDTO->setCategory($categories);

            $this->render("items/edit_item", $editItemDTO);
        }
    }

    private function handleEditProcess($formData, $getData)
    {
        try {
            $category = $this->categoryService->getOneById($formData['category_id']);
            $user = $this->userService->currentUser();
            /** @var ItemDTO $item */
            $item = $this->dataBinder->bind($formData, ItemDTO::class);
            $item->setCategory($category);
            $item->setUser($user);
            $item->setId($getData['id']);
            $this->itemService->edit($item, $_SESSION['id']);
            $this->redirect("my_items.php");
        } catch (\Exception $ex) {
            $item = $this->itemService->getOneById($getData['id']);
            $editItemDTO = new EditItemDTO();
            $editItemDTO->setItem($item);
            $editItemDTO->setCategory($this->categoryService->getAll());
            $this->render('items/edit_item', $editItemDTO, [$ex->getMessage()]);
        }
    }

}