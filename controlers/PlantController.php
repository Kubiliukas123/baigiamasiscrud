<?php
include "/xampp/htdocs/vcs/baigiamasiscrud/models/Plant.php";
class PlantController{
    
    public static function index(){
        $plants = Plant::all();
        return $plants;

}
public static function show()
    {
        $plant = Plant::find($_POST['id']);
        return $plant;
    }
    public static function store()
    {
        Plant::create();
    }

    public static function update()
    {
        Plant::update();
    }
    public static function destroy()
    {
        Plant::destroy();
    }
}