<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

if (isset($_GET['action'])) {
  $action = $_GET['action'];

  switch ($action) {
    case 'today_sales':
      get_today_sales();
      break;
    case 'all_orders':
      get_all_orders();
      break;
    case 'sales_meals':
      get_sales_meals();
      break;
    case 'sales_customers':
      get_sales_customers();
      break;
    default:
      echo "Invalid action.";
      break;
  }
}

function get_today_sales()
{

  try {
    global $db;
    $stmt = $db->prepare("SELECT o.id as order_id, o.order_date, o.total_price, c.phone_number 
              FROM orders o 
              JOIN customers c ON o.customer_id = c.id
              WHERE DATE(o.order_date) = DATE('now')");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($orders) {
      echo '<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Order Date</th>
            <th scope="col">Total Price</th>
            <th scope="col">Customer Phone Number</th>
        </tr>
    </thead>
    <tbody>';

      foreach ($orders as $order) {
        echo '<tr>
        <th scope="row">' . $order['order_id'] . '</th>
        <td>' . $order['order_date'] . '</td>
        <td>' . $order['total_price'] . '</td>
        <td>' . $order['phone_number'] . '</td>
      </tr>';
      }

      echo '</tbody>
</table>';
    } else {
      echo "No sales found for today.";
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
  }
}

function get_all_orders()
{

              try {
                global $db;
                $stmt = $db->prepare("SELECT o.id as order_id, o.order_date, o.total_price, c.phone_number 
                          FROM orders o 
                          JOIN customers c ON o.customer_id = c.id");
                $stmt->execute();
                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($orders) {
                  echo '<table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Customer Phone Number</th>
                    </tr>
                </thead>
                <tbody>';

                  foreach ($orders as $order) {
                    echo '<tr>
                    <th scope="row">' . $order['order_id'] . '</th>
                    <td>' . $order['order_date'] . '</td>
                    <td>' . $order['total_price'] . '</td>
                    <td>' . $order['phone_number'] . '</td>
                  </tr>';
                  }

                  echo '</tbody>
            </table>';
                } else {
                  echo "No orders found.";
                }
              } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit();
              }
}

function get_sales_meals()
{   

    try {
      global $db;
        $stmt = $db->prepare("SELECT meal_name,SUM(meal_price * quantity) AS total_sales_price,COUNT(*) AS total_sales,AVG(meal_price * quantity) AS avg_sales_per_day,(SELECT AVG(meal_price * quantity) FROM sold_meals) AS avg_sales_all_data FROM sold_meals JOIN meals ON sold_meals.meal_id = meals.id GROUP BY meal_name");
        $stmt->execute();
        $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($sales) {
            echo '<table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">rank</th>
                    <th scope="col">meal</th>
                    <th scope="col">total sales price</th>
                    <th scope="col">sales per day average</th>
                    <th scope="col">average sales according to the entire data</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($sales as $index => $sale) {
                echo '<tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $sale['meal_name'] . '</td>
                    <td>' . number_format($sale['total_sales_price'], 2) . '</td>
                    <td>' . number_format($sale['avg_sales_per_day'], 2) . '</td>
                    <td>' . number_format($sale['avg_sales_all_data'], 2) . '</td>
                </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "No data found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

function get_sales_customers()
{

              try {
                global $db;
                $stmt = $db->prepare("SELECT 
                            c.id,
                            c.customer_name,
                            COUNT(s.id) as total_buyings,
                            AVG(strftime('%m', o.order_date)) as avg_visits_per_month,
                            MAX(o.order_date) as last_visited_date,
                            c.email,
                            c.phone_number
                          FROM customers c
                          LEFT JOIN orders o ON c.id = o.customer_id
                          LEFT JOIN sold_meals s ON c.id = s.customer_id
                          GROUP BY c.id
                          ORDER BY total_buyings DESC");

                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($result) {
                  echo '<table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">rank</th>
                  <th scope="col">customer name</th>
                  <th scope="col">total buyings</th>
                  <th scope="col">visits per month average</th>
                  <th scope="col">last visited data</th>
                  <th scope="col">email</th>
                  <th scope="col">phone</th>
                </tr>
              </thead>
              <tbody>';

                  $rank = 1;
                  foreach ($result as $row) {
                    echo '<tr>
                  <th scope="row">' . $rank . '</th>
                  <td>' . $row['customer_name'] . '</td>
                  <td>' . $row['total_buyings'] . '</td>
                  <td>' . round($row['avg_visits_per_month'], 2) . '</td>
                  <td>' . $row['last_visited_date'] . '</td>
                  <td>' . $row['email'] . '</td>
                  <td>' . $row['phone_number'] . '</td>
                </tr>';
                    $rank++;
                  }

                  echo '</tbody></table>';
                } else {
                  echo "No data found.";
                }
              } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit();
              }
}

?>