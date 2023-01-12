<?php

class KitchenController
{
    public function index()
    {
        displayTemplate("kitchens/index.twig", ['kitchens' => R::findAll('kitchens')]);
    }
    public function show(): void
    {
        if (!isset($_GET['id'])) {
            error(404, "No recipe ID speceified");
        }
        $kitchen = R::findOne('kitchens', 'id = ?', [$_GET['id']]);
        if (!$kitchen) {
            error(404, "no recipe with ID recipe found");
        }
        displayTemplate("kitchens/show.twig", ['kitchen' => $kitchen]);
    }
}
