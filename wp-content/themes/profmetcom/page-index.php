<?php 
/**
 * Template Name: Главная
 */
 ?>
<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body <?php body_class('index'); ?>>

<div class="to-up disabled" id="js-btn-up">
	<img src="<?php bloginfo('template_url');?>/assets/i/sort-up.svg" alt="">
</div>

<div class="menu-bottom index-page">
	<div class="container">
		<div class="row">
			<!--menu-bar-->
			<div class="menu-bar">
				<div class="close-menu">
					<span></span>
					<span></span>
					<span></span>
				</div>

				<!--menu-->
				<ul class="menu">
					<li><a href="catalog.html">Каталог</a></li>
					<li><a href="news-page.html">Новости и акции</a></li>
					<li><a href="contacts.html">Контакты</a></li>
				</ul>
				<!--menu-->

				<div class="logo-small">
					<div class="logo-small__img">
						<a href="index.html">
							<img src="<?php bloginfo('template_url');?>/assets/i/logo.png" alt="">
						</a>
					</div>

					<div class="logo-small__content">
						<h5 class="logo-small__title">ПрофМетКом</h5>
						<p class="logo-small__text">
							Оборудование <br> для бизнеса
						</p>
					</div>
					<!--logo-small__content-->
				</div>
				<!--logo-small-->

				<!--feedback-->
				<div class="feedback">
						<span class="phone">
							<a href="tel:+ 7 (4912) 123-45-67">
								<i class="icon-phone"></i>
								+ 7 (4912) 123-45-67
							</a>
						</span>

					<div class="btn-wrap">
						<a href="#" class="btn btn--yellow show-modal">
							<i class="icon-mail"></i>
							<span>Написать нам</span>
						</a>
					</div>
					<!--btn-wrap-->

				</div>
				<!--feedback-->
			</div>
			<!--menu-bar-->
		</div>
		<!--row-->
	</div>
</div>
<!--menu-bottom-->

<!--to-up-->
<div id="fullPage">
	<div class="section">
		<header class="header-main">
			<!--header-big-->
			<section class="header-big">
				<!--header-big__bg-->
				<div class="header-big__bg">
					<div class="header-big__bg-item left"></div>
					<div class="header-big__bg-item right"></div>
				</div>
				<!--header-big-bg-->
				<div class="container">
					<div class="row">
						<!--menu-bar-->
						<div class="menu-bar">
							<div class="close-menu">
								<span></span>
								<span></span>
								<span></span>
							</div>
							<!--menu-->
							<?php wp_nav_menu( array(
								'theme_location'  => 'menu-index',
								'container'       => '',
								'menu_id'         => 'js-menu-top',
								'menu_class'      => 'menu',
								'items_wrap'      => '<ul id="%1$s" class = "%2$s">%3$s</ul>',
							) ); ?>
							<!--menu-->

							<!--feedback-->
							<div class="feedback">
										<span class="phone">
											<a href="tel:+ 7 (4912) 123-45-67">
												<i class="icon-phone"></i>
												+ 7 (4912) 123-45-67
											</a>
										</span>
								<div class="btn-wrap">
									<a href="#" class="btn btn--yellow show-modal">
										<i class="icon-mail"></i>
										<span>Написать нам</span>
									</a>
								</div>
								<!--btn-wrap-->
							</div>
							<!--feedback-->
						</div>
						<!--menu-bar-->
					</div>
					<!--row-->
					<div class="row">
						<h1 class="main-title"><?php bloginfo('description'); ?></h1>
						<div class="logo">
							<?php the_custom_logo(); ?>
						</div>
					</div><!--row-->
					<div class="row">
						<div class="to-down">
							<a href="#">
								<i class="icon-to-down"></i>
							</a>
							<span>крутите вниз</span>
						</div>
					</div>
				</div>
				<!--container-->
			</section>
			<!--header-big-->
		</header>
	</div>
	<div class="section">
		<!--productions-->
		<div class="productions">
			<div class="container-big">
				<?php $categories = get_categories(['orderby'=>'ID', 'exclude' => '2']); ?>
				<?php if(!empty($categories)): ?>
					<?php foreach($categories as $category): ?>
						<?php if (function_exists('get_tax_images')) $img_html = get_tax_images($category->term_id ,'full'); ?>

						<div class="productions__item">
							<div class="productions__content">
								<div class="img-wrap">
									<?php echo $img_html[0]; ?>
								</div>
								<h5 class="title-very-small"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></h5>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<h2>В категориях нет записией</h2>
				<?php endif; ?>
			</div>
		</div>
		<!--productions-->
	</div>
	<div class="section">
		<!--//= blocks/menu-bottom.html-->
		<!--news-->
		<div class="news">
			<h2 class="title-big">Новости и акции</h2>
		
			<div class="container">
				<div class="row">
					<div class="col-xl-8">
		
						<!--news-small-->
						<div class="news__small">
		
		
							<div class="img-wrap">
								<img src="<?php bloginfo('template_url');?>/assets/i/news/news-small-1.jpg" alt="">
							</div>
		
							<!--news__small-content-->
							<div class="news__small-content">
								<h4><a href="#">Новое поступление: Металлические шкафы, гардеробные шкафы, оружейные шкафы</a></h4>
								<p>
									Потери от высокой температуры терпят магнитные диски, киноленты, фотопленки и дискеты. Правда, все вещи имеют свой температурный предел до возгорания. В силу этих особенностей разработано 12 классов огнестойкости сейфов (ГОСТ Р 40862-96).
								</p>
								<div class="news__small-bottom">
									<i class="read-more"></i>
									<time>20. 04.2018</time>
								</div>
							</div>
							<!--news__small-content-->
		
						</div>
						<!--news-small-->
		
						<!--news-small-->
						<div class="news__small">
		
							<div class="img-wrap">
								<img src="<?php bloginfo('template_url');?>/assets/i/news/news-small-2.jpg" alt="">
							</div>
		
							<!--news__small-content-->
							<div class="news__small-content">
								<h4><a href="#">Новое поступление: Огнестойкие сейфы – надежная защита ценных вещей, бумаг и
									документов</a></h4>
								<p>
									Огнестойкие сейфы – это особая группа металлических сейфов, способная сохранить важные вещи невредимыми даже в экстремальных условиях. Часто купить огнестойкий сейф нужно не только для бумаг, денег и драгоценностей, но и для других уязвимых к огню предметов.
								</p>
								<div class="news__small-bottom">
									<i class="read-more"></i>
									<time>20. 04.2018</time>
								</div>
							</div>
							<!--news__small-content-->
		
						</div>
						<!--news-small-->
		
					</div>
		
					<div class="col-xl-4">
		
						<!--news__big-->
						<div class="news__big">
		
							<div class="img-wrap">
								<img src="<?php bloginfo('template_url');?>/assets/i/news/news-big.jpg" alt="">
							</div>
		
							<!--news__big-content-->
							<div class="news__big-content">
								<h4><a href="#">Акция на верстаки: купи 3 получи скидку 40% на последующие</a></h4>
								<p>
									Потери от высокой температуры терпят магнитные диски, киноленты, фотопленки и дискеты. Правда, все вещи имеют свой температурный предел до возгорания. В силу этих особенностей разработано 12 классов огнестойкости сейфов (ГОСТ Р 40862-96).
								</p>
							</div>
							<!--news__big-content-->
		
						</div>
						<!--news__big-->
					</div>
				</div>
			</div>
		</div>
		<!--news-->
	</div>
	<div class="section fp-auto-height">
		<div class="footer-contacts">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="footer-contacts__header">
							<div class="footer-bar" data-footer-content="first-block">
								<i class="show-footer-content"></i>
							</div>
							<h3 class="title-small">Доставка и монтаж</h3>
						</div>
						<div class="footer-contacts__content" id="first-block">
							<h4 class="footer-contacts__title">Стоимость доставки:</h4>
							<p>
								400 рублей. Цена не зависит от груза и объёма. Доставка по области согласовывается с
								оператором.
								Заказ доставляется до подъезда без заноса и подъёма на этаж.
							</p>
							<h4 class="footer-contacts__title">Стоимость подъема на этаж:</h4>
							<ul>
								<li>Груз до 200 кг: 6 рублей/кг/этаж.</li>
								<li>Груз от 200 кг: 8 рублей/кг/этаж.</li>
								<li>При наличии в доме лифта стоимость подъёма рассчитывается за 2 этажа.</li>
							</ul>
							<h4 class="footer-contacts__title">Монтаж:</h4>
							<p>Цена за установку: от 7% от стоимости заказа. Цена рассчитывается индивидуально и может
								быть
								увеличена в зависимости от груза и объёма заказа.
							</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="footer-contacts__header">
							<div class="footer-bar" data-footer-content="second-block">
								<i class="show-footer-content"></i>
							</div>
							<h3 class="title-small">Способы оплаты</h3>
						</div>
						<div class="footer-contacts__content" id="second-block">
							<ul>
								<li>Безналичный расчет</li>
								<li>Оплата наличными в кассу</li>
							</ul>
							<h4 class="footer-contacts__title">Реквизиты компании:</h4>
							<ul class="no-circle">
								<li>ИНН 7813397250</li>
								<li>КПП 781301001</li>
								<li>ОКПО 83753694</li>
							</ul>
							<p>
								Юридический и фактический адрес:
								390000, г. Рязань, ул. Ленина д. 29
							</p>
							<p>
								Р/сч 40702810180000004460
								Филиал ОПЕРУ ОАО Банк ВТБ г.Санкт-Петербург
								К/сч 30101810200000000704
								БИК 044030704
							</p>
							<p>Генеральный директор: Иванов Иван Иванович</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="footer-contacts__header">
							<div class="footer-bar" data-footer-content="third-block">
								<i class="show-footer-content"></i>
							</div>
							<h3 class="title-small">Контакты</h3>
						</div>
						<div class="footer-contacts__content" id="third-block">
							<p>
								+7 (4912) 12-45-67, 34-56-78
								info@profmetcom.ru
								390000, г. Рязань, ул. Ленина д. 29
							</p>
							<div class="small-map" id="small-map"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		<footer class="footer-main">
			<div class="container">
				<div class="footer-main__content">
					<div class="footer-main__item first">© ПрофМетКом 2018</div>
					<div class="footer-main__item second">Цены, указанные на сайте, не являются публичной офертой!
						Точную стоимость
						продукции уточняйте по телефону.
					</div>
					<div class="footer-main__item third"><a href="#">Политика конфиденциальности</a> <a href="#">Пользовательское
						соглашение</a></div>
					<div class="footer-main__item fourth"><a href="#">Разработка сайта</a> — Динамика</div>
				</div>
			</div>
		</footer>
		<!--footer-main-->
	</div>
	<!--section-->
</div>
<!--full-page-->
<div class="modals">
	<div class="modal" id="js-modal">
		<i class="icon-close" id="js-icon-close"></i>
		<h3 class="title-middle">Обратная связь</h3>
		<form action="" class="modals-form">
			<div class="form-group">
				<label for="modal-login">Ваше имя:</label>
				<input type="text" name="modal-login" id="modal-login">
			</div>
			<div class="form-group">
				<label for="modal-phone">Контактный телефон</label>
				<input type="text" id="modal-phone" name="modal-phone">
			</div>
			<div class="form-group">
				<label for="modal-email">E-mail:</label>
				<input type="text" name="modal-email" id="modal-email">
			</div>
			<div class="form-group">
				<label for="modal-message">Текст сообщения:</label>
				<textarea name="modal-message" id="modal-message"></textarea>
			</div>
			<div class="modals-form__bottom">
				<p>Пожалуйста, заполните все поля</p>
				<div class="btn-wrap">
					<div class="btn btn--yellow">
						<i class="icon-mail"></i>
						<span>Отправить</span>
					</div>
				</div>
			</div>
			<p>Отправляя форму, вы соглашаетесь на обработку ваших
				персональных данных в соответствии
				с <a href="#" class="text-link">Политикой конфиденциальности</a></p>
		</form>
	</div>
	<!--modal-->
	<div class="overlay" id="js-overlay"></div>
</div>
<!--modals-->
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_url');?>/assets/libs/html5shiv/es5-shim.min.js"></script>
<script src="<?php bloginfo('template_url');?>/assets/libs/html5shiv/html5shiv.min.js"></script>
<script src="<?php bloginfo('template_url');?>/assets/libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="<?php bloginfo('template_url');?>/assets/libs/html5shiv/respond.min.js"></script>
[endif]-->

<?php wp_footer(); ?>
</body>
</html>
