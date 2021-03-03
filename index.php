<?php
require_once "model/item_db.php";
require_once "model/category_db.php";

if(isset($_POST["action"]))
{
    switch ($_POST["action"]){
        case "deleteItem":
            if (filter_input(INPUT_POST,"deleteToDoItem", FILTER_VALIDATE_INT) === 0 || filter_input(INPUT_POST,"deleteToDoItem", FILTER_VALIDATE_INT))
                delete_item($_POST["deleteToDoItem"]);
            //else silent fail - take no action on bad input
            break;
        case "addCategory":
            $category = filter_input(INPUT_POST, "categoryName",FILTER_SANITIZE_STRING);
            $category = substr(trim($category),0,20);
            if(!empty($category))
                add_category($category);
            break;
        case "addItem":
            $categoryID = -1; //None category by default
            if (filter_input(INPUT_POST, "categoryID", FILTER_VALIDATE_INT) === 0 || filter_input(INPUT_POST, "categoryID", FILTER_VALIDATE_INT))
                $categoryID = $_POST["categoryID"];

            $toDoTitle = filter_input(INPUT_POST, "title",FILTER_SANITIZE_STRING);
            if(empty($toDoTitle))
                exit();
            $toDoTitle = substr(trim($toDoTitle),0,20);

            $toDoDescription = filter_input(INPUT_POST, "description",FILTER_SANITIZE_STRING);
            if(empty($toDoDescription))
                exit();
            $toDoDescription = substr(trim($toDoDescription),0,50);

            add_item($toDoTitle,$toDoDescription, $categoryID);
            break;
        case "deleteCategory":
            if (filter_input(INPUT_POST, "deleteCategoryID", FILTER_VALIDATE_INT) === 0 || filter_input(INPUT_POST, "deleteCategoryID", FILTER_VALIDATE_INT))
                delete_category($_POST["deleteCategoryID"]);
            break;
            //else silent fail
        default:
            break;
    }
}

include "view/header.php";

$categoryID = null;
if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "viewCategory":
            if (filter_input(INPUT_GET, "category", FILTER_VALIDATE_INT) === 0 || filter_input(INPUT_GET, "category", FILTER_VALIDATE_INT))
                $categoryID = $_GET["category"];
            //else - silent fail
            goto standardView;
            break;
        case "categoryList":
            $toDoCategories = get_categories();
            include "view/category_list.php";
            break;
        case "addItem":
            $toDoCategories = get_categories();
            include "view/add_item_form.php";
            break;
        default:
            standardView:
            $toDoItems = get_items_by_category($categoryID);
            $toDoCategories = get_categories();
            include "view/item_list.php";
            break;
    }
}
else{
    $toDoItems = get_items_by_category($categoryID);
    $toDoCategories = get_categories();
    include "view/item_list.php";
}

include "view/footer.php";
//   echo "<pre>"; print_r($toDoItems) ;  echo "</pre>";
