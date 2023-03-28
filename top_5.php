SELECT p.id, p.name, p.discription, p.price, p.image_location, SUM(ol.amount) as totaal
FROM products p LEFT JOIN order_line ol ON p.id = ol.product_id 
LEFT JOIN orders o ON o.id=ol.order_id 
WHERE ADDDATE(o.time, INTERVAL 1 WEEK) >= '2023-3-28' 
GROUP BY p.id 
ORDER BY totaal DESC; 