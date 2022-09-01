<?php


$input = [
	['всі бренди', 'https://royalbud.com.ua/ru/brands', 'index,follow'],
	['бренд', 'https://royalbud.com.ua/ru/brand/avenyu', 'index,follow'],
	['бренд+знижка', 'https://royalbud.com.ua/ru/brand/avenyu/filter-discounted', 'noindex,nofollow'],

	['категорія', 'https://royalbud.com.ua/ru/catalog/zbirni-parkani', 'index,follow'],
	['категорія + бренд', 'https://royalbud.com.ua/ru/catalog/zbirni-parkani/brand-avenyu', 'index,follow'],
	['категорія+бренд+знижка', 'https://royalbud.com.ua/ru/catalog/zbirni-parkani/brand-avenyu/filter-discounted', 'noindex,nofollow'],
	['категорія+знижка', 'https://royalbud.com.ua/ru/catalog/design/filter-discounted', 'noindex,nofollow'],
	['категорія+хіт', 'https://royalbud.com.ua/ru/catalog/design/filter-featured', 'noindex,nofollow'],
	['категорія+фільтр1+фільтр1', 'https://royalbud.com.ua/ru/catalog/beton/marka-msp200_msp150', 'noindex,nofollow'],
	['категорія+фільтр1+фільтр2', 'https://royalbud.com.ua/ru/catalog/beton/marka-msp150/ruhomist-p1', 'noindex,nofollow'],
	['мета-сторінка', 'https://royalbud.com.ua/ru/catalog/beton/ruhomist-p3', 'index,follow'],

	['товар', 'https://royalbud.com.ua/ru/products/blok-gladkij-shirokij-silta-brick-zelenij', 'index,follow'],
	
	['сторінка', 'https://royalbud.com.ua/ru/dostavka', 'index,follow'],
	['сторінка', 'https://royalbud.com.ua/ru/about-us', 'index,follow'],

	['якась фігня з індексу', 'https://royalbud.com.ua/ru/all-products/brand-vaok/page-all', 'noindex,nofollow'],
	['якась фігня з індексу', 'https://royalbud.com.ua/ru/all-products/brand-vaok/', 'noindex,nofollow'],
	// ['', '', 'index,follow'],
	// ['', '', 'index,follow'],
	// ['', '', 'noindex,nofollow'],
	// ['', '', 'noindex,nofollow'],
];



echo "<table>";
echo "<tr><th>Тип</th><th>Status</th><th>URL</th><th>Meta required</th><th>Meta real</th></tr>";
foreach ($input as $u) {
	$meta = get_meta_tags($u[1]);
	$status = $meta['robots'] == $u[2] ? "ok" : "not";

	echo "<tr>";
	echo "<td>" . $u[0] . "</td>";
	echo "<td class='$status'>" . $status . "</td>";
	echo "<td>" . $u[1] . "</td>";
	echo "<td>" . $u[2] . "</td>";
	echo "<td>" . $meta['robots'] . "</td>";
	echo "</tr>";

}

echo "</table>";

?>

<style type="text/css">
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
td, th {
	padding: 4px 10px;
}
.ok {
	color:green;
	font-weight: bold;
}
.not {
	color: red;
	font-weight: bold;
}
</style>

