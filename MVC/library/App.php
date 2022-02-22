<?php
        class APP
        {
                protected $controller = "Home";
                protected $action = "SayHi";
                protected $params = [];
            function __construct()
            {
                // Array ( [0] => Public [1] => index.php [2] => home [3] => 1 [4] => 2 [5] => 3 )
                $arr = $this->UrlProcess();
                // print_r($arr);

                // Xử lý controller
                if(file_exists("./MVC/controllers/".$arr[0].".php"))
                {
                        $this->controller = $arr[0];
                        unset($arr[0]);
                }
                // Mặc đi khi không có Controller sẽ về trang Home.php ( trang chủ của website)
                require_once "./MVC/controllers/".$this->controller.".php";

                // Xử lý action

                if(isset($arr[1]))
                {
                        if(method_exists($this->controller , $arr[1]))
                        {
                          $this->action = $arr[1];   
                        }
                        unset($arr[1]);           
                }


                // Xử lý mảng params riêng biệt
                $this->params = $arr?array_values($arr):[];

                // In cacs protected ra màn hình
                
                call_user_func_array(array($this->controller,$this->action),$this->params);
                
            }   

            function UrlProcess()
            {
                    // Isset : Coi url có tồn tại hay không 
                    if(isset($_GET["url"]))
                    {
                            // explode là hàm cắt
                            // explode( string $characters,  string $string[, int $limit ]); 
                            
                            return explode("/",filter_var(trim($_GET["url"])));
                    }
            }
        }

?>