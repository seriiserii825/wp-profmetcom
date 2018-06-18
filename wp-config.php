<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wp-profmetcom');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Qo7OM=-)UaDJox/8p|hg-X8jzC3+{(o:Vy(}oj|u`w0J:;3#TC)n1wcd8SNVu4J=');
define('SECURE_AUTH_KEY',  'c%0yzR&Q9{*% <y^I]?30wRDm9v+Ph+[DuCybe=#+y$;gV-g0{7js[&M%ck4u--P');
define('LOGGED_IN_KEY',    'eO3*eJ.Uq|r2lY/g78KA@w&F%~4a=L~>Jr7p:kD/9EgffA<CADiVG Pn{jV7+L,?');
define('NONCE_KEY',        '+=dX49cW<0}mWeK;<vTC{;l`>C4qb`y?jVR}7oC;R~s*2von#$VjB*KC$fy:rm?J');
define('AUTH_SALT',        'tas.AwwGFfS.~<6Rj|QC#xL[%Fo1mBIm!!{P|sbJ%!Y;37?33-oedA+33yy+qAxC');
define('SECURE_AUTH_SALT', 'FAKI^@dQ-G(K_x<fis(g:2Ec+|[cU=eE3pyjIlX#A_>}r05OTSolTM(bbsZdliOH');
define('LOGGED_IN_SALT',   '3Ss?>B9|w_-Qw~eN09Kn&yfe-q|XLHi+{uooU;j4Y_sGx*qPp[p!:[+G,>cU$#]l');
define('NONCE_SALT',       'vb<9M4R`L.3<^:Zn1GQcbWU0@zR<{LFYIb|I+7p?y6!L!6Cqz_S_IpXpMe~;pE`B');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
