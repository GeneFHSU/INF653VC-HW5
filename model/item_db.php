<?php
require("model/database.php");

function get_items_by_category($category_id) {
    global $db;
//    $categoryID = null;
//    if(isset($_GET["categoryName"]))
//    {
//        /*Sanitize the category name*/
//        $queryCategoryName = filter_input(INPUT_GET, "categoryName",FILTER_SANITIZE_STRING);
//
//        /*Trim and shorten the category name to match the SQL table*/
//        $queryCategoryName = substr(trim($queryCategoryName),0,20);
//
//        /*Validate categoryName*/
//        $query =    "SELECT categoryID FROM categories WHERE categoryName = :categoryName";
//        $statement = $db->prepare($query);
//        $statement->bindValue(":categoryName",$queryCategoryName);
//        $statement->execute();
//        $toDoItems = $statement->fetchAll();
//        $statement->closeCursor();
//
//        /*Check to see if categoryName exists - if it does, extract categoryID, otherwise error*/
//        if ($statement->rowCount() > 0)
//            $categoryID = $toDoItems[0]["categoryID"];
//        else {
//            $categoryID = null;
//            echo "Invalid Category Name";
//        }
//
//        echo "<pre>"; print_r($toDoItems) ;  echo "</pre>";
//
//    }

    //*Get current toDoItems from table*/
    /*If a categoryID is set, limit the search to that category ID*/
    /*Assume that the categoryID has not been removed since previous sql query*/
    $query = "SELECT todoitems.ItemNum, todoitems.Title, todoitems.Description, todoitems.categoryID, categories.categoryName
            FROM todoitems 
            LEFT OUTER JOIN categories on todoitems.categoryID = categories.categoryID "
            .(is_null($category_id) ? "" :"WHERE todoitems.categoryID = :categoryID ")
            ."ORDER BY Title ASC";
    $statement = $db->prepare($query);
    if(!is_null($category_id))
        $statement->bindValue(":categoryID",$category_id);
    $statement->execute();
    $toDoItems = $statement->fetchAll();
    $statement->closeCursor();
    return $toDoItems;
}

//not used
function get_item($product_id) {
    global $db;
    $query = 'SELECT * FROM products
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

function delete_item($item_id) {
    global $db;
    $query = 'DELETE FROM todoitems
              WHERE ItemNum = :item_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_id', $item_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($toDoTitle, $toDoDescription, $categoryID) {
    global $db;
    $query = 'INSERT INTO todoitems
                 (Title, Description, categoryID) 
              VALUES
                 (:title, :description, :categoryID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $toDoTitle);
    $statement->bindValue(':description', $toDoDescription);
    $statement->bindValue(':categoryID', $categoryID);
    $statement->execute();
    $statement->closeCursor();
}

?>