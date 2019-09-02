<?php
  class Route
  {
    public static $validRoutes = array();

    public static function set($route, $function)
    {
      self::$validRoutes[] = $route;
      // print_r(self::$validRoutes);
      if ($_GET['url'] == $route) {
        $function -> __invoke();
      }
    }
    public static function model($route, $function)
    {
      self::$validRoutes[] = $route;
      //|print_r(self::$validRoutes);
      if ($_GET['item'] == $route) {
        print $_GET['item'];
        $function -> __invoke();
      }
    }
  }
 ?>
