<?php

class RecipeController extends BaseController
{
    private const TYPES = [
        "breakfast",
        "lunch",
        "dinner",
    ];
    private const LEVELS = [
        'easy',
        'medium',
        'hard',
    ];
    public function indexGet()
    {
        displayTemplate("recipes/index.twig", ['recipes'  => R::findAll('recipes')]);
    }
    public function showGet(): void
    {
        $recipe = $this->getbeanbyid('recipe', $_GET["id"]);
        
        // $recipe->kitchen = R::load('kitchen', $recipe->kitchen_id);
        // var_dump($recipe->kitchen);
        if (!isset($_GET['id'])) {
            error(404, "No recipe ID speceified");
        }
        if (!$recipe) {
            error(404, "no recipe with ID recipe found");
        }
        displayTemplate("recipes/show.twig", ['recipe' => $recipe]);
    }
    public function createGet(): void
    {
        displayTemplate(
            "recipes/create.twig",
            [
                'types' => $this::TYPES,
                'levels' => $this::LEVELS
            ]
        );
    }
    public function createPost()
    {
        $recipe = R::dispense('recipes');
        $recipe->name = $_POST['name'];
        $recipe->type = $_POST['types'];
        $recipe->level = $_POST['level'];
        $id = R::store($recipe);
        header('Location:/recipe/show&id=' . $id);
    }
    public function editGet()
    {
        $recipe = $this->getbeanbyid('recipe', $_GET["id"]);
        displayTemplate("recipes/edit.twig", ['recipe' => $recipe, "levels" => $this::LEVELS, "types" => $this::TYPES]);
    }
    public function editPost()
    {
        $recipe = R::load("recipes", $_GET['id']);
        $recipe->name = $_POST['name'];
        $recipe->type = $_POST['types'];
        $recipe->level = $_POST['level'];
        $id = R::store($recipe);
        header('Location:/recipe/show&id=' . $id);
    }
}
