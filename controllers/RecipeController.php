<?php

class RecipeController
{
    public function index()
    {
        displayTemplate("recipes/index.twig" , ['recipes'  => R::findAll('recipes')]);
    }
    public function show(): void
    {
        if (!isset($_GET['id'])) {
            error(404, "No recipe ID speceified");
        }
        $recipe = R::findOne('recipes' , 'id = ?', [$_GET['id']]);

        if (!$recipe) {
            error(404, "no recipe with ID recipe found");
        }
        displayTemplate("recipes/show.twig" , ['recipe' => $recipe]);
    }
}
