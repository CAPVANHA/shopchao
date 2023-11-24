<?php
    class ProductModel {
        public function select_products_limit($limit) {
           $sql = "SELECT * FROM products WHERE status = 1 ORDER BY product_id DESC LIMIT $limit";

           return pdo_query($sql);
        }

        public function select_products_by_id($id) {
            $sql = "SELECT * FROM products WHERE product_id = ?";
 
            return pdo_query_one($sql, $id);
        }

        public function select_products_similar($id) {
            $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY product_id LIMIT 4";
 
            return pdo_query($sql, $id);
        }

        public function select_all_products() {
            $sql = "SELECT * FROM products WHERE status = 1 ORDER BY product_id DESC";

            return pdo_query($sql);
        }

        public function select_products_by_cate($category_id) {
            $sql = "SELECT * FROM products WHERE category_id = ?";
 
            return pdo_query($sql, $category_id);
        }

        function select_list_products($page, $perPage) {
            // Tính toán vị trí bắt đầu của kết quả trên trang hiện tại
            $start = ($page - 1) * $perPage;
        
            // Bắt đầu câu truy vấn SQL
            $sql = "SELECT * FROM products WHERE 1";
            
        
            // Sắp xếp theo id giảm dần
            $sql .= " AND status = 1 ORDER BY product_id DESC";
        
            // Thêm phần phân trang
            $sql .= " LIMIT " . $start . ", " . $perPage;
        
            return pdo_query($sql);
        }

        // Đếm sản phẩm
        public function count_products() {
            $sql = "SELECT product_id FROM products";

            return pdo_query($sql);
        }
        

        public function discount_percentage($price, $sale_price) {
            $discount_percentage = ($price - $sale_price) / $price * 100;

            $round__percentage = round($discount_percentage, 0)."%";
            return $round__percentage;
        }

        public function formatted_price($price) {
            $format = number_format($price, 0, ',', '.') . 'đ';
            return $format;
        }

    }

    $ProductModel = new ProductModel();
?>