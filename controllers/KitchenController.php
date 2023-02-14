<?php

class KitchenController extends BaseController
{
    public function indexGet()
    {
        displayTemplate("kitchens/index.twig", ['kitchens' => R::findAll('kitchens')]);
    }
    public function showGet(): void
    {
        $kitchen = $this->getBeanById('kitchen', $_GET["id"]);

        if (!isset($_GET['id'])) {
            error(404, "No recipe ID speceified");
        }
        if (!$kitchen) {
            error(404, "no recipe with ID recipe found");
        }
        displayTemplate("kitchens/show.twig", ['kitchen' => $kitchen]);
    }
    public function createGet(): void
    {
        displayTemplate(
            "kitchens/create.twig",
            []
        );
    }
    public function createPost(): void
    {
        $kitchen = R::dispense('kitchens');
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['text'];
        $id = R::store($kitchen);
        header('Location:/kitchen/show&id=' . $id);
    }
    public function editGet(): void
    {
        $kitchen = $this->getbeanbyid('kitchen', $_GET["id"]);
        displayTemplate("kitchens/edit.twig", ['kitchen' => $kitchen]);
    }
    public function editPost()
    {
        $kitchen = R::load("kitchens", $_GET["id"]);
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['text'];
        $id = R::store($kitchen);
        header('Location:/kitchen/show&id=' . $id);
    }
}
