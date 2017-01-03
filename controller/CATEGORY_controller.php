<?php
require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/CATEGORY.php");
require_once(__DIR__ . "/../model/CATEGORY_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");



class CategoryController extends BaseController
{

   
    private $categoryMapper;

    public function __construct()
    {
        parent::__construct();


        $this->categoryMapper = new CategoryMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

     public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Category baleiro
            $category = new Category();

            //Engadimos o nome ao Action
            $category->setCategoryname(htmlentities(addslashes($_POST["categoryname"])));

            try {
                if (!$this->categoryMapper->categorynameExists($category->getCategoryname())) {
                    $this->categoryMapper->add($category);
                    //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                    $this->view->setFlash('succ_category_add');

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das categorias)
                    $this->view->redirect("category", "show");
                } else {
                    $this->view->setFlash("fail_category_exists");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("category", "add");
    }

    
    public function delete()
    {
        try {
            if (isset($_GET['codcategory'])) {
                $this->categoryMapper->delete(htmlentities(addslashes($_GET['codcategory'])));
                $this->view->setFlash('succ_action_delete');
                $this->view->redirect("category", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("category", "show");
    }

    
    public function show()
    {
        $categories = $this->categoryMapper->show();
        $this->view->setVariable("categoriestoshow", $categories);
        $this->view->render("category", "show");
    }

    public function view()
    {
        $category = $this->actionMapper->view(htmlentities(addslashes($_GET['codcategory'])));
        $this->view->setVariable("category", $category);
        $this->view->render("category", "view");
    }


    public function edit()
    {
        if (isset($_POST["submit"])) {
        
            $category = $this->categoryMapper->view(htmlentities(addslashes($_REQUEST["codcategory"])));

            if(isset($_REQUEST["newcategoryname"]) && $_REQUEST["newcategoryname"]!=""){
                $category->setCategoryname(htmlentities(addslashes($_REQUEST["newcategoryname"])));
                if ($this->categoryMapper->categorynameExists($category->getCategoryname())) {
                    $this->view->setFlash("fail_category_exists");
                    $this->view->redirect("category", "edit", "codcategory=".htmlentities(addslashes($_REQUEST["codcategory"])));
                }
            }

            try {
                $this->categoryMapper->edit($category);
                //ENVIAR AVISO DE CATEGORIA EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_category_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das categorias)
                $this->view->redirect("category", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("category", "edit");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $category = new Category();
            if(isset($_POST['categoryname'])){
                $category->setCategoryname(htmlentities(addslashes($_POST["categoryname"])));
            }
            if(isset($_POST["codcategory"])){
                $category->setCodcategory(htmlentities(addslashes($_POST["codcategory"])));
            }
            try {
                $this->view->setVariable("categoriestoshow", $this->categoryMapper->search($category));

            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("category", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("category","show");
        }else{
            $this->view->render("category", "search");
        }

    }

}
