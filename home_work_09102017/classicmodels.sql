# Задание 1 - Получить список сотрудников (employees) c именами (firstName) Barry, Larry, Leslie отсортировать выборку по имени сотрудника, порядок - по возрастанию.
SELECT *
FROM employees
WHERE firstName
      IN('Barry', 'Larry', 'Leslie')
ORDER BY firstName ASC;

# Задание 2 - Получить 3 товара (products) с самой высокой ценой (buyPrice) отсортировать по цене - от большей к меньшей.
SELECT *
FROM products
ORDER BY buyPrice DESC
LIMIT 3;

# Задание 3 - Получить 3 товара (products) с наименьшим количеством на складе (quantityInStock).
SELECT *
FROM products
ORDER BY quantityInStock ASC
LIMIT 3;

# Задание 4 - Получить список офисов (offices), в которых находится более четырех сотрудников (employees).
SELECT o.*, COUNT(e.officeCode) AS employees
FROM offices o
  JOIN employees e ON o.officeCode = e.officeCode
GROUP BY e.officeCode
HAVING employees > 4;

# Задание 5 - Получить список заказов (orders), в которых было заказано более 10 товаров.
SELECT o.*, COUNT(od.orderNumber) AS goods
FROM orders o
  JOIN orderdetails od ON o.orderNumber = od.orderNumber
GROUP BY od.orderNumber
HAVING goods > 10;

# Задание 6 - Получить полный список сотрудников (employees), для каждого сотрудника получить количество привязанных к нему покупателей (customers).
SELECT e.lastName, e.firstName, COUNT(c.customerNumber) AS customers
FROM employees e
  LEFT JOIN customers c ON e.employeeNumber = c.salesRepEmployeeNumber
GROUP BY e.employeeNumber;

# Задание 7* - Получить список офисов (offices), для каждого из них получить количество заказов за 2005 год. Выводить только те офисы, в которых было сделано более 5 заказов.
SELECT o.*, COUNT(ord.customerNumber) AS orders
FROM orders ord
  JOIN customers c ON ord.customerNumber = c.customerNumber
  JOIN employees e ON c.salesRepEmployeeNumber = e.employeeNumber
  JOIN offices o ON e.officeCode = o.officeCode
WHERE YEAR(ord.orderDate) = 2005
GROUP BY e.officeCode
HAVING orders > 5;
