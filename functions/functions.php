<?php
   
    function getCategories(){
        global $con;
        $categories = $con->prepare("SELECT * from categories WHERE is_deleted=0");
        $categories->execute();
        $categories=$categories->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    function getSingleCategory($id) {
        global $con;
        $categories = $con->prepare("SELECT * from categories where id=:id");
        $categories->bindParam(':id', $id);
        $categories->execute();
        $categories=$categories->fetch(PDO::FETCH_ASSOC);
        return $categories;
    }

    function getBrands(){
        global $con;
        $brands = $con->prepare("SELECT * from brands WHERE is_deleted=0");
        $brands->execute();
        $brands=$brands->fetchAll(PDO::FETCH_ASSOC);
        return $brands;
    }
    function getSingleBrand($id){
        global $con;
        $brands = $con->prepare("SELECT * from brands WHERE id=:id");
        $brands->bindParam(':id', $id);
        $brands->execute();
        $brands=$brands->fetch(PDO::FETCH_ASSOC);
        return $brands;
    }

    function getAllProducts(){
        global $con;
        $allProducts = $con->prepare("SELECT * FROM products prod INNER JOIN prices pri ON prod.id=pri.product_id INNER JOIN categories ON prod.category_id=categories.id INNER JOIN brands b ON prod.brand_id=b.id WHERE prod.is_deleted=0");
        $allProducts->execute();
        $allProducts = $allProducts->fetchAll(PDO::FETCH_ASSOC);
        return $allProducts;
    }

    function getUsers(){
        global $con;
        $users = $con->prepare("SELECT * FROM users u INNER JOIN roles r ON u.role_id=r.id INNER JOIN genders g ON u.gender_id=g.id WHERE is_deleted=0");
        $users->execute();
        $users = $users->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    function getSingleUser($id) {
        global $con;
        $user_id = $id;
        $users = $con->prepare("SELECT * FROM users u INNER JOIN roles r ON u.role_id=r.id INNER JOIN genders g ON u.gender_id=g.id WHERE user_id=:user_id");
        $users->bindParam(":user_id", $user_id);
        $users->execute();
        $users = $users->fetch(PDO::FETCH_ASSOC);
        return $users;
    }

    function getRoles(){
        global $con;
        $roles = $con->prepare("SELECT * from roles");
        $roles->execute();
        $roles = $roles->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
    }

    function checkUsers(){
        $_SESSION['user'];
        if($_SESSION['user']['role_id']!=2){
            header("location: ../index.php");
        }
    }

    function getGenders(){
        global $con;
        $genders = $con->prepare('SELECT * FROM genders');
        $genders->execute();
        $genders = $genders->fetchAll(PDO::FETCH_ASSOC);
        return $genders;
    }
    function setNewValueInSessionForUser($fname, $lname, $email, $profile_img, $password, $gender){

        $_SESSION['user']['first_name'] = $fname;
        $_SESSION['user']['last_name'] = $lname;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['profile_img'] = $profile_img;
        $_SESSION['user']['password'] = $password;
        $_SESSION['user']['gender_id'] = $gender;

    }
    function getSingleProdcut($id){
        
        global $con;
        $singleProduct = $con->prepare("SELECT * FROM products WHERE id=:id");
        $singleProduct->bindParam(':id', $id);
        $singleProduct->execute();
        return $singleProduct->fetch(PDO::FETCH_ASSOC);
    }

    function getAllSizes(){
        global $con;
        $allSizes = $con->prepare("SELECT DISTINCT * FROM sizes");
        $allSizes->execute();
        return $allSizes->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProductSizes($id) {
        global $con;
        $allSizes = $con->prepare("SELECT * FROM sizes s INNER JOIN product_size ps ON s.id=ps.size_id WHERE product_id=:id");
        $allSizes->bindParam(':id', $id);
        $allSizes->execute();
        return $allSizes->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPrice($id){
        global $con;
        $price = $con->prepare("SELECT * FROM prices WHERE product_id=:id ORDER BY date DESC limit 1");
        $price->bindParam(":id", $id);
        $price->execute();
        return $price->fetch(PDO::FETCH_ASSOC);
    }

    function getProductSpecification() {
        global $con;
        $spec = $con->prepare("SELECT * FROM specifications");
        $spec->execute();
        return $spec->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function removeProduct($productId){
        $productId = $productId;
        global $con;
        $remove = $con->prepare("UPDATE products SET is_deleted = 1 WHERE id=:id");
        $remove->bindParam(":id", $productId);
        $remove = $remove->execute();
        return $remove;
    }

    function deletedRows($table) {
        global $con;
        $upit = '';
        if($table == 'users') {
            $upit = "SELECT * FROM users u INNER JOIN roles r ON u.role_id=r.id INNER JOIN genders g ON u.gender_id=g.id WHERE is_deleted=1";
        } else if($table == 'brands') {
            $upit = "SELECT * from brands WHERE is_deleted=1";
        } else if($table=='categories') {
            $upit = "SELECT * from categories WHERE is_deleted=1";
        } else if($table == 'products') {
            $upit = "SELECT * FROM products prod INNER JOIN prices pri ON prod.id=pri.product_id INNER JOIN categories ON prod.category_id=categories.id INNER JOIN brands b ON prod.brand_id=b.id INNER JOIN gender_product g on prod.id=g.product_id WHERE prod.is_deleted=1";
        }
        $deleted = $con->prepare($upit);
        $deleted->execute();

        return $deleted->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPoll() {
        global $con;
        $poll = $con->prepare("SELECT * FROM poll_questions");
        $poll->execute();
        $poll = $poll->fetchAll(PDO::FETCH_ASSOC);
        return $poll;
    }
    function getSingleQuestion($id) {
        global $con;
        $question = $con->prepare("SELECT * FROM poll_questions WHERE question_id=:id");
        $question->bindParam(":id", $id);
        $question->execute();
        return $question->fetch(PDO::FETCH_ASSOC);
    }
