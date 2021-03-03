<?php
require("model/database.php");

function get_categories() {
    global $db;
    $query = "SELECT categoryID, categoryName 
        FROM categories 
        ORDER BY categoryName ASC";
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;
}

function get_category_name($category_id) {
    global $db;
    $query = 'SELECT * FROM categories
              WHERE categoryID = :category_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();    
    $category = $statement->fetch();
    $statement->closeCursor();    
    $category_name = $category['categoryName'];
    return $category_name;
}

/*Adds category if it does not exist. Case-sensitive*/
function add_category($categoryname) {
    global $db;

    /*Validate categoryName*/
    $query =    "SELECT categoryID FROM categories WHERE categoryName = :categoryName";
    $statement = $db->prepare($query);
    $statement->bindValue(":categoryName",$categoryname);
    $statement->execute();
    $categpryNames = $statement->fetchAll();
    $statement->closeCursor();

    /*Check to see if categoryName exists - if it does not, add it, otherwise skip*/
    if ($statement->rowCount() == 0){
        $query = 'INSERT INTO categories (categoryName)
              VALUES (:name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $categoryname);
        $statement->execute();
        $statement->closeCursor();
    }


}


function delete_category($category_id) {
    global $db;
    $query = 'UPDATE todoitems
              SET categoryID = -1
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();


    $query = 'DELETE FROM categories
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}
?>